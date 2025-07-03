<?php
// controllers/CartController.php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Cart.php';

class CartController
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = Cart::getItems();
        require __DIR__ . '/../views/cart/index.php';
    }

    /**
     * Add a product to the cart.
     */
    public function add()
    {
        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if ($productId > 0) {
            $pdo = require __DIR__ . '/../config/database.php';
            $stmt = $pdo->prepare("SELECT id, name, price FROM products WHERE id = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch();

            if ($product) {
                Cart::addItem($product, $quantity);
            }
        }

        header('Location: index.php?action=cart');
        exit;
    }

    /**
     * Remove a product from the cart.
     */
    public function remove()
    {
        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($productId > 0) {
            Cart::removeItem($productId);
        }

        header('Location: index.php?action=cart');
        exit;
    }

    /**
     * Update quantities of products in the cart.
     */
    public function update()
    {
        if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
            Cart::updateQuantities($_POST['quantities']);
        }

        header('Location: index.php?action=cart');
        exit;
    }

    /**
     * Place an order: save to database and show SweetAlert confirmation.
     */
    public function placeOrder()
    {

        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        if (empty($cart)) {
            header('Location: index.php?action=cart');
            exit;
        }

        $pdo = require __DIR__ . '/../config/database.php';

        try {
            // Begin transaction
            $pdo->beginTransaction();

            // Insert into orders
            $stmt = $pdo->prepare("INSERT INTO orders (user_id) VALUES (?)");
            $stmt->execute([$userId]);
            $orderId = $pdo->lastInsertId();

            // Insert order items
            $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");

            foreach ($cart as $item) {
                $stmtItem->execute([$orderId, $item['id'], $item['quantity']]);
            }

            // Commit transaction
            $pdo->commit();

            // Clear cart
            $_SESSION['cart'] = [];

            // Show SweetAlert confirmation
            require __DIR__ . '/../views/cart/place_order_success.php';
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Error placing order: " . $e->getMessage();
        }
    }

    public function orders()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $pdo = require __DIR__ . '/../config/database.php';

        // Get orders of this client
        $stmt = $pdo->prepare("SELECT id, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        $orders = $stmt->fetchAll();

        // Get order items for each order
        $orderDetails = [];
        foreach ($orders as $order) {
            $stmtItems = $pdo->prepare("SELECT product_id, quantity FROM order_items WHERE order_id = ?");
            $stmtItems->execute([$order['id']]);
            $items = $stmtItems->fetchAll();
            $orderDetails[] = [
                'order' => $order,
                'items' => $items
            ];
        }

        require __DIR__ . '/../views/client/orders.php';
    }
}

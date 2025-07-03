<?php
require_once __DIR__ . '/../config/database.php';

class ClientController {

    /**
     * Show the client dashboard page
     */
    public function dashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            header('Location: index.php?action=login');
            exit;
        }

        require __DIR__ . '/../views/users/dashboard_client.php';
    }

    /**
     * Show the order history for the logged-in client
     */
    public function orders() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            header('Location: index.php?action=login');
            exit;
        }

        $pdo = require __DIR__ . '/../config/database.php';

        // Fetch the orders with products for the current user
        $stmt = $pdo->prepare("
            SELECT 
                o.id AS order_id,
                o.created_at AS order_date,
                p.name AS product_name,
                oi.quantity AS product_quantity,
                p.price AS unit_price,
                (oi.quantity * p.price) AS subtotal
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN products p ON oi.product_id = p.id
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC
        ");
        $stmt->execute([$_SESSION['user_id']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/users/orders.php';
    }
}

<?php
// Controller to handle product-related operations

require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    /**
     * Display all products (for the admin or detailed catalog view).
     */
    public function index()
    {
        $productModel = new Product();
        $products = $productModel->getAll();

        require __DIR__ . '/../views/products/index.php';
    }

    /**
     * Show the form to create a new product.
     */
    public function create()
    {
        require_once __DIR__ . '/../models/Category.php';
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        require_once __DIR__ . '/../views/products/create.php';
    }

    /**
     * Handle form submission and store the new product in the database.
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? null;

            // Upload a single image
            $imagePath = '';
            if (!empty($_FILES['image']['name'])) {
                $tmpName = $_FILES['image']['tmp_name'];
                $originalName = basename($_FILES['image']['name']);
                $targetDir = __DIR__ . '/../public/uploads/';
                $targetPath = $targetDir . time() . '_' . $originalName;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $imagePath = 'uploads/' . basename($targetPath);
                } else {
                    die('Failed to upload image.');
                }
            } else {
                die('Please upload an image.');
            }

            // Save product to database
            $pdo = require __DIR__ . '/../config/database.php';
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, category_id, image_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $categoryId, $imagePath]);

            header('Location: index.php?controller=product&action=index');
            exit;
        }
    }

    /**
     * Update an existing product by ID.
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? null;

            require_once __DIR__ . '/../models/Product.php';
            $productModel = new Product();

            // Update product details
            $productModel->update($id, [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'category_id' => $categoryId
            ]);

            // If a new image is uploaded, replace the existing one
            if (!empty($_FILES['image']['name'])) {
                $tmpName = $_FILES['image']['tmp_name'];
                $originalName = basename($_FILES['image']['name']);
                $targetDir = __DIR__ . '/../public/uploads/';
                $targetPath = $targetDir . time() . '_' . $originalName;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $imagePath = 'uploads/' . basename($targetPath);

                    // Update only the image path in the database
                    $pdo = require __DIR__ . '/../config/database.php';
                    $stmt = $pdo->prepare("UPDATE products SET image_path = ? WHERE id = ?");
                    $stmt->execute([$imagePath, $id]);
                } else {
                    die('Failed to upload new image.');
                }
            }

            header('Location: index.php?controller=product&action=index');
            exit;
        }
    }

    /**
     * Show the edit form for a specific product.
     */
    public function edit()
    {
        if (isset($_GET['id'])) {
            require_once __DIR__ . '/../models/Product.php';
            require_once __DIR__ . '/../models/Category.php';

            $productModel = new Product();
            $categoryModel = new Category();

            $product = $productModel->getById($_GET['id']);
            $categories = $categoryModel->getAll();

            if (!$product) {
                die('Product not found.');
            }

            require_once __DIR__ . '/../views/products/edit.php';
        }
    }

    /**
     * Delete a product by ID.
     */
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            require_once __DIR__ . '/../models/Product.php';
            $productModel = new Product();

            $productModel->delete($id);

            header('Location: index.php?controller=product&action=index');
            exit;
        }
    }

    /**
     * Display only 4 products for the homepage catalog.
     * This is used to render the main storefront (views/home/index.php).
     */
    public function homeProducts()
    {
        $pdo = require __DIR__ . '/../config/database.php';
        $stmt = $pdo->query("SELECT p.*, c.name AS category_name 
                             FROM products p 
                             LEFT JOIN categories c ON p.category_id = c.id 
                             ORDER BY p.id DESC
                             LIMIT 4"); // <<< ONLY 4 PRODUCTS
        $products = $stmt->fetchAll();

        require __DIR__ . '/../views/home/index.php';
    }
}


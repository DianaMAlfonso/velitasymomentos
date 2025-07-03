<?php
// Product model - extended to support categories and multiple images

class Product {
    private $db;

    public function __construct() {
        $this->db = require __DIR__ . '/../config/database.php';
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT products.*, categories.name AS category_name 
            FROM products 
            LEFT JOIN categories ON products.category_id = categories.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data, $imagePaths) {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, description, price, category_id) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['name'],
            $data['description'],
            $data['price'],
            $data['category_id']
        ]);

        $productId = $this->db->lastInsertId();

        // Save each image path
        $imgStmt = $this->db->prepare("INSERT INTO product_images (product_id, image_path) VALUES (?, ?)");
        foreach ($imagePaths as $path) {
            $imgStmt->execute([$productId, $path]);
        }

        return $productId;
    }

    public function update($id, $data) {
    $stmt = $this->db->prepare("UPDATE products SET name = ?, description = ?, price = ?, category_id = ? WHERE id = ?");
    return $stmt->execute([
        $data['name'],
        $data['description'],
        $data['price'],
        $data['category_id'],
        $id
    ]);
}

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

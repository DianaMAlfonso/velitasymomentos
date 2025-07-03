<?php

/**
 * Handles category-related database operations
 */
class Category {
    private $db;

    public function __construct() {
        $this->db = require __DIR__ . '/../config/database.php';
    }

    /**
     * Get all categories
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a category by ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new category
     */
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        return $stmt->execute([$data['name']]);
    }

    /**
     * Update a category by ID
     */
    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE categories SET name = ? WHERE id = ?");
        return $stmt->execute([$data['name'], $id]);
    }

    /**
     * Delete a category by ID
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


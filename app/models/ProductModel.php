<?php
    require_once '../system/Database.php';

    class ProductModel {
        private $db;

        public function __construct() {
            $this->db = new Database();    
        }

        public function getAllProducts() {
            return $this->db->query("SELECT * FROM products");
        }

        public function getProductById($id) {
            return $this->db->query("SELECT * FROM products WHERE id = :id", ['id' => $id])[0] ?? null;
        }

        public function getProductsWithSearch($search, $limit, $offset) {
            $query = "SELECT * FROM products WHERE name LIKE :search LIMIT $limit OFFSET $offset";
            return $this->db->query($query, [
                'search' => '%' . $search . '%',
            ]);
        }
        
        public function getTotalProducts($search) {
            $query = "SELECT COUNT(*) AS total FROM products WHERE name LIKE :search";
            $result = $this->db->query($query, [
                'search' => '%' . $search . '%',
            ]);
            return $result[0]['total'] ?? 0;
        }

        public function addProduct($data) {
            $query = "INSERT INTO products (name, price, description, stock) VALUES (:name, :price, :description, :stock)";
            $this->db->query($query, [
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'stock' => $data['stock']
            ]);
        }

        public function updateProduct($id, $data) {
            $query = "UPDATE products SET name = :name, price = :price, description = :description, stock = :stock WHERE id = :id";
            $this->db->query($query, [
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'stock' => $data['stock'],
                'id' => $id
            ]);
        }

        public function deleteProduct($id) {
            $this->db->query('DELETE FROM products WHERE id = :id', ['id' => $id]);
        }
    }
<?php
    require_once '../system/Database.php';

    class TransactionModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getAllOrders() {
            $query = "SELECT 
                        orders.id AS order_id,
                        users.name AS user_name,
                        orders.total_price,
                        orders.status,
                        orders.created_at
                      FROM orders
                      JOIN users ON orders.user_id = users.id
                      ORDER BY orders.created_at DESC";
            return $this->db->query($query);
        }

        public function updateTransactionStatus($id, $status) {
            $query = "UPDATE orders SET status = :status WHERE id = :id";
            $this->db->query($query, [
                'status' => $status,
                'id' => $id,
            ]);
        }

        public function getTransactionsWithPagination($limit, $offset) {
            // $query = "SELECT * FROM products WHERE name LIKE :search LIMIT $limit OFFSET $offset";
            // return $this->db->query($query, [
            //     'search' => '%' . $search . '%',
            // ]);

            $query = "SELECT 
                        orders.id AS order_id,
                        users.name AS user_name,
                        orders.total_price,
                        orders.status,
                        orders.created_at
                      FROM orders
                      JOIN users ON orders.user_id = users.id
                      ORDER BY orders.created_at DESC
                      LIMIT $limit OFFSET $offset";
        
            return $this->db->query($query);
        }
        
        public function getTotalTransactions() {
            $query = "SELECT COUNT(*) AS total FROM orders";
            $result = $this->db->query($query);
            return $result[0]['total'] ?? 0;
        }

        public function getTransactionById($id) {
            return $this->db->query("SELECT * FROM orders WHERE id = :id", ['id' => $id])[0] ?? null;
        }

        public function createOrder($data) {
            $query = "INSERT INTO orders (user_id, total_price, status) VALUES (:user_id, :total_price, 'pending')";
            $this->db->query($query, [
                'user_id' => $data['user_id'],
                'total_price' => $data['total_price'],
            ]);
            return $this->db->lastInsertId();
        }
        
        public function addOrderItem($data) {
            $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $this->db->query($query, $data);
        }
        
        public function updateStock($id, $newStock) {
            $query = "UPDATE products SET stock = :stock WHERE id = :id";
            $this->db->query($query, [
                'stock' => $newStock,
                'id' => $id,
            ]);
        }

        public function deleteTransaction($id) {
            $this->db->query("DELETE FROM transactions WHERE id = :id", ['id' => $id]);
        }
    }
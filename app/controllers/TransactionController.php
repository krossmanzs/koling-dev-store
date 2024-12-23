<?php
require_once '../system/Database.php';
require_once '../app/models/TransactionModel.php';

class TransactionController {
    private $model;

    public function __construct() {
        $this->model = new TransactionModel();
    }

    private function checkSession($role = 'admin') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validasi sesi pengguna
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
            // Redirect ke login jika sesi tidak sesuai
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
    
    public function index() {
        $this->checkSession();
    
        // Pagination setup
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Number of items per page
        $offset = ($page - 1) * $limit;
    
        // Fetch transactions with pagination
        $transactions = $this->model->getTransactionsWithPagination($limit, $offset);
        $totalTransactions = $this->model->getTotalTransactions();
        $totalPages = ceil($totalTransactions / $limit);
    
        require_once '../app/views/admin/transactions/index.php';
    }
    

    public function updateStatus($id) {
        $this->checkSession();

        // check is admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
    
            if (in_array($status, ['pending', 'completed', 'cancelled'])) { // Validasi status
                $this->model->updateTransactionStatus($id, $status);
                header('Location: ' . BASE_URL . '/admin/transactions');
                exit;
            } else {
                echo "Invalid status.";
            }
        } else {
            $transaction = $this->model->getTransactionById($id);
            if (!$transaction) {
                echo "Transaction not found.";
                return;
            }
            require_once '../app/views/admin/transactions/edit.php';
        }
    }

    public function create($productId) {
        $this->checkSession("member");
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi input quantity
            if (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
                $quantity = (int) $_POST['quantity'];
                
                // Validasi product_id dan price dari produk (optional, sesuaikan kebutuhan)
                if (!isset($productId) || !is_numeric($productId)) {
                    die("Invalid product ID.");
                }
    
                // Simulasikan harga untuk validasi lebih lanjut
                $productModel = new ProductModel();
                $product = $productModel->getProductById($productId);
    
                if (!$product || $product['stock'] < $quantity) {
                    die("Product not available or insufficient stock.");
                }
    
                // Proses transaksi
                $totalPrice = $product['price'] * $quantity;
    
                $data = [
                    'user_id' => $_SESSION['user']['id'],
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product['price'],
                    'total_price' => $totalPrice,
                ];
    
                $transactionModel = new TransactionModel();
                $orderId = $transactionModel->createOrder([
                    'user_id' => $data['user_id'],
                    'total_price' => $data['total_price'],
                ]);
    
                $transactionModel->addOrderItem([
                    'order_id' => $orderId,
                    'product_id' => $data['product_id'],
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                ]);
    
                $newStock = $product['stock'] - $quantity;
                $transactionModel->updateStock($productId, $newStock);
    
                header('Location: ' . BASE_URL . '/');
                exit;
            } else {
                echo "Invalid quantity.";
            }
        } else {
            require_once '../app/views/orders/create.php';
        }
    }
}

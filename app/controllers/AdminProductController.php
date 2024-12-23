<?php
require_once '../app/models/ProductModel.php';

class AdminProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index() {
        $this->checkAdmin();
    
        // Ambil parameter pencarian dan halaman
        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6; // Jumlah produk per halaman
        $offset = ($page - 1) * $limit;
        
        // Ambil produk berdasarkan pencarian dan pagination
        $products = $this->productModel->getProductsWithSearch($search, $limit, $offset);
        
        // Hitung total produk untuk pagination
        $totalProducts = $this->productModel->getTotalProducts($search);
        $totalPages = ceil($totalProducts / $limit);

        require_once '../app/views/admin/products/index.php';
    }
    
    public function create() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];

            $this->productModel->addProduct([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
            ]);

            header('Location: ' . BASE_URL . '/admin/products');
            exit;
        }
        require_once '../app/views/admin/products/create.php';
    }

    public function edit($id) {
        $this->checkAdmin();
        $product = $this->productModel->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];

            $this->productModel->updateProduct($id, [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
            ]);

            header('Location: ' . BASE_URL . '/admin/products');
            exit;
        }

        require_once '../app/views/admin/products/edit.php';
    }

    public function delete($id) {
        $this->checkAdmin();
        
        if ($id && is_numeric($id)) {
            $this->productModel->deleteProduct($id);
            header('Location: ' . BASE_URL . '/admin/products');
            exit;
        } else {
            http_response_code(400); // Bad Request
            echo "Invalid Product ID";
        }
    }

    private function checkAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
}

<?php
require_once '../app/models/ProductModel.php';

class HomeController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index() {
        // Ambil parameter pencarian dan halaman
        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 3; // Jumlah produk per halaman
        $offset = ($page - 1) * $limit;
        
        // Ambil produk berdasarkan pencarian dan pagination
        $products = $this->productModel->getProductsWithSearch($search, $limit, $offset);
        
        // Hitung total produk untuk pagination
        $totalProducts = $this->productModel->getTotalProducts($search);
        $totalPages = ceil($totalProducts / $limit);

        // Kirim data ke view
        require_once '../app/views/home/index.php';
    }

    public function order($productId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process order logic here
            echo "Order placed for product ID: $productId";
        } else {
            echo "Invalid request method.";
        }
    }
}
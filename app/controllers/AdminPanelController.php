<?php

class AdminPanelController {
    public function index() {
        $this->checkAdmin();
        require_once '../app/views/admin/panel.php';
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
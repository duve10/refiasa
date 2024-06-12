<?php
class HomeController {
    public function index() {
        require_once '../app/views/home.php';
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        require_once '../app/views/dashboard.php';
    }
}

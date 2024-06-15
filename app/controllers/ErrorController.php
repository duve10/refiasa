<?php
class ErrorController {
    public function notFound() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        require_once '../app/views/404.php';
    }
}

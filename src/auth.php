<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'login') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                $_SESSION['login_error'] = 'Please fill in all fields.';
                header("Location: ../public/login.php");
                exit();
            }

            $conn = connect_db();
            $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    // Password is correct, start session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $username;
                    // Redirect to admin dashboard
                    header("Location: " . BASE_URL . "/public/admin/");
                    exit();
                }
            }

            // If we reach here, login was unsuccessful
            $_SESSION['login_error'] = 'Invalid username or password.';
            header("Location: " . BASE_URL . "/public/login.php");
            exit();

            $stmt->close();
            $conn->close();
        }
    }
}

// Logout logic can be a simple separate file or handled here
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: " . BASE_URL . "/public/login.php");
    exit();
}

// Redirect to login if accessed directly without a valid action
header("Location: " . BASE_URL . "/public/login.php");
exit();
?>

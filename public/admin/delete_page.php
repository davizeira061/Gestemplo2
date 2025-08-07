<?php
session_start();
require_once '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if an ID is provided
if (isset($_GET['id'])) {
    $page_id = (int)$_GET['id'];
    $conn = connect_db();

    $stmt = $conn->prepare("DELETE FROM pages WHERE id = ?");
    $stmt->bind_param("i", $page_id);

    if ($stmt->execute()) {
        // Redirect back to the manage pages list
        header("Location: manage_pages.php");
        exit();
    } else {
        // Handle error, maybe show an error message
        die("Error deleting page: " . $conn->error);
    }

    $stmt->close();
    $conn->close();
} else {
    // If no ID is provided, redirect
    header("Location: manage_pages.php");
    exit();
}
?>

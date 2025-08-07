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
    $post_id = (int)$_GET['id'];
    $conn = connect_db();

    // First, get the image_url to delete the file
    $stmt_select = $conn->prepare("SELECT image_url FROM posts WHERE id = ?");
    $stmt_select->bind_param("i", $post_id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $image_path = '../' . $post['image_url'];
        if (!empty($post['image_url']) && file_exists($image_path)) {
            unlink($image_path); // Delete the image file
        }
    }
    $stmt_select->close();

    // Now, delete the post from the database
    $stmt_delete = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt_delete->bind_param("i", $post_id);

    if ($stmt_delete->execute()) {
        // Redirect back to the manage posts list
        header("Location: manage_posts.php");
        exit();
    } else {
        // Handle error
        die("Error deleting post: " . $conn->error);
    }

    $stmt_delete->close();
    $conn->close();
} else {
    // If no ID is provided, redirect
    header("Location: manage_posts.php");
    exit();
}
?>

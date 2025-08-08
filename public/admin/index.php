<?php
session_start();
require_once '../../config/database.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "/public/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        .header { background: #333; color: #fff; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: #fff; text-decoration: none; }
        .container { padding: 2rem; }
        h1 { margin-top: 0; }
        .menu a { display: block; margin-bottom: 1rem; color: #333; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="<?php echo BASE_URL; ?>/src/auth.php?action=logout">Logout</a>
    </div>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>This is the admin area. You can manage the website content from here.</p>

        <h3>Manage Content</h3>
        <div class="menu">
            <a href="manage_pages.php">Manage Pages</a>
            <a href="manage_posts.php">Manage Posts (News, Events, Sermons)</a>
        </div>
    </div>
</body>
</html>

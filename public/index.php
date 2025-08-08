<?php
require_once '../config/database.php';
require_once '../src/utils.php'; // I will create this file for helper functions

// Simple router logic
$request_uri = trim($_SERVER['REQUEST_URI'], '/');
$request_parts = explode('/', $request_uri);
$base_folder = 'pib-clone'; // Change this if your project is in a different subfolder on localhost

// Remove base folder from request if present
if (!empty($base_folder) && isset($request_parts[0]) && $request_parts[0] == $base_folder) {
    array_shift($request_parts);
}

$route = !empty($request_parts[0]) ? $request_parts[0] : 'home';
$param = isset($request_parts[1]) ? $request_parts[1] : null;

// Load the template header
include '../templates/header.php';

// Route to the correct content
switch ($route) {
    case 'home':
        include '../templates/home.php';
        break;

    case 'page':
        if ($param) {
            $_GET['slug'] = $param; // Make slug available to the template
            include '../templates/page.php';
        } else {
            include '../templates/404.php';
        }
        break;

    case 'news':
    case 'events':
    case 'sermons':
        if ($param) {
            $_GET['id'] = $param; // Make ID available to the template
            include '../templates/single_post.php';
        } else {
            $_GET['type'] = rtrim($route, 's'); // 'news', 'event', 'sermon'
            include '../templates/post_list.php';
        }
        break;

    default:
        // Before showing 404, check if it's a page slug directly
        $_GET['slug'] = $route;
        $conn = connect_db();
        $stmt = $conn->prepare("SELECT id FROM pages WHERE slug = ?");
        $stmt->bind_param("s", $route);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            include '../templates/page.php';
        } else {
            include '../templates/404.php';
        }
        $stmt->close();
        $conn->close();
        break;
}

// Load the template footer
include '../templates/footer.php';

?>

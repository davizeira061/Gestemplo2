<?php

// --- Database Credentials ---
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'igreja');

// --- Base URL Configuration ---
// Dynamically determine the base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$script_name = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

// If the script is in the root, the dirname will be '/'. If in a subdir, it will be '/subdir'.
// We want to remove the '/public' part if the entry point is from there.
$base_path = preg_replace('/\/public$/', '', $script_name);
$base_url = rtrim("$protocol://$host" . $base_path, '/');

define('BASE_URL', $base_url);


function connect_db() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

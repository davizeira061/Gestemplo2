<?php
// This file is for helper functions.

function get_menu_pages() {
    $conn = connect_db();
    $result = $conn->query("SELECT title, slug FROM pages ORDER BY title ASC");
    $pages = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $pages[] = $row;
        }
    }
    $conn->close();
    return $pages;
}
?>

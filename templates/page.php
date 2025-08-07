<?php
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
if (empty($slug)) {
    echo "<h1>Page not found</h1>";
    return;
}

$conn = connect_db();
$stmt = $conn->prepare("SELECT title, content FROM pages WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $page = $result->fetch_assoc();
    ?>
    <div class="page-content">
        <h1><?php echo htmlspecialchars($page['title']); ?></h1>
        <div><?php echo nl2br(htmlspecialchars($page['content'])); ?></div>
    </div>
    <?php
} else {
    // If no page is found, include a 404 message
    include '404.php';
}

$stmt->close();
$conn->close();
?>

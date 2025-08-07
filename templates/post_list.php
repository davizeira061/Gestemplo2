<?php
$type = isset($_GET['type']) ? $_GET['type'] : '';
if (empty($type)) {
    echo "<h1>Invalid post type</h1>";
    return;
}

$conn = connect_db();
$stmt = $conn->prepare("SELECT id, title, content, image_url, event_date FROM posts WHERE type = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $type);
$stmt->execute();
$result = $stmt->get_result();

$page_title = ucfirst($type) . 's';
// Make the title "Notícias" for "news"
if ($type === 'news') {
    $page_title = 'Notícias';
} else if ($type === 'event') {
    $page_title = 'Eventos';
} else if ($type === 'sermon') {
    $page_title = 'Sermões';
}

?>

<style>
    /* Re-using styles from home.php */
    .post-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; }
    .post-card { border: 1px solid #eee; border-radius: 5px; overflow: hidden; }
    .post-card img { max-width: 100%; height: auto; }
    .post-card-content { padding: 1rem; }
    .post-card h3 { margin-top: 0; }
    .post-card a { text-decoration: none; color: inherit; }
</style>

<h1><?php echo htmlspecialchars($page_title); ?></h1>

<div class="post-grid">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while($post = $result->fetch_assoc()): ?>
            <div class="post-card">
                <a href="<?php echo $type; ?>s/<?php echo $post['id']; ?>">
                    <?php if ($post['image_url']): ?>
                        <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                    <?php endif; ?>
                    <div class="post-card-content">
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <?php if ($type === 'event' && $post['event_date']): ?>
                            <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($post['event_date'])); ?></p>
                        <?php endif; ?>
                        <p><?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 150)); ?>...</p>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhum post encontrado nesta categoria.</p>
    <?php endif; ?>
</div>

<?php
$stmt->close();
$conn->close();
?>

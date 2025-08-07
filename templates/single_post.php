<?php
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($post_id === 0) {
    echo "<h1>Post not found</h1>";
    return;
}

$conn = connect_db();
$stmt = $conn->prepare("SELECT type, title, content, image_url, video_url, event_date FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $post = $result->fetch_assoc();
    ?>
    <style>
        .post-image { max-width: 100%; height: auto; margin-bottom: 1rem; }
        .post-meta { color: #666; margin-bottom: 1rem; }
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
            margin-top: 1rem;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <div class="post-content">
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>

        <div class="post-meta">
            <?php if ($post['type'] === 'event' && $post['event_date']): ?>
                <span><strong>Data do Evento:</strong> <?php echo date('d/m/Y H:i', strtotime($post['event_date'])); ?></span>
            <?php endif; ?>
        </div>

        <?php if ($post['image_url']): ?>
            <img src="../<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="post-image">
        <?php endif; ?>

        <div><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>

        <?php if ($post['video_url']):
            // Convert YouTube watch URL to embed URL
            $video_embed_url = str_replace("watch?v=", "embed/", $post['video_url']);
        ?>
            <div class="video-container">
                <iframe src="<?php echo htmlspecialchars($video_embed_url); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php endif; ?>
    </div>
    <?php
} else {
    // If no post is found, include a 404 message
    include '404.php';
}

$stmt->close();
$conn->close();
?>

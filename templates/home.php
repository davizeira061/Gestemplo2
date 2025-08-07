<style>
    .welcome-section { text-align: center; padding: 2rem 0; }
    .post-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; }
    .post-card { border: 1px solid #eee; border-radius: 5px; overflow: hidden; }
    .post-card img { max-width: 100%; height: auto; }
    .post-card-content { padding: 1rem; }
    .post-card h3 { margin-top: 0; }
    .post-card a { text-decoration: none; color: inherit; }
</style>

<div class="welcome-section">
    <h1>Bem-vindo à nossa Igreja</h1>
    <p>Um lugar para pertencer, crer e crescer.</p>
</div>

<?php
$conn = connect_db();

// Fetch latest news
$news_result = $conn->query("SELECT id, title, content, image_url FROM posts WHERE type = 'news' ORDER BY created_at DESC LIMIT 3");

// Fetch upcoming events
$events_result = $conn->query("SELECT id, title, content, image_url, event_date FROM posts WHERE type = 'event' AND event_date >= NOW() ORDER BY event_date ASC LIMIT 3");
?>

<section class="latest-news">
    <h2>Últimas Notícias</h2>
    <div class="post-grid">
        <?php if ($news_result && $news_result->num_rows > 0): ?>
            <?php while($post = $news_result->fetch_assoc()): ?>
                <div class="post-card">
                    <a href="news/<?php echo $post['id']; ?>">
                        <?php if ($post['image_url']): ?>
                            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                        <?php endif; ?>
                        <div class="post-card-content">
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 100)); ?>...</p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhuma notícia encontrada.</p>
        <?php endif; ?>
    </div>
</section>

<section class="upcoming-events" style="margin-top: 2rem;">
    <h2>Próximos Eventos</h2>
    <div class="post-grid">
        <?php if ($events_result && $events_result->num_rows > 0): ?>
            <?php while($post = $events_result->fetch_assoc()): ?>
                <div class="post-card">
                     <a href="events/<?php echo $post['id']; ?>">
                        <?php if ($post['image_url']): ?>
                            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                        <?php endif; ?>
                        <div class="post-card-content">
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($post['event_date'])); ?></p>
                            <p><?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 100)); ?>...</p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum evento próximo encontrado.</p>
        <?php endif; ?>
    </div>
</section>

<?php
$conn->close();
?>

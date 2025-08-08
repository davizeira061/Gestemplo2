<?php
session_start();
require_once '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "/public/login.php");
    exit();
}

$conn = connect_db();

// Filter logic
$filter_type = isset($_GET['type']) ? $_GET['type'] : '';
$sql = "SELECT id, type, title, event_date, updated_at FROM posts";
if (!empty($filter_type)) {
    $sql .= " WHERE type = ?";
}
$sql .= " ORDER BY updated_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($filter_type)) {
    $stmt->bind_param("s", $filter_type);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts</title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        .header { background: #333; color: #fff; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: #fff; text-decoration: none; }
        .container { padding: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: 0.5rem; text-align: left; }
        th { background-color: #f4f4f4; }
        .actions a { margin-right: 10px; }
        .add-button { display: inline-block; padding: 0.7rem 1rem; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 3px; margin-bottom: 1rem; }
        .filter-form { margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Manage Posts</h1>
        <div>
            <a href="index.php">Dashboard</a> |
            <a href="<?php echo BASE_URL; ?>/src/auth.php?action=logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <a href="edit_post.php" class="add-button">Add New Post</a>

        <form class="filter-form" action="<?php echo BASE_URL; ?>/public/admin/manage_posts.php" method="get">
            <label for="type">Filter by type:</label>
            <select name="type" id="type" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="news" <?php echo ($filter_type === 'news') ? 'selected' : ''; ?>>News</option>
                <option value="event" <?php echo ($filter_type === 'event') ? 'selected' : ''; ?>>Event</option>
                <option value="sermon" <?php echo ($filter_type === 'sermon') ? 'selected' : ''; ?>>Sermon</option>
            </select>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Event Date</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($row['type'])); ?></td>
                            <td><?php echo htmlspecialchars($row['event_date'] ? date('Y-m-d H:i', strtotime($row['event_date'])) : 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($row['updated_at']); ?></td>
                            <td class="actions">
                                <a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_post.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No posts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

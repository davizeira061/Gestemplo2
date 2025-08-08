<?php
session_start();
require_once '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "/public/login.php");
    exit();
}

$conn = connect_db();
$result = $conn->query("SELECT id, slug, title, updated_at FROM pages ORDER BY title ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pages</title>
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Manage Pages</h1>
        <div>
            <a href="index.php">Dashboard</a> |
            <a href="<?php echo BASE_URL; ?>/src/auth.php?action=logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <a href="edit_page.php" class="add-button">Add New Page</a>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['slug']); ?></td>
                            <td><?php echo htmlspecialchars($row['updated_at']); ?></td>
                            <td class="actions">
                                <a href="edit_page.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_page.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this page?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No pages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>

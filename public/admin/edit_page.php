<?php
session_start();
require_once '../../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$conn = connect_db();
$page = [
    'id' => '',
    'title' => '',
    'slug' => '',
    'content' => ''
];
$page_title = 'Add New Page';
$error = '';
$success = '';

// Function to create a URL-friendly slug
function create_slug($string) {
   $string = strtolower($string);
   $string = preg_replace('/[^a-z0-9_\s-]/', '', $string);
   $string = preg_replace('/[\s-]+/', '-', $string);
   $string = trim($string, '-');
   return $string;
}

// Check if an ID is provided for editing
if (isset($_GET['id'])) {
    $page_id = (int)$_GET['id'];
    $stmt = $conn->prepare("SELECT id, title, slug, content FROM pages WHERE id = ?");
    $stmt->bind_param("i", $page_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $page = $result->fetch_assoc();
        $page_title = 'Edit Page';
    }
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page_id = (int)$_POST['id'];
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($content)) {
        $error = 'Title and content are required.';
    } else {
        // Create a slug from the title if the slug is empty
        if (empty($slug)) {
            $slug = create_slug($title);
        } else {
            $slug = create_slug($slug); // Sanitize the provided slug as well
        }

        if ($page_id > 0) {
            // Update existing page
            $stmt = $conn->prepare("UPDATE pages SET title = ?, slug = ?, content = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $slug, $content, $page_id);
            if ($stmt->execute()) {
                $success = 'Page updated successfully!';
                // Refresh page data to show updated values
                $page = ['id' => $page_id, 'title' => $title, 'slug' => $slug, 'content' => $content];
            } else {
                $error = 'Error updating page: ' . $conn->error;
            }
        } else {
            // Insert new page
            $stmt = $conn->prepare("INSERT INTO pages (title, slug, content) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $slug, $content);
            if ($stmt->execute()) {
                // Redirect to edit page with the new ID
                header("Location: edit_page.php?id=" . $conn->insert_id . "&new=1");
                exit();
            } else {
                 if ($conn->errno == 1062) { // 1062 is the MySQL error code for duplicate entry
                    $error = 'Error: A page with this slug already exists.';
                } else {
                    $error = 'Error creating page: ' . $conn->error;
                }
            }
        }
        $stmt->close();
    }
}

// Show a success message on new page creation
if (isset($_GET['new'])) {
    $success = 'Page created successfully!';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        .header { background: #333; color: #fff; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: #fff; text-decoration: none; }
        .container { padding: 2rem; max-width: 800px; margin: 0 auto; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; }
        input[type="text"], textarea { width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 3px; }
        textarea { min-height: 200px; }
        button { padding: 0.7rem 1.5rem; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer; }
        .slug-note { font-size: 0.9rem; color: #666; }
        .error { color: red; background: #ffebeb; padding: 1rem; border-radius: 3px; margin-bottom: 1rem; }
        .success { color: green; background: #e6ffed; padding: 1rem; border-radius: 3px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo htmlspecialchars($page_title); ?></h1>
        <div>
            <a href="manage_pages.php">Back to Pages</a> |
            <a href="../../src/auth.php?action=logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <?php if ($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
        <?php if ($success): ?><div class="success"><?php echo $success; ?></div><?php endif; ?>

        <form action="edit_page.php<?php echo $page['id'] ? '?id='.$page['id'] : ''; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $page['id']; ?>">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($page['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($page['slug']); ?>">
                <p class="slug-note">A unique, URL-friendly version of the title. Leave blank to auto-generate.</p>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($page['content']); ?></textarea>
            </div>

            <button type="submit">Save Page</button>
        </form>
    </div>
</body>
</html>

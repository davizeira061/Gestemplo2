<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$conn = connect_db();
$post = [
    'id' => '',
    'type' => 'news',
    'title' => '',
    'content' => '',
    'image_url' => '',
    'video_url' => '',
    'event_date' => ''
];
$page_title = 'Add New Post';
$error = '';
$success = '';

// Check if an ID is provided for editing
if (isset($_GET['id'])) {
    $post_id = (int)$_GET['id'];
    $stmt = $conn->prepare("SELECT id, type, title, content, image_url, video_url, event_date FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $page_title = 'Edit Post';
    }
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = (int)$_POST['id'];
    $type = $_POST['type'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $video_url = trim($_POST['video_url']);
    $event_date = !empty($_POST['event_date']) ? $_POST['event_date'] : null;
    $current_image = $_POST['current_image'];
    $image_url = $current_image; // Default to current image

    if (empty($title) || empty($content) || empty($type)) {
        $error = 'Type, title, and content are required.';
    } else {
        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check === false) {
                $error = "File is not an image.";
            } else {
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image_url = "uploads/" . basename($_FILES["image"]["name"]);
                    } else {
                        $error = "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        if (empty($error)) {
            if ($post_id > 0) {
                // Update existing post
                $stmt = $conn->prepare("UPDATE posts SET type = ?, title = ?, content = ?, image_url = ?, video_url = ?, event_date = ? WHERE id = ?");
                $stmt->bind_param("ssssssi", $type, $title, $content, $image_url, $video_url, $event_date, $post_id);
                if ($stmt->execute()) {
                    $success = 'Post updated successfully!';
                    // Refresh post data
                    $post = ['id' => $post_id, 'type' => $type, 'title' => $title, 'content' => $content, 'image_url' => $image_url, 'video_url' => $video_url, 'event_date' => $event_date];
                } else {
                    $error = 'Error updating post: ' . $conn->error;
                }
            } else {
                // Insert new post
                $stmt = $conn->prepare("INSERT INTO posts (type, title, content, image_url, video_url, event_date) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $type, $title, $content, $image_url, $video_url, $event_date);
                if ($stmt->execute()) {
                    header("Location: edit_post.php?id=" . $conn->insert_id . "&new=1");
                    exit();
                } else {
                    $error = 'Error creating post: ' . $conn->error;
                }
            }
            $stmt->close();
        }
    }
}

if (isset($_GET['new'])) {
    $success = 'Post created successfully!';
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
        /* Re-using styles from edit_page.php for consistency */
        body { font-family: sans-serif; margin: 0; }
        .header { background: #333; color: #fff; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: #fff; text-decoration: none; }
        .container { padding: 2rem; max-width: 800px; margin: 0 auto; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; }
        input[type="text"], input[type="datetime-local"], select, textarea { width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 3px; }
        textarea { min-height: 200px; }
        button { padding: 0.7rem 1.5rem; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer; }
        .error { color: red; background: #ffebeb; padding: 1rem; border-radius: 3px; margin-bottom: 1rem; }
        .success { color: green; background: #e6ffed; padding: 1rem; border-radius: 3px; margin-bottom: 1rem; }
        .current-image { max-width: 200px; display: block; margin-top: 0.5rem; }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo htmlspecialchars($page_title); ?></h1>
        <div>
            <a href="manage_posts.php">Back to Posts</a> |
            <a href="../../src/auth.php?action=logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <?php if ($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
        <?php if ($success): ?><div class="success"><?php echo $success; ?></div><?php endif; ?>

        <form action="edit_post.php<?php echo $post['id'] ? '?id='.$post['id'] : ''; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($post['image_url']); ?>">

            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" required>
                    <option value="news" <?php echo ($post['type'] === 'news') ? 'selected' : ''; ?>>News</option>
                    <option value="event" <?php echo ($post['type'] === 'event') ? 'selected' : ''; ?>>Event</option>
                    <option value="sermon" <?php echo ($post['type'] === 'sermon') ? 'selected' : ''; ?>>Sermon</option>
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image">
                <?php if ($post['image_url']): ?>
                    <p>Current image:</p>
                    <img src="../<?php echo htmlspecialchars($post['image_url']); ?>" alt="Current Image" class="current-image">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="video_url">Video URL (e.g., YouTube)</label>
                <input type="text" id="video_url" name="video_url" value="<?php echo htmlspecialchars($post['video_url']); ?>">
            </div>

            <div class="form-group">
                <label for="event_date">Event Date (for events)</label>
                <input type="datetime-local" id="event_date" name="event_date" value="<?php echo !empty($post['event_date']) ? date('Y-m-d\TH:i', strtotime($post['event_date'])) : ''; ?>">
            </div>

            <button type="submit">Save Post</button>
        </form>
    </div>
</body>
</html>

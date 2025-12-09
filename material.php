<?php
require_once 'config.php';
requireLogin();

$materialId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userId = getCurrentUserId();

if ($materialId <= 0) {
    header("Location: courses.php");
    exit();
}

$conn = getDBConnection();

// Get material details
$stmt = $conn->prepare("SELECT m.*, c.id as course_id, c.title as course_title FROM materials m INNER JOIN courses c ON m.course_id = c.id WHERE m.id = ?");
$stmt->bind_param("i", $materialId);
$stmt->execute();
$material = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$material) {
    header("Location: courses.php");
    exit();
}

// Check if user is enrolled
$stmt = $conn->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
$stmt->bind_param("ii", $userId, $material['course_id']);
$stmt->execute();
$enrollment = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$enrollment) {
    header("Location: course.php?id=" . $material['course_id']);
    exit();
}

// Handle marking as complete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_complete'])) {
    $completedAt = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO material_progress (user_id, material_id, completed, completed_at) VALUES (?, ?, 1, ?) ON DUPLICATE KEY UPDATE completed = 1, completed_at = ?");
    $stmt->bind_param("iiss", $userId, $materialId, $completedAt, $completedAt);
    $stmt->execute();
    $stmt->close();
    header("Location: course.php?id=" . $material['course_id']);
    exit();
}

// Check if already completed
$stmt = $conn->prepare("SELECT completed FROM material_progress WHERE user_id = ? AND material_id = ?");
$stmt->bind_param("ii", $userId, $materialId);
$stmt->execute();
$result = $stmt->get_result();
$progress = $result->fetch_assoc();
$isCompleted = $progress && $progress['completed'];
$stmt->close();

// Get next material
$stmt = $conn->prepare("SELECT id, title FROM materials WHERE course_id = ? AND order_index > ? ORDER BY order_index ASC LIMIT 1");
$stmt->bind_param("ii", $material['course_id'], $material['order_index']);
$stmt->execute();
$nextMaterial = $stmt->get_result()->fetch_assoc();
$stmt->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($material['title']); ?> - ProTeach</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <nav>
        <div class="container">
            <a href="index.php" class="nav-brand">ProTeach</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php" class="btn btn-secondary">Logout</a></li>
            </ul>
        </div>
    </nav>

    <section style="padding: 2rem 0; background-color: var(--primary-color); color: white;">
        <div class="container">
            <div style="margin-bottom: 0.5rem;">
                <a href="course.php?id=<?php echo $material['course_id']; ?>" style="color: white; text-decoration: none; opacity: 0.9;">
                    ← Back to <?php echo htmlspecialchars($material['course_title']); ?>
                </a>
            </div>
            <h1 style="font-size: 2.5rem;"><?php echo htmlspecialchars($material['title']); ?></h1>
            <p style="font-size: 1.125rem; opacity: 0.9;">Material Type: <?php echo ucfirst($material['material_type']); ?></p>
        </div>
    </section>

    <section style="padding: 3rem 0;">
        <div class="container" style="max-width: 900px;">
            <?php if ($isCompleted): ?>
                <div class="alert alert-success">
                    ✓ You have completed this material
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-body" style="font-size: 1.125rem; line-height: 1.8;">
                    <?php echo nl2br(htmlspecialchars($material['content'])); ?>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <?php if (!$isCompleted): ?>
                    <form method="POST" action="">
                        <button type="submit" name="mark_complete" class="btn btn-success">Mark as Complete</button>
                    </form>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>

                <?php if ($nextMaterial): ?>
                    <a href="material.php?id=<?php echo $nextMaterial['id']; ?>" class="btn btn-primary">
                        Next: <?php echo htmlspecialchars($nextMaterial['title']); ?> →
                    </a>
                <?php else: ?>
                    <a href="course.php?id=<?php echo $material['course_id']; ?>" class="btn btn-primary">
                        Back to Course →
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 ProTeach - Online Teacher Training Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

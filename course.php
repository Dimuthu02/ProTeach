<?php
require_once 'config.php';
requireLogin();

$courseId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userId = getCurrentUserId();
$user = getCurrentUser();

if ($courseId <= 0) {
    header("Location: courses.php");
    exit();
}

$conn = getDBConnection();

// Get course details
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $courseId);
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$course) {
    header("Location: courses.php");
    exit();
}

// Check enrollment status
$stmt = $conn->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
$stmt->bind_param("ii", $userId, $courseId);
$stmt->execute();
$enrollment = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Handle enrollment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll'])) {
    if (!$enrollment) {
        $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $courseId);
        $stmt->execute();
        $stmt->close();
        header("Location: course.php?id=" . $courseId);
        exit();
    }
}

// Get course materials
$stmt = $conn->prepare("SELECT * FROM materials WHERE course_id = ? ORDER BY order_index ASC");
$stmt->bind_param("i", $courseId);
$stmt->execute();
$materials = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Get material progress if enrolled
$materialProgress = [];
if ($enrollment) {
    $stmt = $conn->prepare("SELECT material_id, completed FROM material_progress WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $materialProgress[$row['material_id']] = $row['completed'];
    }
    $stmt->close();
}

// Get assessments
$stmt = $conn->prepare("SELECT * FROM assessments WHERE course_id = ?");
$stmt->bind_param("i", $courseId);
$stmt->execute();
$assessments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate progress
$completionPercentage = 0;
if ($enrollment && !empty($materials)) {
    $completedCount = 0;
    foreach ($materials as $material) {
        if (isset($materialProgress[$material['id']]) && $materialProgress[$material['id']]) {
            $completedCount++;
        }
    }
    $completionPercentage = ($completedCount / count($materials)) * 100;
    
    // Update progress in database
    $stmt = $conn->prepare("UPDATE enrollments SET completion_percentage = ? WHERE user_id = ? AND course_id = ?");
    $stmt->bind_param("dii", $completionPercentage, $userId, $courseId);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - ProTeach</title>
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
            <h1 style="font-size: 2.5rem;"><?php echo htmlspecialchars($course['title']); ?></h1>
            <p style="font-size: 1.125rem; opacity: 0.9;"><?php echo htmlspecialchars($course['description']); ?></p>
            <div style="margin-top: 1rem;">
                <span style="margin-right: 2rem;">⏱️ <?php echo $course['duration_hours']; ?> hours</span>
                <span>📁 <?php echo htmlspecialchars($course['category']); ?></span>
            </div>
        </div>
    </section>

    <section style="padding: 3rem 0;">
        <div class="container">
            <?php if (!$enrollment): ?>
                <div class="card">
                    <div class="card-header">Enroll in This Course</div>
                    <div class="card-body">
                        <p>Start your learning journey with this course. Click the button below to enroll.</p>
                        <form method="POST" action="" style="margin-top: 1rem;">
                            <button type="submit" name="enroll" class="btn btn-primary">Enroll Now</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <!-- Progress Bar -->
                <div class="card mb-4">
                    <div class="card-header">Your Progress</div>
                    <div class="card-body">
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: <?php echo $completionPercentage; ?>%;">
                                <?php echo number_format($completionPercentage, 0); ?>%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Learning Materials -->
                <div class="card mb-4">
                    <div class="card-header">Learning Materials</div>
                    <div class="card-body">
                        <?php if (empty($materials)): ?>
                            <p>No materials available yet.</p>
                        <?php else: ?>
                            <ul class="material-list">
                                <?php foreach ($materials as $material): ?>
                                    <li class="material-item">
                                        <div class="material-icon">📄</div>
                                        <div class="material-info">
                                            <div class="material-title">
                                                <a href="material.php?id=<?php echo $material['id']; ?>" style="text-decoration: none; color: var(--text-primary);">
                                                    <?php echo htmlspecialchars($material['title']); ?>
                                                </a>
                                            </div>
                                            <div class="material-type"><?php echo ucfirst($material['material_type']); ?></div>
                                        </div>
                                        <?php if (isset($materialProgress[$material['id']]) && $materialProgress[$material['id']]): ?>
                                            <div class="material-complete">✓ Completed</div>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Assessments -->
                <?php if (!empty($assessments)): ?>
                    <div class="card">
                        <div class="card-header">Assessments</div>
                        <div class="card-body">
                            <ul class="material-list">
                                <?php foreach ($assessments as $assessment): ?>
                                    <li class="material-item">
                                        <div class="material-icon">📝</div>
                                        <div class="material-info">
                                            <div class="material-title"><?php echo htmlspecialchars($assessment['title']); ?></div>
                                            <div class="material-type"><?php echo htmlspecialchars($assessment['description']); ?></div>
                                        </div>
                                        <a href="assessment.php?id=<?php echo $assessment['id']; ?>" class="btn btn-primary">Take Assessment</a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 ProTeach - Online Teacher Training Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

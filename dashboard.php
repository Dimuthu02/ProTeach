<?php
require_once 'config.php';
requireLogin();

$conn = getDBConnection();
$userId = getCurrentUserId();
$user = getCurrentUser();

// Get user's enrolled courses with progress
$enrolledQuery = "
    SELECT c.*, e.enrolled_at, e.completion_percentage, e.status
    FROM courses c
    INNER JOIN enrollments e ON c.id = e.course_id
    WHERE e.user_id = ?
    ORDER BY e.enrolled_at DESC
";
$stmt = $conn->prepare($enrolledQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$enrolledCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Get statistics
$statsQuery = "
    SELECT 
        COUNT(DISTINCT e.course_id) as total_courses,
        COUNT(DISTINCT CASE WHEN e.status = 'completed' THEN e.course_id END) as completed_courses,
        COALESCE(AVG(e.completion_percentage), 0) as avg_progress
    FROM enrollments e
    WHERE e.user_id = ?
";
$stmt = $conn->prepare($statsQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stats = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Get recent assessment attempts
$assessmentQuery = "
    SELECT a.title, aa.score, aa.passed, aa.completed_at, c.title as course_title
    FROM assessment_attempts aa
    INNER JOIN assessments a ON aa.assessment_id = a.id
    INNER JOIN courses c ON a.course_id = c.id
    WHERE aa.user_id = ?
    ORDER BY aa.completed_at DESC
    LIMIT 5
";
$stmt = $conn->prepare($assessmentQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$recentAttempts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ProTeach</title>
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
            <h1 style="font-size: 2.5rem;">Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
            <p style="font-size: 1.125rem; opacity: 0.9;">Track your learning progress and continue your courses</p>
        </div>
    </section>

    <section style="padding: 3rem 0;">
        <div class="container">
            <!-- Statistics -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-value"><?php echo $stats['total_courses']; ?></div>
                    <div class="stat-label">Enrolled Courses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?php echo $stats['completed_courses']; ?></div>
                    <div class="stat-label">Completed Courses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?php echo number_format($stats['avg_progress'], 0); ?>%</div>
                    <div class="stat-label">Average Progress</div>
                </div>
            </div>

            <!-- Enrolled Courses -->
            <h2 style="font-size: 1.75rem; margin-bottom: 1.5rem;">My Courses</h2>
            <?php if (empty($enrolledCourses)): ?>
                <div class="card">
                    <div class="card-body text-center">
                        <p>You haven't enrolled in any courses yet.</p>
                        <a href="courses.php" class="btn btn-primary mt-3">Browse Courses</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-2">
                    <?php foreach ($enrolledCourses as $course): ?>
                        <div class="course-card">
                            <div class="course-card-header">
                                <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                            </div>
                            <div class="course-card-body">
                                <p class="course-card-description"><?php echo htmlspecialchars($course['description']); ?></p>
                                <div class="course-card-meta mb-2">
                                    <span>⏱️ <?php echo $course['duration_hours']; ?> hours</span>
                                    <span>📁 <?php echo htmlspecialchars($course['category']); ?></span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-bar-fill" style="width: <?php echo $course['completion_percentage']; ?>%;">
                                        <?php echo number_format($course['completion_percentage'], 0); ?>%
                                    </div>
                                </div>
                                <a href="course.php?id=<?php echo $course['id']; ?>" class="btn btn-primary mt-2">Continue Learning</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Recent Assessment Results -->
            <?php if (!empty($recentAttempts)): ?>
                <h2 style="font-size: 1.75rem; margin: 3rem 0 1.5rem;">Recent Assessment Results</h2>
                <div class="card">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--border-color);">
                                <th style="text-align: left; padding: 1rem;">Assessment</th>
                                <th style="text-align: left; padding: 1rem;">Course</th>
                                <th style="text-align: center; padding: 1rem;">Score</th>
                                <th style="text-align: center; padding: 1rem;">Status</th>
                                <th style="text-align: left; padding: 1rem;">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentAttempts as $attempt): ?>
                                <tr style="border-bottom: 1px solid var(--border-color);">
                                    <td style="padding: 1rem;"><?php echo htmlspecialchars($attempt['title']); ?></td>
                                    <td style="padding: 1rem;"><?php echo htmlspecialchars($attempt['course_title']); ?></td>
                                    <td style="text-align: center; padding: 1rem;"><?php echo number_format($attempt['score'], 0); ?>%</td>
                                    <td style="text-align: center; padding: 1rem;">
                                        <span style="color: <?php echo $attempt['passed'] ? 'var(--success-color)' : 'var(--danger-color)'; ?>; font-weight: 600;">
                                            <?php echo $attempt['passed'] ? '✓ Passed' : '✗ Failed'; ?>
                                        </span>
                                    </td>
                                    <td style="padding: 1rem;"><?php echo date('M d, Y', strtotime($attempt['completed_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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

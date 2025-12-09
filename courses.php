<?php
require_once 'config.php';

$conn = getDBConnection();

// Get all courses
$query = "SELECT * FROM courses ORDER BY created_at DESC";
$result = $conn->query($query);
$courses = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

$isLoggedIn = isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - ProTeach</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="index.php" class="nav-brand">ProTeach</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="courses.php">Courses</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php" class="btn btn-secondary">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php" class="btn btn-primary">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <section style="padding: 2rem 0; background-color: var(--primary-color); color: white;">
        <div class="container">
            <h1 style="font-size: 2.5rem;">Browse Courses</h1>
            <p style="font-size: 1.125rem; opacity: 0.9;">Explore our comprehensive teacher training courses</p>
        </div>
    </section>

    <section style="padding: 3rem 0;">
        <div class="container">
            <div class="grid grid-cols-2">
                <?php foreach ($courses as $course): ?>
                    <div class="course-card">
                        <div class="course-card-header">
                            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                        </div>
                        <div class="course-card-body">
                            <p class="course-card-description"><?php echo htmlspecialchars($course['description']); ?></p>
                            <div class="course-card-meta">
                                <span>⏱️ <?php echo $course['duration_hours']; ?> hours</span>
                                <span>📁 <?php echo htmlspecialchars($course['category']); ?></span>
                            </div>
                            <?php if ($isLoggedIn): ?>
                                <a href="course.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">View Course</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-primary">Login to Enroll</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProTeach - Online Teacher Training Platform</title>
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
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="btn btn-primary">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1>Welcome to ProTeach</h1>
            <p>Enhance your teaching skills anytime, anywhere with our comprehensive online training platform</p>
            <a href="register.php" class="btn btn-primary" style="margin-right: 1rem;">Get Started</a>
            <a href="courses.php" class="btn btn-outline">Browse Courses</a>
        </div>
    </section>

    <section style="padding: 4rem 0;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 3rem; font-size: 2rem;">Why Choose ProTeach?</h2>
            <div class="grid grid-cols-3">
                <div class="card">
                    <div class="card-header">📚 Comprehensive Courses</div>
                    <div class="card-body">
                        Access a wide range of teacher training courses covering classroom management, technology integration, assessment strategies, and more.
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">🎯 Interactive Learning</div>
                    <div class="card-body">
                        Engage with interactive materials, videos, and assessments designed to enhance your professional development effectively.
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">📊 Progress Tracking</div>
                    <div class="card-body">
                        Monitor your learning journey with detailed progress tracking and completion certificates for finished courses.
                    </div>
                </div>
            </div>

            <h2 style="text-align: center; margin: 4rem 0 2rem; font-size: 2rem;">Featured Courses</h2>
            <div class="grid grid-cols-2">
                <div class="course-card">
                    <div class="course-card-header">
                        <h3>Effective Classroom Management</h3>
                    </div>
                    <div class="course-card-body">
                        <p class="course-card-description">Learn strategies for managing diverse classrooms and creating positive learning environments.</p>
                        <div class="course-card-meta">
                            <span>⏱️ 20 hours</span>
                            <span>📁 Teaching Methods</span>
                        </div>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-card-header">
                        <h3>Digital Teaching Tools</h3>
                    </div>
                    <div class="course-card-body">
                        <p class="course-card-description">Master modern educational technology and online teaching platforms.</p>
                        <div class="course-card-meta">
                            <span>⏱️ 15 hours</span>
                            <span>📁 Technology</span>
                        </div>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <a href="courses.php" class="btn btn-secondary">View All Courses</a>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup - ProTeach</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="index.php" class="nav-brand">ProTeach</a>
        </div>
    </nav>

    <div class="container" style="max-width: 800px; margin: 4rem auto;">
        <div class="card">
            <h2 class="card-header text-center">ProTeach Setup Instructions</h2>
            <div class="card-body">
                <h3 style="margin-top: 1.5rem; margin-bottom: 1rem;">Database Setup</h3>
                <ol style="line-height: 2; margin-left: 1.5rem;">
                    <li>Create a MySQL database named <code style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">proteach</code></li>
                    <li>Import the database schema using the <code style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">database.sql</code> file:
                        <pre style="background: #1f2937; color: #f9fafb; padding: 1rem; border-radius: 0.375rem; margin-top: 0.5rem; overflow-x: auto;">mysql -u root -p proteach < database.sql</pre>
                    </li>
                </ol>

                <h3 style="margin-top: 2rem; margin-bottom: 1rem;">Configuration</h3>
                <ol style="line-height: 2; margin-left: 1.5rem;">
                    <li>Open <code style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">config.php</code></li>
                    <li>Update database credentials if needed:
                        <pre style="background: #1f2937; color: #f9fafb; padding: 1rem; border-radius: 0.375rem; margin-top: 0.5rem; overflow-x: auto;">define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'proteach');</pre>
                    </li>
                </ol>

                <h3 style="margin-top: 2rem; margin-bottom: 1rem;">Testing the Setup</h3>
                <ol style="line-height: 2; margin-left: 1.5rem;">
                    <li>Navigate to the homepage: <a href="index.php">index.php</a></li>
                    <li>Register a new account</li>
                    <li>Login with your credentials</li>
                    <li>Browse and enroll in courses</li>
                    <li>Access learning materials</li>
                    <li>Complete assessments</li>
                </ol>

                <div class="alert alert-info" style="margin-top: 2rem;">
                    <strong>📚 Sample Data:</strong> The database includes 4 sample courses, 8 learning materials, 
                    3 assessments, and 7 questions to help you get started immediately.
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="index.php" class="btn btn-primary">Go to Homepage</a>
                    <a href="register.php" class="btn btn-secondary" style="margin-left: 1rem;">Register Now</a>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 2rem;">
            <h2 class="card-header">System Requirements</h2>
            <div class="card-body">
                <ul style="line-height: 2; margin-left: 1.5rem;">
                    <li>PHP 7.4 or higher</li>
                    <li>MySQL 5.7 or higher</li>
                    <li>Web server (Apache, Nginx, or PHP built-in server)</li>
                    <li>Modern web browser (Chrome, Firefox, Safari, Edge)</li>
                </ul>
            </div>
        </div>

        <div class="card" style="margin-top: 2rem;">
            <h2 class="card-header">Need Help?</h2>
            <div class="card-body">
                <p>If you encounter any issues during setup:</p>
                <ul style="line-height: 2; margin-left: 1.5rem;">
                    <li>Check that MySQL is running</li>
                    <li>Verify database credentials in config.php</li>
                    <li>Ensure PHP has mysqli extension enabled</li>
                    <li>Check file permissions</li>
                    <li>Review the README.md file for detailed instructions</li>
                </ul>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 ProTeach - Online Teacher Training Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
require_once 'config.php';
requireLogin();

$assessmentId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userId = getCurrentUserId();

if ($assessmentId <= 0) {
    header("Location: courses.php");
    exit();
}

$conn = getDBConnection();

// Get assessment details
$stmt = $conn->prepare("
    SELECT a.*, c.id as course_id, c.title as course_title 
    FROM assessments a 
    INNER JOIN courses c ON a.course_id = c.id 
    WHERE a.id = ?
");
$stmt->bind_param("i", $assessmentId);
$stmt->execute();
$assessment = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$assessment) {
    header("Location: courses.php");
    exit();
}

// Check if user is enrolled
$stmt = $conn->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
$stmt->bind_param("ii", $userId, $assessment['course_id']);
$stmt->execute();
$enrollment = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$enrollment) {
    header("Location: course.php?id=" . $assessment['course_id']);
    exit();
}

// Get questions
$stmt = $conn->prepare("SELECT * FROM questions WHERE assessment_id = ? ORDER BY id ASC");
$stmt->bind_param("i", $assessmentId);
$stmt->execute();
$questions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Handle submission
$submitted = false;
$score = 0;
$totalPoints = 0;
$passed = false;
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_assessment'])) {
    $correctAnswers = 0;
    
    foreach ($questions as $question) {
        $totalPoints += $question['points'];
        $userAnswer = $_POST['question_' . $question['id']] ?? '';
        $isCorrect = ($userAnswer === $question['correct_answer']);
        
        if ($isCorrect) {
            $correctAnswers += $question['points'];
        }
        
        $results[$question['id']] = [
            'user_answer' => $userAnswer,
            'correct_answer' => $question['correct_answer'],
            'is_correct' => $isCorrect
        ];
    }
    
    $score = ($totalPoints > 0) ? ($correctAnswers / $totalPoints) * 100 : 0;
    $passed = ($score >= $assessment['passing_score']);
    
    // Save attempt
    $stmt = $conn->prepare("INSERT INTO assessment_attempts (user_id, assessment_id, score, total_points, passed) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iidii", $userId, $assessmentId, $score, $totalPoints, $passed);
    $stmt->execute();
    $stmt->close();
    
    $submitted = true;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($assessment['title']); ?> - ProTeach</title>
    <link rel="stylesheet" href="style.css">
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
                <a href="course.php?id=<?php echo $assessment['course_id']; ?>" style="color: white; text-decoration: none; opacity: 0.9;">
                    ← Back to <?php echo htmlspecialchars($assessment['course_title']); ?>
                </a>
            </div>
            <h1 style="font-size: 2.5rem;"><?php echo htmlspecialchars($assessment['title']); ?></h1>
            <p style="font-size: 1.125rem; opacity: 0.9;"><?php echo htmlspecialchars($assessment['description']); ?></p>
            <p style="opacity: 0.9;">Passing Score: <?php echo number_format($assessment['passing_score'], 0); ?>%</p>
        </div>
    </section>

    <section style="padding: 3rem 0;">
        <div class="container" style="max-width: 900px;">
            <?php if ($submitted): ?>
                <div class="card mb-4" style="background: linear-gradient(135deg, <?php echo $passed ? 'var(--success-color)' : 'var(--danger-color)'; ?> 0%, <?php echo $passed ? '#059669' : '#dc2626'; ?> 100%); color: white;">
                    <div class="card-body text-center">
                        <h2 style="font-size: 2rem; margin-bottom: 1rem;">
                            <?php echo $passed ? '🎉 Congratulations!' : '📚 Keep Learning!'; ?>
                        </h2>
                        <p style="font-size: 1.5rem; font-weight: bold;">Your Score: <?php echo number_format($score, 1); ?>%</p>
                        <p style="font-size: 1.125rem; margin-top: 0.5rem;">
                            <?php echo $passed ? 'You have passed this assessment!' : 'You did not pass this time. Review the materials and try again.'; ?>
                        </p>
                    </div>
                </div>

                <!-- Show results -->
                <?php foreach ($questions as $index => $question): ?>
                    <?php $result = $results[$question['id']]; ?>
                    <div class="question-card" style="border-left: 4px solid <?php echo $result['is_correct'] ? 'var(--success-color)' : 'var(--danger-color)'; ?>;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                            <div class="question-text">
                                <strong>Question <?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($question['question_text']); ?>
                            </div>
                            <div style="color: <?php echo $result['is_correct'] ? 'var(--success-color)' : 'var(--danger-color)'; ?>; font-weight: bold; font-size: 1.5rem;">
                                <?php echo $result['is_correct'] ? '✓' : '✗'; ?>
                            </div>
                        </div>
                        
                        <div style="margin-left: 1rem;">
                            <p><strong>Your answer:</strong> 
                                <span style="color: <?php echo $result['is_correct'] ? 'var(--success-color)' : 'var(--danger-color)'; ?>;">
                                    <?php echo strtoupper($result['user_answer']) . ': ' . htmlspecialchars($question['option_' . $result['user_answer']]); ?>
                                </span>
                            </p>
                            <?php if (!$result['is_correct']): ?>
                                <p><strong>Correct answer:</strong> 
                                    <span style="color: var(--success-color);">
                                        <?php echo strtoupper($result['correct_answer']) . ': ' . htmlspecialchars($question['option_' . $result['correct_answer']]); ?>
                                    </span>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="course.php?id=<?php echo $assessment['course_id']; ?>" class="btn btn-primary">Back to Course</a>
                    <?php if (!$passed): ?>
                        <a href="assessment.php?id=<?php echo $assessmentId; ?>" class="btn btn-secondary" style="margin-left: 1rem;">Try Again</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info mb-4">
                    <p><strong>Instructions:</strong></p>
                    <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                        <li>This assessment contains <?php echo count($questions); ?> questions</li>
                        <li>You need to score at least <?php echo number_format($assessment['passing_score'], 0); ?>% to pass</li>
                        <li>Select the best answer for each question</li>
                        <li>Click "Submit Assessment" when you're ready</li>
                    </ul>
                </div>

                <form method="POST" action="" id="assessmentForm">
                    <?php foreach ($questions as $index => $question): ?>
                        <div class="question-card">
                            <div class="question-text">
                                <strong>Question <?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($question['question_text']); ?>
                            </div>
                            
                            <div class="option">
                                <label style="cursor: pointer; display: block;">
                                    <input type="radio" name="question_<?php echo $question['id']; ?>" value="a" required>
                                    <strong>A:</strong> <?php echo htmlspecialchars($question['option_a']); ?>
                                </label>
                            </div>
                            
                            <div class="option">
                                <label style="cursor: pointer; display: block;">
                                    <input type="radio" name="question_<?php echo $question['id']; ?>" value="b" required>
                                    <strong>B:</strong> <?php echo htmlspecialchars($question['option_b']); ?>
                                </label>
                            </div>
                            
                            <div class="option">
                                <label style="cursor: pointer; display: block;">
                                    <input type="radio" name="question_<?php echo $question['id']; ?>" value="c" required>
                                    <strong>C:</strong> <?php echo htmlspecialchars($question['option_c']); ?>
                                </label>
                            </div>
                            
                            <div class="option">
                                <label style="cursor: pointer; display: block;">
                                    <input type="radio" name="question_<?php echo $question['id']; ?>" value="d" required>
                                    <strong>D:</strong> <?php echo htmlspecialchars($question['option_d']); ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div style="text-align: center; margin-top: 2rem;">
                        <button type="submit" name="submit_assessment" class="btn btn-primary" style="padding: 1rem 3rem; font-size: 1.125rem;">
                            Submit Assessment
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 ProTeach - Online Teacher Training Platform. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Form submission confirmation
        document.getElementById('assessmentForm')?.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to submit this assessment? You cannot change your answers after submission.')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link rel="stylesheet" href="edusparkOnline\src\styles\insert.css">


</head>
<body>
    <center>
    <h1>Insert User Details</h1>
    </center>
    <form action= "./insert.inc.php" method="POST">
        <label for="UserID">User ID</label> <br>
        <input type="text" name="UserID" required>
        <br>
        <label for="CourseID">Course ID</label> <br>
        <input type="text" name="CourseID" required>
        <br>
        <label for="EnrollmentDate">Enrollment Date</label> <br>
        <input type="text" name="EnrollmentDate" required>
        <br>
        <label for="CompletionStatus">Completion Status</label> <br>
        <select name="CompletionStatus" required>
            <option value="Not Started">Not Started</option>
            <option value="In progress">In progress</option>
            <option value="Completed">Completed</option>
        </select>
        <br>
        <button type="submit"> Submit </button>
</form>


</body>
</html>
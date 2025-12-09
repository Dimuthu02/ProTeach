<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
    <link rel="stylesheet" href="src/styles/trainer-crud.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="src\styles\style.css">
    <link rel="stylesheet" href="src\styles\header.css">
    <link rel="stylesheet" href="src\styles\footer.css">
</head>

<body>
    <?php require 'header.php'; ?>
    <script src="src\js\home-header.js"></script>
    <br><br><br><br><br><br><br>
    <!-- Update course form -->

    <?php
    require_once 'connection.php';

    if (isset($_GET['CID'])) {  // get the CID from url
        $C_id = $_GET['CID'];  // equal CID to a variable
    
        // Select all courses according to CID
        $query = "SELECT * FROM coursedetails WHERE CID = $C_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $course = mysqli_fetch_assoc($result);  // Fetch course data
        } else {
            echo "<script>alert('Course not found.'); window.location.href = 'read_course.php';</script>";
            exit;
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Cname = $_POST['Cname'];
            $C_Description = $_POST['C_Description'];
            $C_category = $_POST['C_category'];
            $C_image = $_POST['C_image'];
            $Cbutton = $_POST['Cbutton'];

            // Query to update the course details
            $updateQuery = "UPDATE coursedetails SET
                            Cname = '$Cname',
                            C_Description = '$C_Description',
                            C_category = '$C_category',
                            C_image = '$C_image',
                            Cbutton = '$Cbutton'
                            WHERE CID = $C_id";

            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                echo "<script>alert('Course Updated Successfully!'); window.location.href = 'read_course.php';</script>";
                exit;
            } else {
                echo "<script>alert('Course Update Failed. Please Try Again.'); window.location.href = 'read_course.php'; </script>";
            }
        }

    }

    mysqli_close($conn);
    ?>

    <div class="updatecourse">
        <h2>Update Course</h2>
        <form method="POST" action="">
            <!-- Pre-fill the form with current course data -->
            <input type="text" name="Cname" placeholder="Course Name" required value="<?= $course['Cname'] ?>"><br>

            <textarea name="C_Description" placeholder="Course Description"
                required><?= $course['C_Description'] ?></textarea><br>

            <input type="text" name="C_category" placeholder="Course Category" required
                value="<?= $course['C_category'] ?>"><br>

            <input type="text" name="C_image" placeholder="Image URL" required value="<?= $course['C_image'] ?>"><br>

            <input type="text" name="Cbutton" placeholder="More Details Button URL" required
                value="<?= $course['Cbutton'] ?>"><br>

            <input type="submit" value="Update Course">
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="src\styles\style.css">
    <link rel="stylesheet" href="src\styles\header.css">
    <link rel="stylesheet" href="src\styles\footer.css">
    <link rel="stylesheet" href="src\styles\trainer-crud.css">

</head>

<body>

    <?php require 'header.php'; ?>
    <script src="src\js\home-header.js"></script>


    <br><br><br><br><br>
    <!--Add new course form -->
    <div class="addcourse">
        <h2>Add new course</h2>
        <form action="create-course.php" method="POST">
            <input type="text" name="Cname" placeholder="Course Name" required><br>
            <textarea name="C_Description" placeholder="Course Description" required>

            </textarea>
            <br>
            <input type="text" name="C_category" placeholder="Course category" required>
            <br>
            <input type="text" name="C_image" placeholder="Image URL" required><br>
            <input type="text" name="Cbutton" placeholder="More Details Button URL" required>
            <br>

            <input type="submit" value="Add New Course">
            <input type="reset" value="Reset">
        </form>


        <!--Read Courses From the Database -->
        <h3>Manage Courses</h3>
        <table>
            <tr>
                <th>Course Name</th>
                <th>Description</th>
                <th>category</th>
                <th>Actions</th>
            </tr>

            <?php
            //display courses from database
            require_once 'connection.php';
            $query = "SELECT * FROM coursedetails";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                <td>{$row['Cname']} </td>
                <td>{$row['C_Description']} </td>
                <td>{$row['C_category']} </td>
                <td class = 'action-buttons'>
                        <a href='course-update.php?CID={$row['CID']}' class='edit-btn'>Edit</a>
                        <a href='delete-course.php?CID={$row['CID']}' class='delete-btn'>Delete</a>
                </td>
                </tr>";
                }
            } else {
                echo "<tr> <td colspan = 4>No courses available.</td></tr>";
            }
            mysqli_close($conn);
            ?>
        </table>

    </div>


    <?php include 'footer.php'; ?>

</body>

</html>
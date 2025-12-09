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
    <link rel="stylesheet" href="src\styles\trainer.css">
</head>

<body>

    <?php require 'header.php'; ?>
    <script src="src\js\home-header.js"></script>

    <center>
        <br><br><br><br><br><br>

        <div class="userProfile">
            <h1>Welcome user !</h1><br>
            <img src="images\profile.webp" alt="user pic" width="200px" height="200px">
            <br>
            <br>
            <b>User name </b> - Mark Hanson
            <br><br><b>E-mail </b> - mark123@gmail.com
            <br><br> <b> Phone number </b> - 077-89719782
            <br><br><br>
            <a href="read_course.php"><button id="manage-courses">Manage Courses</button></a>
            <br><br><br>
            <button id="manage-events">Manage Events</button>
            <br>
        </div>

    </center>





    <?php include 'footer.php'; ?>

</body>

</html>
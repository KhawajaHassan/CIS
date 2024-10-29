<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Corner - Campus Information System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to the Teacher Corner</h1>
</header>

<div>
    <p>Here you can manage courses, view student performance, and more.</p>
    <!-- Additional content for teachers can go here -->
</div>

<footer>
    <p>&copy; 2024 BGSBU Campus Information System. All rights reserved.</p>
</footer>

</body>
</html>

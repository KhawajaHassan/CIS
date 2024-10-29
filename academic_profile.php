<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = "localhost"; // Change if needed
$db = "CISDATABASE"; // Database name
$user = "root"; // Database username
$pass = ""; // Database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch academic profile data for the logged-in user
$username = $_SESSION['username'];
$sql = "SELECT * FROM academic_profile WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$profile_data = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Profile - Campus Information System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }

        .profile-container {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .profile-container h1 {
            margin-bottom: 20px;
        }

        .profile-container p {
            margin: 5px 0;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Academic Profile</h1>
</header>

<main>
    <div class="profile-container">
        <h1><?php echo $_SESSION['full_name']; ?></h1>
        <p>Username: <?php echo $profile_data['username']; ?></p>
        <p>Course: <?php echo $profile_data['course']; ?></p>
        <p>Year: <?php echo $profile_data['year']; ?></p>
        <p>GPA: <?php echo $profile_data['gpa']; ?></p>
        <!-- Add more fields as necessary -->
    </div>
</main>

<footer>
    <p>&copy; 2024 BGSBU Campus Information System</p>
</footer>

</body>
</html>

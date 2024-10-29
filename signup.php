<?php
// Enable error reporting to help with debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";  // or your server address
$username = "root";         // your MySQL username
$password = "";             // your MySQL password (if set)
$dbname = "CISDatabase";    // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement to insert the user data
    $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $username, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Sign-up successful!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection after execution
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .sign-up-box {
            background-color: #ffffff;
            padding: 40px 30px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #0056a3;
        }

        .input-group label {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #888;
            pointer-events: none;
            font-size: 16px;
            transition: all 0.2s ease-in-out;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -20px;
            font-size: 12px;
            color: #0056a3;
            background: #fff;
            padding: 0 5px;
        }

        .btn {
            background-color: #0056a3;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            background-color: #004080;
        }

        .message {
            margin-top: 15px;
            font-size: 14px;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="sign-up-box">
        <h2>Sign Up</h2>
        <form method="POST" action="">
            <div class="input-group">
                <input type="text" name="full_name" required>
                <label>Full Name</label>
            </div>
            <div class="input-group">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit" class="btn">Sign Up</button>
            <?php if (isset($message)) : ?>
                <div class="message"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

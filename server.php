<?php
// Database connection settings
$servername = "localhost";
$dbusername = "root";  // Your MySQL username
$dbpassword = "";      // Your MySQL password
$dbname = "CISDatabase";  // Your database name

// Create connection to the database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the sign-up form is submitted
if (isset($_POST['signup_submit'])) {
    // Get form inputs and escape special characters to prevent SQL injection
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $sql_check = "SELECT * FROM Login_credentials WHERE username='$username' OR email='$email'";
    $result_check = $conn->query($sql_check);
    
    if ($result_check->num_rows > 0) {
        echo "Username or email already exists. Please try a different one.";
    } else {
        // Insert user data into the database
        $sql_insert = "INSERT INTO Login_credentials (full_name, username, email, password) 
                       VALUES ('$full_name', '$username', '$email', '$hashed_password')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Sign-up successful!";
            // Redirect to login page (optional)
            // header("Location: index.html");
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

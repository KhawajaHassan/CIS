<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "CISDatabase"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentName = $_POST['studentName'];
    $studentID = $_POST['studentID'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    $courseCode = $_POST['courseCode'];
    $semester = $_POST['semester'];
    $description = $_POST['description'];

    // Debug: Print form data
    // var_dump($_POST);
    // exit; // Uncomment these lines to check the output

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO backlog_submissions (student_name, student_id, email, program, course_code, semester, backlog_reason) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $studentName, $studentID, $email, $program, $courseCode, $semester, $description);

    // Execute and check if the data was inserted successfully
    if ($stmt->execute()) {
        $message = "Backlog submitted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backlog Submission Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Resetting default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        /* Styling the form container */
        .form-container {
            max-width: 600px;
            margin: 100px auto;
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #003366;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #0059b3;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #003366;
            color: white;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0059b3;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            color: green;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Backlog Submission Form Container -->
    <div class="form-container">
        <h1>Backlog Submission Form</h1>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="studentName">Student Name</label>
            <input type="text" id="studentName" name="studentName" placeholder="Enter your full name" required>

            <label for="studentID">Student ID</label>
            <input type="text" id="studentID" name="studentID" placeholder="Enter your student ID" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>

            <label for="program">Program</label>
            <select id="program" name="program" required>
                <option value="" disabled selected>Select your program</option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Postgraduate">Postgraduate</option>
                <option value="PhD">PhD</option>
            </select>

            <label for="courseCode">Course Code</label>
            <input type="text" id="courseCode" name="courseCode" placeholder="Enter the course code" required>

            <label for="semester">Semester</label>
            <select id="semester" name="semester" required>
                <option value="" disabled selected>Select your semester</option>
                <option value="Semester-I">Semester-I</option>
                <option value="Semester-II">Semester-II</option>
                <option value="Semester-III">Semester-III</option>
                <option value="Semester-IV">Semester-IV</option>
                <option value="Semester-V">Semester-V</option>
                <option value="Semester-VI">Semester-VI</option>
                <option value="Semester-VII">Semester-VII</option>
                <option value="Semester-VIII">Semester-VIII</option>
            </select>

            <label for="description">Backlog Reason (optional)</label>
            <textarea id="description" name="description" placeholder="Explain your reason for backlog (if any)" rows="4"></textarea>

            <button type="submit">Submit Backlog</button>
        </form>
    </div>

</body>
</html>

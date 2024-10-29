<?php
// Database connection (You need to modify the credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CISDATABASE";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Room allotment form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_allotment'])) {
    $student_name = $_POST['student_name'];
    $roll_number = $_POST['roll_number'];
    $room_number = $_POST['room_number'];

    $sql = "INSERT INTO hostel_allotment (student_name, roll_number, room_number)
            VALUES ('$student_name', '$roll_number', '$room_number')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-msg'>Room allotted successfully!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Complaint submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['complaint_submission'])) {
    $complaint_type = $_POST['complaint_type'];
    $complaint_details = $_POST['complaint_details'];

    $sql = "INSERT INTO hostel_complaints (complaint_type, complaint_details)
            VALUES ('$complaint_type', '$complaint_details')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-msg'>Complaint submitted successfully!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select,
        textarea {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
        }

        button {
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #218838;
        }

        .success-msg {
            color: green;
            font-weight: bold;
            text-align: center;
        }

        .error-msg {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        .section-title {
            margin-top: 40px;
            font-size: 24px;
            color: #555;
        }

        .container form {
            margin-bottom: 40px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                margin: 20px auto;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Hostel Management System</h1>

        <!-- Room Allotment Form -->
        <h2 class="section-title">Room Allotment</h2>
        <form method="post">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required>

            <label for="roll_number">Roll Number:</label>
            <input type="text" id="roll_number" name="roll_number" required>

            <label for="room_number">Preferred Room Number:</label>
            <input type="text" id="room_number" name="room_number" required>

            <button type="submit" name="room_allotment">Submit Room Allotment</button>
        </form>

        <!-- Complaint Form -->
        <h2 class="section-title">Complaint Submission</h2>
        <form method="post">
            <label for="complaint_type">Complaint Type:</label>
            <select id="complaint_type" name="complaint_type" required>
                <option value="Maintenance">Maintenance</option>
                <option value="Cleanliness">Cleanliness</option>
                <option value="Other">Other</option>
            </select>

            <label for="complaint_details">Complaint Details:</label>
            <textarea id="complaint_details" name="complaint_details" rows="4" required></textarea>

            <button type="submit" name="complaint_submission">Submit Complaint</button>
        </form>
    </div>

</body>
</html>

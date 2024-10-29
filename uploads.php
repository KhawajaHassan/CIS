<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CISDatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Marks Upload Handler
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['uploadMarks'])) {
    $course_code = $_POST['courseCodeMarks'];
    $marksFile = $_FILES['marksFile']['tmp_name'];

    if (($handle = fopen($marksFile, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $student_id = $data[0];
            $marks_obtained = $data[1];
            $total_marks = $data[2];

            $stmt = $conn->prepare("INSERT INTO marks (course_code, student_id, marks_obtained, total_marks) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sidd", $course_code, $student_id, $marks_obtained, $total_marks);
            $stmt->execute();
        }
        fclose($handle);
        $marks_message = "Marks uploaded successfully!";
    }
}

// Attendance Upload Handler
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['uploadAttendance'])) {
    $attendance_date = $_POST['attendanceDate'];
    $attendanceFile = $_FILES['attendanceFile']['tmp_name'];

    if (($handle = fopen($attendanceFile, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $student_id = $data[0];
            $status = $data[1];

            $stmt = $conn->prepare("INSERT INTO attendance (attendance_date, student_id, status) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $attendance_date, $student_id, $status);
            $stmt->execute();
        }
        fclose($handle);
        $attendance_message = "Attendance uploaded successfully!";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Upload Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
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

        .container {
            max-width: 1200px;
            margin: 50px auto;
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #003366;
        }

        .form-section {
            margin-bottom: 40px;
        }

        .form-section h2 {
            font-size: 22px;
            color: #0059b3;
            margin-bottom: 15px;
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }

        .message {
            margin-top: 15px;
            font-size: 16px;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Admin Panel - Upload Data</h1>

        <!-- Marks Upload Section -->
        <div class="form-section">
            <h2>Upload Marks</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="courseCodeMarks">Course Code</label>
                <input type="text" id="courseCodeMarks" name="courseCodeMarks" placeholder="Enter the course code" required>

                <label for="marksFile">Upload Marks File (CSV)</label>
                <input type="file" id="marksFile" name="marksFile" accept=".csv" required>

                <button type="submit" name="uploadMarks">Upload Marks</button>

                <?php if (isset($marks_message)): ?>
                    <div class="message"><?= htmlspecialchars($marks_message); ?></div>
                <?php endif; ?>
            </form>
        </div>

        <!-- Attendance Upload Section -->
        <div class="form-section">
            <h2>Upload Attendance</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="attendanceDate">Attendance Date</label>
                <input type="date" id="attendanceDate" name="attendanceDate" required>

                <label for="attendanceFile">Upload Attendance File (CSV)</label>
                <input type="file" id="attendanceFile" name="attendanceFile" accept=".csv" required>

                <button type="submit" name="uploadAttendance">Upload Attendance</button>

                <?php if (isset($attendance_message)): ?>
                    <div class="message"><?= htmlspecialchars($attendance_message); ?></div>
                <?php endif; ?>
            </form>
        </div>

    </div>

</body>
</html>

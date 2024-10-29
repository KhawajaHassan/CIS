<?php
// Database connection
$servername = "localhost"; // Change this to your database server
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "CISDATABASE";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $roll_number = $_POST['roll_number'];
    $department = $_POST['department'];
    $purpose = $_POST['purpose'];
    $noc_reason = $_POST['noc_reason'];
    $company_name = $_POST['company_name'];
    
    // File upload logic
    $target_dir = "uploads/";
    $file_name = basename($_FILES["supporting_doc"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file type
    if($file_type != "pdf" && $file_type != "doc" && $file_type != "docx") {
        echo "Sorry, only PDF, DOC, & DOCX files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["supporting_doc"]["tmp_name"], $target_file)) {
        // Insert form data into database
        $sql = "INSERT INTO noc_requests (student_name, roll_number, department, purpose, noc_reason, company_name, supporting_doc)
                VALUES ('$student_name', '$roll_number', '$department', '$purpose', '$noc_reason', '$company_name', '$file_name')";
                
        if ($conn->query($sql) === TRUE) {
            echo "NOC form submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Tech Department NOC Form</title>
</head>
<body>

    <h2>B.Tech Department - NOC Form Submission</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="student_name">Student Name:</label><br>
        <input type="text" id="student_name" name="student_name" required><br><br>

        <label for="roll_number">Roll Number:</label><br>
        <input type="text" id="roll_number" name="roll_number" required><br><br>

        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" value="B.Tech" readonly><br><br>

        <label for="purpose">Purpose of NOC:</label><br>
        <select id="purpose" name="purpose" required>
            <option value="Internship">Internship</option>
            <option value="Job">Job</option>
            <option value="Further Studies">Further Studies</option>
        </select><br><br>

        <label for="noc_reason">Reason for NOC:</label><br>
        <textarea id="noc_reason" name="noc_reason" rows="4" required></textarea><br><br>

        <label for="company_name">Company/Institution Name:</label><br>
        <input type="text" id="company_name" name="company_name" required><br><br>

        <label for="supporting_doc">Upload Supporting Document (PDF, DOC, DOCX):</label><br>
        <input type="file" id="supporting_doc" name="supporting_doc" required><br><br>

        <input type="submit" value="Submit">
    </form>

</body>
</html>

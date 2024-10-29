<?php
// Connect to the database (update with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CISDATABASE";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch academic notices
$notices_sql = "SELECT title, description, date FROM academic_notices ORDER BY date DESC";
$notices_result = $conn->query($notices_sql);

// Fetch course materials
$materials_sql = "SELECT course_name, material_name, file_link FROM course_materials";
$materials_result = $conn->query($materials_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Corner - Campus Information System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin-right: 20px;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #74ebd5;
        }

        /* Main Content Styles */
        .content {
            flex: 1;
            padding: 40px;
        }

        .section-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .notices, .materials {
            margin-bottom: 40px;
        }

        .notices ul, .materials ul {
            list-style: none;
        }

        .notices ul li, .materials ul li {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .notices ul li h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .materials ul li h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .materials ul li p {
            margin-bottom: 10px;
        }

        .materials ul li a {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .materials ul li a:hover {
            background-color: #218838;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">BGSBU - Campus Information System</div>
    <nav>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main class="content">
    <section class="notices">
        <h2 class="section-title">Academic Notices</h2>
        <ul>
            <?php
            if ($notices_result->num_rows > 0) {
                while($notice = $notices_result->fetch_assoc()) {
                    echo "<li><h3>" . $notice['title'] . "</h3><p>" . $notice['description'] . "</p><p>Date: " . $notice['date'] . "</p></li>";
                }
            } else {
                echo "<li><p>No notices available.</p></li>";
            }
            ?>
        </ul>
    </section>

    <section class="materials">
        <h2 class="section-title">Course Materials</h2>
        <ul>
            <?php
            if ($materials_result->num_rows > 0) {
                while($material = $materials_result->fetch_assoc()) {
                    echo "<li><h3>" . $material['course_name'] . "</h3><p>Material: " . $material['material_name'] . "</p><a href='" . $material['file_link'] . "' download>Download</a></li>";
                }
            } else {
                echo "<li><p>No course materials available.</p></li>";
            }
            ?>
        </ul>
    </section>
</main>

<footer>
    <p>&copy; 2024 BGSBU Campus Information System. All rights reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>

<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Campus Information System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="footer.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .address-container {
    position: absolute;
    top: 10px; /* Adjust as needed */
    right: 10px; /* Adjust as needed */
    padding: 5px; /* Less padding for a smaller look */
    background-color: rgba(255, 255, 255, 0.7); /* Transparent white background */
    border-radius: 5px;
    font-size: 12px; /* Smaller font size */
    box-shadow: none; /* Remove shadow for a cleaner look */
    display: flex; /* Use flexbox to align icon and text */
    align-items: center; /* Center vertically */
}

.address-container i {
    margin-right: 5px; /* Space between icon and text */
    color: black; /* Icon color */
}

.address-container a {
    text-decoration: none;
    color: black;
    display: block; /* Makes the link area larger */
}


        /* Header and Navigation */
        header {
            background-color: #0a3d62;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header .logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        nav.main-nav {
            margin-top: 10px;
        }

        nav.main-nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        nav.main-nav ul li {
            margin: 0 15px;
        }

        nav.main-nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            padding: 5px 10px;
            transition: background-color 0.3s ease;
            border-radius: 4px;
        }

        nav.main-nav ul li a:hover {
            background-color: #1abc9c;
        }

        /* Hero Section */
        .hero {
            width: 100%;
            height: 500px;
            background: url('banner.jpeg') center/cover no-repeat;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end; /* Align items to the bottom */
            padding-bottom: 20px;
        }

        .hero h1 {
            color: white;
            font-size: 48px;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            animation: fadeIn 3s ease forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Know More Button */
        .hero button {
            margin-top: 20px; /* Space above the button */
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            background-color: #1abc9c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .hero button:hover {
            background-color: #16a085;
        }

        /* Quick Links Section */
        .quick-links {
    position: absolute;
    top: calc(100vh - 100px); /* Adjust this value based on your hero height */
    right: 20px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    padding: 20px;
    width: 300px;
    text-align: center;
}


        .quick-links h3 {
            font-size: 22px;
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .quick-links ul {
            list-style: none;
            padding: 0;
        }

        .quick-links ul li {
            margin-bottom: 15px;
            background-color: #3a6073;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .quick-links ul li:hover {
            background-color: #4db8ff;
        }

        .quick-links ul li img {
            width: 24px;
            margin-right: 10px;
        }

        .quick-links ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            flex-grow: 1;
        }

        .quick-links ul li a:hover {
            text-decoration: underline;
        }


    </style>
</head>
<body>

<header>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="logo">BGSBU - Campus Information System</div>
    <div class="address-container">
        <i class="fas fa-map-marker-alt"></i>
        <a href="https://maps.app.goo.gl/paUfiZTtfWwGvhBk6" target="_blank">
            BABA GHULAM SHAH BADSHAH UNIVERSITY<br>
            98WX+53C, Dhanore, Rajouri, Jammu and Kashmir 185234
        </a>
    </div>
</body>


    </a>
</div>


    <!-- Main Navigation Bar -->
    <nav class="main-nav">
        <ul>
            <li><a href="academics.php">Academics</a></li>
            <li><a href="admissions.php">Admissions</a></li>
            <li><a href="students.php">For Students</a></li>
            <li><a href="faculty.php">For Faculty and Staff</a></li>
            <li><a href="alumni.php">Alumni</a></li>
            <li><a href="resources.php">Resources</a></li>
        </ul>
    </nav>
</header>

<!-- Hero Section with University Image -->
<div class="hero">
    <h1>Welcome to BGSBU</h1>
    <button onclick="window.location.href='know_more.php'">Know More</button>
    <!-- Quick Links Section -->
    <div class="quick-links">
        <h3>Quick Links</h3>
        <ul>
            <li><a href="studentcorner.php"><img src="student-corner-icon.png" alt="Student Corner">Student Corner</a></li>
            <!-- <li><a href="samarth.php"><img src="samarth-icon.png" alt="SAMARTH Staff Login">SAMARTH Staff Login</a></li>
            <li><a href="naac.php"><img src="naac-icon.png" alt="NAAC">NAAC</a></li>
            <li><a href="nss.php"><img src="nss-icon.png" alt="NSS Registration">NSS Registration</a></li>
            <li><a href="annual-reports.php"><img src="annual-reports-icon.png" alt="Annual Reports">Annual Reports</a></li>
            <li><a href="alumni.php"><img src="alumni-icon.png" alt="Alumni">Alumni</a></li>
            <li><a href="compendium.php"><img src="compendium-icon.png" alt="Compendium">Compendium on Azadi ka Amrit Mahotsav</a></li>
            <li><a href="ariaa.php"><img src="ariaa-icon.png" alt="ARIAA">ARIAA</a></li>
            <li><a href="downloads.php"><img src="downloads-icon.png" alt="Downloads">Downloads</a></li>
        </ul> -->
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-left">
        <img src="newlogobgs-removebg-preview.png" alt="University Logo" class="university-logo" /> <!-- Replace with actual logo path -->
        <h3>Baba Ghulam Shah Badshah University</h3>
        <p>
            <i class="fas fa-map-marker-alt"></i>
            Address: 98WX+53C, Dhanore, Rajouri, Jammu and Kashmir 185234
        </p>
        <p>
            <i class="fas fa-phone"></i>
            Contact Number: +91-XXXX-XXXXXX
        </p>
        <p>
            <i class="fas fa-envelope"></i>
            Email: <a href="mailto:info@bgsbu.edu.in">info@bgsbu.edu.in</a>
        </p>
        <p>
            <i class="fas fa-globe"></i>
            Website: <a href="http://www.bgsbu.edu.in">www.bgsbu.edu.in</a>
        </p>
        <p>Follow us on:
            <a href="https://www.facebook.com/BGSBU" target="_blank"><i class="fab fa-facebook"></i> Facebook</a> |
            <a href="https://twitter.com/BGSBU" target="_blank"><i class="fab fa-twitter"></i> Twitter</a> |
            <a href="https://www.instagram.com/BGSBU" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
        </p>
    </div>
    <div class="footer-right" id="weather-info">
        <!-- Weather information will be dynamically inserted here -->
    </div>
</footer>



</body>
</html>

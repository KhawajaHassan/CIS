<?php
// Database connection (Update credentials as per your setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CISDATABASE";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search for books
$search_results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_books'])) {
    $book_name = $_POST['book_name'];
    
    $sql = "SELECT * FROM library_books WHERE book_name LIKE '%$book_name%' OR author LIKE '%$book_name%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    } else {
        echo "<p class='error-msg'>No books found matching your search.</p>";
    }
}

// Reserve a book
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserve_book'])) {
    $student_name = $_POST['student_name'];
    $book_id = $_POST['book_id'];

    // Check if the book is available
    $check_sql = "SELECT * FROM library_books WHERE id = '$book_id' AND is_available = 1";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $reserve_sql = "INSERT INTO library_reservations (student_name, book_id) VALUES ('$student_name', '$book_id')";
        $update_sql = "UPDATE library_books SET is_available = 0 WHERE id = '$book_id'";

        if ($conn->query($reserve_sql) === TRUE && $conn->query($update_sql) === TRUE) {
            echo "<p class='success-msg'>Book reserved successfully!</p>";
        } else {
            echo "<p class='error-msg'>Error reserving the book.</p>";
        }
    } else {
        echo "<p class='error-msg'>Book is not available for reservation.</p>";
    }
}

// Borrowing history
$borrowing_history = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view_history'])) {
    $student_name = $_POST['student_name'];

    $history_sql = "SELECT lb.book_name, lb.author, lr.reservation_date 
                    FROM library_reservations lr
                    JOIN library_books lb ON lr.book_id = lb.id
                    WHERE lr.student_name = '$student_name'";
    
    $history_result = $conn->query($history_sql);

    if ($history_result->num_rows > 0) {
        while ($row = $history_result->fetch_assoc()) {
            $borrowing_history[] = $row;
        }
    } else {
        echo "<p class='error-msg'>No borrowing history found for this student.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        form {
            margin-bottom: 40px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 12px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Library Management System</h1>

        <!-- Book Search Form -->
        <h2>Search for Books</h2>
        <form method="post">
            <label for="book_name">Book Name or Author:</label>
            <input type="text" id="book_name" name="book_name" required>

            <button type="submit" name="search_books">Search</button>
        </form>

        <!-- Display search results -->
        <?php if (!empty($search_results)): ?>
            <h3>Search Results:</h3>
            <table>
                <tr>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Available</th>
                    <th>Reserve</th>
                </tr>
                <?php foreach ($search_results as $book): ?>
                    <tr>
                        <td><?php echo $book['book_name']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo $book['is_available'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <?php if ($book['is_available']): ?>
                                <form method="post">
                                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                    <input type="text" name="student_name" placeholder="Enter your name" required>
                                    <button type="submit" name="reserve_book">Reserve</button>
                                </form>
                            <?php else: ?>
                                Unavailable
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <!-- Borrowing History Form -->
        <h2>View Borrowing History</h2>
        <form method="post">
            <label for="student_name">Enter Your Name:</label>
            <input type="text" id="student_name" name="student_name" required>

            <button type="submit" name="view_history">View History</button>
        </form>

        <!-- Display borrowing history -->
        <?php if (!empty($borrowing_history)): ?>
            <h3>Borrowing History:</h3>
            <table>
                <tr>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Reservation Date</th>
                </tr>
                <?php foreach ($borrowing_history as $history): ?>
                    <tr>
                        <td><?php echo $history['book_name']; ?></td>
                        <td><?php echo $history['author']; ?></td>
                        <td><?php echo $history['reservation_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>

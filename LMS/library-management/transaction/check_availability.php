<?php
session_start();
$homePage = ($_SESSION['role'] === 'admin') ? "../admin_home.php" : "../user_home.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Availability</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        table { margin: auto; border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #0073e6; color: white; }
        select, button { padding: 8px; margin-top: 10px; }
    </style>
</head>
<body>

    <h2>Book Availability</h2>
    <a href="<?= $homePage ?>">Home</a> | 
    <a href="logout.php">Log Out</a>

    <table>
        <tr><th colspan="2">Search Books</th></tr>
        <tr>
            <td>Enter Book Name</td>
            <td>
                <select id="book_name">
                    <option value="">Select a Book</option>
                    <option value="book1">Book 1</option>
                    <option value="book2">Book 2</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Enter Author</td>
            <td>
                <select id="author">
                    <option value="">Select an Author</option>
                    <option value="author1">Author 1</option>
                    <option value="author2">Author 2</option>
                </select>
            </td>
        </tr>
    </table>

    <button onclick="history.back()">Back</button>
    <button onclick="searchBook()">Search</button>

    <script>
        function searchBook() {
            let book = document.getElementById("book_name").value;
            let author = document.getElementById("author").value;
            if (!book || !author) {
                alert("Please select both book name and author.");
            } else {
                alert(`Searching for: ${book} by ${author}`);
            }
        }
    </script>

</body>
</html>

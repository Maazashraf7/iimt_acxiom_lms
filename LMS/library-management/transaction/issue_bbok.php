<?php
session_start();
include('db_connect.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id_issue'];
    $user_id = $_POST['user_id'];
    
    // Query to check if the book is available
    $sql = "SELECT * FROM books WHERE book_id = '$book_id' AND availability = 1";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Update the book availability and issue the book
        $sql = "UPDATE books SET availability = 0 WHERE book_id = '$book_id'";
        mysqli_query($conn, $sql);
        
        // Insert the issue details in the issues table
        $sql = "INSERT INTO issues (book_id, user_id, status) VALUES ('$book_id', '$user_id', 'active')";
        mysqli_query($conn, $sql);
        
        echo "Book has been issued successfully.";
    } else {
        echo "The book is not available.";
    }
}
?>

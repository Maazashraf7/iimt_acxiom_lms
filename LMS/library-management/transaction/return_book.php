<?php
session_start();
include('../includes/db.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id_return'];
    $user_id = $_POST['user_id_return'];
    
    // Update book availability and status
    $sql = "UPDATE books SET availability = 1 WHERE book_id = '$book_id'";
    mysqli_query($conn, $sql);
    
    // Update the issue status
    $sql = "UPDATE issues SET status = 'returned' WHERE book_id = '$book_id' AND user_id = '$user_id'";
    mysqli_query($conn, $sql);
    
    echo "Book has been returned successfully.";
}
?>

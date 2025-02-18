<?php
session_start();
include('../includes/db.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id_fine'];
    $fine_amount = $_POST['fine_amount'];
    
    // Update the fine for the user (assuming you have a fines table or column in the users table)
    $sql = "UPDATE users SET fine_balance = fine_balance - '$fine_amount' WHERE user_id = '$user_id'";
    mysqli_query($conn, $sql);
    
    echo "Fine has been paid successfully.";
}
?>

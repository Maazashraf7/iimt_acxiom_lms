<?php
session_start();
include('../includes/db.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type']; // Book or Movie
    $serial_no = $_POST['serial_no'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    // Choose table based on type
    $table = ($type == "book") ? "books" : "movies";

    $sql = "UPDATE $table SET status=?, date_of_procurement=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $status, $date, $serial_no);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p class='text-success text-center'>Updated successfully!</p>";
    } else {
        echo "<p class='text-danger text-center'>Error: " . mysqli_error($conn) . "</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book/Movie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="text-center">Update Book/Movie</h2>

    <form action="update_book_movie.php" method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label>Type</label> <br>
            <input type="radio" name="type" value="book" required> Book
            <input type="radio" name="type" value="movie" required> Movie
        </div>

        <div class="mb-3">
            <label>Book/Movie Name</label>
            <select name="name" class="form-control" required>
                <option value="">Select Book/Movie</option>
                <?php
                include('../includes/db.php');
                $sql = "SELECT id, name FROM books UNION SELECT id, name FROM movies";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Serial No</label>
            <input type="text" name="serial_no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Available">Available</option>
                <option value="Issued">Issued</option>
                <option value="Damaged">Damaged</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date

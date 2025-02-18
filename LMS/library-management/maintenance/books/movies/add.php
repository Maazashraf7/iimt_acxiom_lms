<?php
session_start();
include('../includes/db.php'); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type']; 
    $name = $_POST['name'];
    $date_of_procurement = $_POST['date_of_procurement'];
    $quantity = !empty($_POST['quantity']) ? $_POST['quantity'] : 1; 


    $table = ($type == "book") ? "books" : "movies";

    $sql = "INSERT INTO $table (name, date_of_procurement, quantity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $name, $date_of_procurement, $quantity);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p class='text-success text-center'>Added successfully!</p>";
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
    <title>Add Book/Movie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="text-center">Add Book/Movie</h2>

    <form action="add_book_movie.php" method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label>Type</label> <br>
            <input type="radio" name="type" value="book" required> Book
            <input type="radio" name="type" value="movie" required> Movie
        </div>

        <div class="mb-3">
            <label>Book/Movie Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date of Procurement</label>
            <input type="date" name="date_of_procurement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Quantity/Copies</label>
            <input type="number" name="quantity" class="form-control" value="1" min="1">
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <a href="home.php" class="btn btn-secondary">Home</a>
    </form>

</body>
</html>

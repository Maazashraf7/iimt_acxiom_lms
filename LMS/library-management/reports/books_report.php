<?php
include('../includes/db.php'); // Database connection file
session_start();

// Dummy role assignment (Replace this with actual login system logic)
$_SESSION['role'] = $_SESSION['role'] ?? 'user'; // Default to user if not set

// Determine home page URL based on role
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
// Fetch book data from database
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master List of Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }

        .back-btn {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<div class="top-bar d-flex justify-content-end p-3">
    <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
</div>
    <div class="container">
        <h2 class="text-center mb-4">📚 Master List of Books</h2>

        <a href="reports.php" class="btn btn-secondary back-btn">⬅ Back</a>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Serial No</th>
                    <th>Name of Book</th>
                    <th>Author Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Cost (₹)</th>
                    <th>Procurement Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $serial_no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$serial_no}</td>
                        <td>{$row['book_name']}</td>
                        <td>{$row['author_name']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['status']}</td>
                        <td>₹{$row['cost']}</td>
                        <td>{$row['procurement_date']}</td>
                    </tr>";
                        $serial_no++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center text-danger'>No records found</td></tr>";
                }
                ?>
            </tbody>
            </t>

        </table>
    </div>
    <div class="text-center mt-4">
            <a href="index.php" class="btn btn-danger">Log Out</a>
        </div>
</body>
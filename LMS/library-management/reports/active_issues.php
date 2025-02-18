<?php
include('../includes/db.php'); 
// Fetch active book/movie issues from database
$sql = "SELECT * FROM issues WHERE return_date IS NULL";  // Assumes NULL return date for active issues
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Issues</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .table { margin-top: 20px; }
        .btn-logout { margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Active Issues</h2>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Serial No</th>
                <th>Book/Movie</th>
                <th>Name of Book/Movie</th>
                <th>Membership ID</th>
                <th>Date of Issue</th>
                <th>Expected Return Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['issue_id']}</td>
                        <td>{$row['type']}</td>
                        <td>{$row['item_name']}</td>
                        <td>{$row['membership_id']}</td>
                        <td>{$row['issue_date']}</td>
                        <td>{$row['expected_return_date']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No active issues found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Back and Logout Buttons -->
    <div class="text-center">
        <a href="../reports.php" class="btn btn-secondary">Back</a>
        <a href="../logout.php" class="btn btn-danger btn-logout">Log Out</a>
    </div>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>  <!-- Close DB connection -->

<?php
include('../includes/db_connect.php'); // Ensure correct path to DB connection file

// Define fine amount per day
$fine_per_day = 10;  // Adjust this value as needed

// Fetch overdue book returns
$sql = "SELECT issue_id, item_name, membership_id, issue_date, expected_return_date, 
        DATEDIFF(CURDATE(), expected_return_date) AS overdue_days 
        FROM issues 
        WHERE return_date IS NULL AND CURDATE() > expected_return_date";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Returns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .table { margin-top: 20px; }
        .btn-logout { margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Overdue Returns</h2>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Serial No</th>
                <th>Name of Book</th>
                <th>Membership ID</th>
                <th>Date of Issue</th>
                <th>Expected Return Date</th>
                <th>Fine (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $fine_amount = max(0, $row['overdue_days'] * $fine_per_day); // Ensure non-negative fine
                    echo "<tr>
                        <td>{$row['issue_id']}</td>
                        <td>{$row['item_name']}</td>
                        <td>{$row['membership_id']}</td>
                        <td>{$row['issue_date']}</td>
                        <td>{$row['expected_return_date']}</td>
                        <td>₹ {$fine_amount}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No overdue books found</td></tr>";
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

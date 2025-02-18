<?php
include('../includes/db.php'); // Ensure correct path to DB connection file

// Fetch active memberships from database
$sql = "SELECT * FROM memberships WHERE status = 'Active'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Active Memberships</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .table { margin-top: 20px; }
        .btn-logout { margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">List of Active Memberships</h2>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Membership ID</th>
                <th>Name of Member</th>
                <th>Contact Number</th>
                <th>Contact Address</th>
                <th>Aadhar Card No</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Amount Pending (Fine)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['membership_id']}</td>
                        <td>{$row['member_name']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['contact_address']}</td>
                        <td>{$row['aadhar_card_no']}</td>
                        <td>{$row['start_date']}</td>
                        <td>{$row['end_date']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['amount_pending']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No active memberships found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Back and Logout Buttons -->
    <div class="text-center">
        <a href="./reports.php" class="btn btn-secondary">Back</a>
        <a href="../logout.php" class="btn btn-danger btn-logout">Log Out</a>
    </div>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>  <!-- Close DB connection -->

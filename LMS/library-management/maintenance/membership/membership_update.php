<?php
session_start();
include('../includes/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membership_id = $_POST['membership_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $membership_extn = $_POST['membership_extn'];
    $membership_remove = isset($_POST['membership_remove']) ? $_POST['membership_remove'] : '';

    if (!empty($membership_remove)) {
        
        $sql = "UPDATE memberships SET status = 'Inactive' WHERE membership_id = ?";
    } else {
       
        $extension = "";
        if ($membership_extn == "six months") {
            $extension = "INTERVAL 6 MONTH";
        } elseif ($membership_extn == "one year") {
            $extension = "INTERVAL 1 YEAR";
        } elseif ($membership_extn == "two years") {
            $extension = "INTERVAL 2 YEAR";
        }

        $sql = "UPDATE memberships 
                SET start_date = ?, 
                    end_date = DATE_ADD(end_date, $extension),
                    membership_type = ? 
                WHERE membership_id = ?";
    }

    // Prepare and execute query
    $stmt = mysqli_prepare($conn, $sql);
    if (!empty($membership_remove)) {
        mysqli_stmt_bind_param($stmt, "i", $membership_id);
    } else {
        mysqli_stmt_bind_param($stmt, "ssi", $start_date, $membership_extn, $membership_id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<p class='text-success text-center'>Membership updated successfully!</p>";
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
    <title>Update Membership</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
<div class="top-bar d-flex justify-content-end p-3">
    <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
</div>
    <h2 class="text-center">Update Membership</h2>

    <form action="update_membership.php" method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label>Membership Number</label>
            <input type="number" name="membership_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <label>Membership Extension:</label>
        <div class="mb-3">
            <input type="radio" name="membership_extn" value="six months" required> Six Months
            <input type="radio" name="membership_extn" value="one year" required> One Year
            <input type="radio" name="membership_extn" value="two years" required> Two Years
        </div>

        <div class="mb-3">
            <label>Remove Membership</label>
            <input type="checkbox" name="membership_remove" value="yes">
        </div>

        <form onsubmit="return redirectToConfirmation()">
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>

        <script>
            function redirectToConfirmation() {
                window.location.href = "./confirmation.php"; 
                return false; 
            }
        </script>
        <a href="home.php" class="btn btn-secondary">Cancel</a>
        <a href="logout.php" class="btn btn-danger">Log Out</a>
    </form>

</body>
</html>

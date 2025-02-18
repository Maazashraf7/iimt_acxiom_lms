<?php
include('../includes/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    $name = $_POST['name'];
    $status = isset($_POST['status']) ? 'active' : 'inactive';
    $admin = isset($_POST['admin']) ? 1 : 0;

    if ($user_type == "new") {
        $sql = "INSERT INTO users (name, status, admin) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $name, $status, $admin);
    } else {
        $sql = "UPDATE users SET status=?, admin=? WHERE name=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sis", $status, $admin, $name);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<p class='text-success text-center'>User updated successfully!</p>";
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
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <h2 class="text-center">User Management</h2>

    <form action="../confirmation.php" method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label>User Type</label> <br>
            <input type="radio" name="user_type" value="new" required> New User
            <input type="radio" name="user_type" value="existing" required> Existing User
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label> <br>
            <input type="checkbox" name="status" value="active"> Active
        </div>

        <div class="mb-3">
            <label>Admin</label> <br>
            <input type="checkbox" name="admin" value="admin"> Admin
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
        <a href="/transaction_cancelled.php" class="btn btn-secondary">Cancel</a>
    </form>

</body>

</html>
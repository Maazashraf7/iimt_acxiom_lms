<?php
session_start();

// Dummy role assignment (Replace this with actual login system logic)
$_SESSION['role'] = $_SESSION['role'] ?? 'user'; // Default to user if not set

// Determine home page URL based on role
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }
    </style>
</head>
<body class="bg-light">

<div class="top-bar d-flex justify-content-end p-3">
    <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
</div>


    <div class="container mt-5">
        <h2 class="text-center mb-4">Available Reports</h2>
        
        <div class="row">
            <div class="col-md-4">
                <a href="books_report.php" class="text-decoration-none">
                    <div class="card shadow-sm p-3 text-center">
                        <h5>Master List of Books</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="movies_report.php" class="text-decoration-none">
                    <div class="card shadow-sm p-3 text-center">
                        <h5>Master List of Movies</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="membership_report.php" class="text-decoration-none">
                    <div class="card shadow-sm p-3 text-center">
                        <h5>Master List of Memberships</h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <a href="active_issues.php" class="text-decoration-none">
                    <div class="card shadow-sm p-3 text-center">
                        <h5>Active Issues</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="overdue_returns.php" class="text-decoration-none">
                    <div class="card shadow-sm p-3 text-center">
                        <h5>Overdue Returns</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="pending_requests.php" class="text-decoration-none">
                    <div class="card shadow-sm p-3 text-center">
                        <h5>Pending Issue Requests</h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/logout.php" class="btn btn-danger">Log Out</a>
        </div>
    </div>

</body>
</html>

<?php
include('./includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Issue Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center">Pending Issue Requests</h2>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Member Name</th>
                    <th>Book Title</th>
                    <th>Request Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT members.member_name, books.book_name, requests.request_date, requests.id
                        FROM requests
                        JOIN members ON requests.member_id = members.id
                        JOIN books ON requests.book_id = books.id
                        WHERE requests.status = 'pending'";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>".$count++."</td>
                            <td>".$row['member_name']."</td>
                            <td>".$row['book_name']."</td>
                            <td>".$row['request_date']."</td>
                            <td>
                                <a href='approve_request.php?id=".$row['id']."' class='btn btn-success btn-sm'>Approve</a>
                                <a href='reject_request.php?id=".$row['id']."' class='btn btn-danger btn-sm'>Reject</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="reports.php" class="btn btn-secondary">Back to Reports</a>
        </div>
    </div>

</body>
</html>

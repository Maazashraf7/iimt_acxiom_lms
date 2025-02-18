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
    <title>Transactions</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
</head>
<body class="bg-gray-100 p-10">
<div class="top-bar">
        
        <span><a href="<?= $homePage ?>" class="text-decoration-none">Home</a></span>
    </div>
	<div class="grid grid-cols-3 gap-6 mt-10">
    <!-- Chart Section -->
    <div class="col-span-1 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Chart</h2>
        <ul class="space-y-2">
            <li class="border-b pb-2">Is book available?</li>
            <li class="border-b pb-2">Issue book?</li>
            <li class="border-b pb-2">Return book?</li>
            <li>Pay Fine?</li>
        </ul>
    </div>

    <!-- Transactions Section -->
    <div class="col-span-1 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Transactions</h2>
        <ul class="space-y-2">
            <li class="border-b pb-2"><a href="check_availability.php" class="text-blue-500">Check Availability</a></li>
            <li class="border-b pb-2"><a href="issue_book.php" class="text-blue-500">Issue Book</a></li>
            <li class="border-b pb-2"><a href="return_book.php" class="text-blue-500">Return Book</a></li>
            <li><a href="pay_fine.php" class="text-blue-500">Pay Fine</a></li>
        </ul>
    </div>

    <!-- Home & Logout Section -->
    <div class="col-span-1 bg-white p-4 rounded-lg shadow-md flex flex-col justify-between">
        <a href="<?= $homePage ?>" class="text-blue-500 text-lg font-semibold">Home</a>
        <a href="/logout.php" class="mt-6 bg-red-500 text-white px-6 py-2 rounded text-center">Log Out</a>
    </div>
</div>

    </div>
</body>
</html>

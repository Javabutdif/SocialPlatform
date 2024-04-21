<?php
// Check if the user is logged in as an admin
session_start();
if ($_SESSION['is_admin'] == "") {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <!-- Admin dashboard content here -->
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>This is a restricted area for admin users only.</p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    
</body>
</html>

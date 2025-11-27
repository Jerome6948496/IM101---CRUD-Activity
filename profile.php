<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

<?php include 'nav.php'; ?>

<div class="container mt-4">
    <h2>User Profile</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> <?= $_SESSION['user']; ?></p>
            <p><strong>Email:</strong> <?= $_SESSION['email']; ?></p>
        </div>
    </div>

    <a href="add_user.php" class="btn btn-primary mt-3">Manage Users</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

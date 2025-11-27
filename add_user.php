<?php
session_start();
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Add or Edit User
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add_user') {
        $_SESSION['users'][] = [
            "fullname" => $_POST['fullname'],
            "email" => $_POST['email'],
            "username" => $_POST['username'],
            "password" => $_POST['password']
        ];
    } elseif ($_POST['action'] == 'edit_user') {
        $index = $_POST['edit_index'];
        $_SESSION['users'][$index]['fullname'] = $_POST['edit_name'];
        $_SESSION['users'][$index]['email'] = $_POST['edit_email'];
        $_SESSION['users'][$index]['username'] = $_POST['edit_username'];
        if (!empty($_POST['password'])) {
            $_SESSION['users'][$index]['password'] = $_POST['password'];
        }
    }
}

// Delete User
if (isset($_GET['delete'])) {
    unset($_SESSION['users'][$_GET['delete']]);
    $_SESSION['users'] = array_values($_SESSION['users']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container mt-4">
    <h2>Manage Users</h2>

    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['users'] as $i => $u): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= $u['fullname'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= $u['username'] ?></td>
                    <td><?= $u['password'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setEditUser(<?= $i ?>)">Edit</button>
                        <a href="?delete=<?= $i ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5>Add New User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="action" value="add_user">

                <label>Full Name</label>
                <input type="text" name="fullname" required class="form-control mb-2">

                <label>Email</label>
                <input type="email" name="email" required class="form-control mb-2">

                <label>Username</label>
                <input type="text" name="username" required class="form-control mb-2">

                <label>Password (Auto Generated)</label>
                <input type="text" name="password" id="genPassAdd" readonly class="form-control mb-2">

                <button type="button" onclick="generatePass('genPassAdd')" class="btn btn-secondary">Generate Password</button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Add User</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5>Edit User</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="action" value="edit_user">
                <input type="hidden" name="edit_index" id="edit_index">

                <label>Name</label>
                <input type="text" name="edit_name" id="edit_name" class="form-control mb-2">

                <label>Email</label>
                <input type="email" name="edit_email" id="edit_email" class="form-control mb-2">

                <label>Username</label>
                <input type="text" name="edit_username" id="edit_username" class="form-control mb-2" required>

                <label>Password (Auto Generated)</label>
                <input type="text" name="password" id="genPassEdit" readonly class="form-control mb-2">

                <button type="button" onclick="generatePass('genPassEdit')" class="btn btn-secondary">Generate Password</button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
function generatePass(target) {
    fetch("https://api.api-ninjas.com/v1/passwordgenerator?length=16", {
        headers: {"X-Api-Key": ""}
    })
    .then(res => res.json())
    .then(data => document.getElementById(target).value = data.random_password)
    .catch(() => alert("Password API failed"));
}

// Populate Edit Modal with user data
function setEditUser(index) {
    var users = <?= json_encode($_SESSION['users']) ?>;
    document.getElementById('edit_index').value = index;
    document.getElementById('edit_name').value = users[index].fullname;
    document.getElementById('edit_email').value = users[index].email;
    document.getElementById('edit_username').value = users[index].username;
    generatePass('genPassEdit');
}

// Auto-generate password on Add modal show
var addModal = document.getElementById('addModal');
addModal.addEventListener('shown.bs.modal', () => generatePass('genPassAdd'));
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

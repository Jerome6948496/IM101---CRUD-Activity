<?php
session_start();

// Dummy credentials for demo
$validUser = "admin";
$validPass = "1234";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username === $validUser && $password === $validPass) {
    $_SESSION['user'] = "Admin User";
    $_SESSION['email'] = "admin@example.com";

    header("Location: profile.php");
    exit();
  } else {
    $error = "Invalid Username or Password!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">

      <div class="card shadow">
        <div class="card-body">
          <h3 class="text-center mb-3">Login</h3>

          <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

          <form method="POST">

            <div class="mb-3">
              <label>Username</label>
              <input type="text" name="username" required class="form-control">
            </div>

            <div class="mb-3 position-relative">
              <label>Password</label>
              <input type="password" name="password" id="password" required class="form-control">
              <span class="position-absolute top-50 bottom-100 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePass()">
                  <i class="fa-regular fa-eye"></i>
              </span>
            </div>
            <button class="btn btn-primary w-100" type="submit">Login</button>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<script>
function togglePass() {
  const p = document.getElementById('password');
  p.type = p.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>

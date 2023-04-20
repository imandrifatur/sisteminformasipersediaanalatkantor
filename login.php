<?php
session_start();

// Cek apakah pengguna telah login
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin/index.php');
        exit;
    } elseif ($_SESSION['role'] === 'user') {
        header('Location: transaksi/index.php');
        exit;
    }
    }

// Cek apakah form login telah dikirim
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kon = mysqli_connect('localhost', 'root', '', 'inventory');
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($kon, $query);

    if (mysqli_num_rows($result) == 1) {
        // Pengguna telah berhasil login
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($_SESSION['role'] === 'admin') {
            header('Location: admin/index.php');
            exit;
        } elseif ($_SESSION['role'] === 'user') {
            header('Location: transaksi/index.php');
            exit;
        }
    } else {
        // Login gagal
        $error = "<script>
        alert('password anda salah!');
    </script>";
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <style>
    body {
        background-image: url('https://images.unsplash.com/photo-1681581718209-f9f23be7f679?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1032&q=80');
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
}

.card {
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  border: none;
}

.card-header {
  border-bottom: none;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

.btn-primary:focus,
.btn-primary:active {
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

.form-check-input:checked {
  background-color: #007bff;
  border-color: #007bff;
}

.form-check-input:focus,
.form-check-input:active {
  box-shadow: none;
}

@media (min-width: 576px) {
  .card {
    margin-top: 3rem;
  }
}

  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h4>Login</h4>
          </div>
          <div class="card-body">
          <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
            <form method="post" action="">
              <div class="form-group">
                <label for="text">Username</label>
                <input class="form-control"  type="text" name="username" placeholder="Enter Username" value="" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" value="" required>
              </div>
              
              <button type="submit" class="btn btn-primary btn-block" name="submit" value="Login">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



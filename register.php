<?php
include('connection.php');
session_start();

$email = $password = $confirm_password = $first_name = $last_name = $phone_no = '';
$errors = array('password' => '', 'confirm_password' => '', 'duplicate' => '');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_no = $_POST['phone_no'];

    // Check if the email address has been used
    $duplicate = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($duplicate);

    if ($result && $result->num_rows > 0) {
        $errors['duplicate'] = 'Email has already been taken<br />';
    }

    // Check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Enter Password<br />';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters long<br />';
        }
    }

    // Confirm password
    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'Re-enter Password<br />';
    } else {
        $confirm_password = $_POST['confirm_password'];
        if ($password !== $confirm_password) {
            $errors['confirm_password'] = 'Password does not match<br />';
        }
    }

    if (!array_filter($errors)) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Create SQL query
        $sql = "INSERT INTO users (first_name, last_name, email, password, phone_no) 
                VALUES ('$first_name', '$last_name', '$email', '$password', '$phone_no')";

        // Save to db and check
        if (mysqli_query($conn, $sql)) {
            // Success
            $_SESSION['success'] = true;
            echo "<script>
                window.onload = function() {
                    alert('Registration Successful. Happy Shopping');
                    setTimeout(function() {
                        window.location.href = 'register.php';
                    }, 1000);
                }
            </script>";
            exit(); // Prevent further execution of the script
        } else {
            // Error
            echo 'Query error: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="img/logo2.jpg" type="image/x-icon">
</head>
<body class="bg-info-subtle">
  <?php include('script.php');?>

  <section class="container-lg bg-white col-12 col-md-11">
      <div class="mx-1 px-1 mx-lg-5 px-lg-2">
          <a href="index.php"><div class="text-center"><img src="img/logo2.jpg" width="100px" class="image-fluid"></div></a>
          <div class="row bg-body-tertiary col-md-9 col-lg-7 col-12 py-4 px-2 p-md-4 my-3 mx-auto">
            <form id="registrationForm" action="register.php" method="POST">
              <h4 class="py-3">NEW CUSTOMER</h4>
              <div class="d-flex">
                  <input class="form-control form-control-sm p-2 me-3 mb-3" type="text" placeholder="First Name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" aria-label=".form-control-sm example" required autocomplete="name">
                  <input class="form-control form-control-sm p-2 mb-3" type="text" placeholder="Last Name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" aria-label=".form-control-sm example" required autocomplete="name">
              </div>
              <input class="form-control form-control-sm" type="text" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email); ?>" aria-label=".form-control-sm example" required autocomplete="email">
              <div class="errors p-2 mb-2"><?php echo $errors['duplicate']; ?></div>
              <input class="form-control form-control-sm p-2 mb-3" type="numbers" placeholder="Phone no." name="phone_no" value="<?php echo htmlspecialchars($phone_no); ?>" aria-label=".form-control-sm example" required autocomplete="number">
              <input class="form-control form-control-sm p-2 mb-3" type="password" placeholder="Password" name="password" value="<?php echo htmlspecialchars($password); ?>" aria-label=".form-control-sm example" required autocomplete="new-password">
              <div class="errors ps-2"><?php echo $errors['password']; ?></div>
              <input class="form-control form-control-sm p-2 mb-3" type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>" aria-label=".form-control-sm example" required autocomplete="new-password">
              <div class="errors ps-2"><?php echo $errors['confirm_password']; ?></div>
              <button type="submit" name="submit" value="submit" class="btn btn-info my-3 py-2 text-white fs14" style="width: 100%;">SIGN UP</button>
              <small class="">Cancel</small>
            </form>
          </div>
          <div class="text-center">
              <a class="nav-link" href="shop.php"><i class="bi bi-chevron-left"></i> BACK TO STORE</a>
              <div class="credit text-center p-2 m-2 p-sm-4 m-sm-4 border-top">&#169 2024 | all rights reserved</div>
          </div>
      </div>
  </section>
</body>
</html>

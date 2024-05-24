<?php
include('connection.php');
session_start();


$email = $password = '';
$errors = array('email' => '', 'password' => '');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' and password='$password'");
    $result = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) > 0) {
        if ($password == $result["password"]) {
            $_SESSION['email'] = $result['email'];
            $_SESSION['user_id'] = $result['user_id'];

            if($_SESSION['user_id'] == 1){
                echo "<script>
                window.onload = function() {
                alert('Login Successful');
                setTimeout(function() {
                    window.location.href = 'admin.php';
                }, 1000);
            }
            </script>";
            }
            else{
            echo "<script>
                window.onload = function() {
                    alert('Login Successful');
                    setTimeout(function() {
                        window.location.href = 'account.php';
                    }, 1000);
                }
                </script>";}
            exit(); // stop executing further code after redirection
        } else {
            $errors['password'] = "Wrong password";
        }
    } else {
        $errors['email'] = "User not registered";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="img/logo2.jpg" type="image/x-icon">
</head>
<body class="bg-info-subtle">
<?php include('script.php'); ?>

<section class="container-lg bg-white col-12 col-md-11">
    <div class="mx-1 px-1 mx-lg-5 px-lg-2">
        <a href="index.php">
            <div class="text-center"><img src="img/logo2.jpg" width="100px" class="image-fluid"></div>
        </a>

        <div class="row justify-content-around example">
            <div class="col-md-5 col-sm-9 col-11 mx-auto my-4 p-4 m-md-2 bg-body-tertiary p-md-5">
                <form action="" method="POST">
                    <h4 class="py-2">REGISTERED CUSTOMER</h4>
                    <p class="mb-md-3 mb-1 fs14">Welcome, please sign in!</p>
                    <input class="form-control form-control-sm p-2 my-2" type="email" placeholder="Email"
                           name="email" value="<?php echo htmlspecialchars($email) ?>"
                           aria-label=".form-control-sm example" required autocomplete="email">
                    <div class="errors"><?php echo $errors['email']; ?></div>
                    <input class="form-control form-control-sm p-2 mb-4" type="password" placeholder="Password"
                           name="password" value="<?php echo htmlspecialchars($password) ?>"
                           aria-label=".form-control-sm example" required autocomplete="current-password">
                    <div class="errors"><?php echo $errors['password']; ?></div>
                    <button type="submit" name="submit" value="submit"
                            class="btn btn-info mb-3 py-2 text-white fs14" style="width: 100%;">SIGN IN
                    </button>
                    <p class="fs14 fw-semibold">Forgot Password?</p>
                </form>
            </div>

            <div class="col-md-5 col-sm-9 col-11 mx-auto my-4 p-4 m-md-2 bg-body-tertiary p-md-5">
                <h4 class="py-2">NEW CUSTOMER</h4>
                <p class="mb-5 fs14">Register to keep track of your orders and shop faster.</p>
                <a href="register.php"><button type="submit" name="submit" value="submit" class="btn btn-info mb-3 py-2 text-white fs14" style="width: 100%;">REGISTER WITH EMAIL</button></a>
            </div>
        </div>

        <div class="text-center fs14">
            <a class="nav-link" href="shop.php"><i class="bi bi-chevron-left"></i> BACK TO STORE</a>
            <div class="credit text-center p-4 m-4 border-top"> &#169 2024 | all rights reserved </div>
        </div>
    </div>
</section>



</body>
</html>

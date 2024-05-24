<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>  
  <link rel="icon" href="img/logo2.jpg" type="image/x-icon">
 
</head>
<body>
<?php include('script.php'); ?>
<?php include('header.php'); ?>
  
 <section class="container-lg bg-white">
  <div class="mx-1 px-1 mx-lg-5 px-lg-2">
    <div class="row justify-content-around example mt-md-2 mt-xl-5">
      <div class="col-md-5 col-sm-9 col-11 mx-auto my-4 p-4 m-md-2 bg-body-tertiary p-md-3 p-xl-5 p-lg-4">
        <form action="" method="POST">
          <h4 class="py-2">REGISTERED CUSTOMER</h4>  
          <p class="mb-md-3 mb-1 fs14">Welcome, please sign in!</p>
          <input class="form-control form-control-sm p-2 my-2" type="text" placeholder="Email" aria-label=".form-control-sm example">       
          <input class="form-control form-control-sm p-2 mb-4" type="text" placeholder="Password" aria-label=".form-control-sm example">    
          <button type="submit" name="submit" value="submit" class="btn btn-info mb-3 py-2 text-white fs14" style="width: 100%;">SIGN IN</button>
          <p class="fs14 fw-semibold">Forgot Password?</p>
        </form>
      </div>

      <div class="col-md-5 col-sm-9 col-11 mx-auto my-4 p-4 m-md-2 bg-body-tertiary p-md-3 p-xl-5 p-lg-4">
        <h4 class="py-2">GUEST CHECKOUT</h4>
        <p class="mb-5 fs14">You can Checkout without creating an account.</p>
        <a href="guestcheckout.html"><button type="submit" name="submit" value="submit" class="btn btn-info mb-3 py-2 text-white fs14" style="width: 100%;">GUEST CHECKOUT</button></a>
      </div>
    </div>

    <div class="text-center fs14">
      <a class="nav-link" href="shop.html"><i class="bi bi-chevron-left"></i> BACK TO STORE</a>
      <div class="credit text-center p-4 m-4 border-top">  &#169 2024 | all rights reserved </div>            
    </div>
    </div>
 </section>

<?php include('footer.php');?>

</body>
</html>
  
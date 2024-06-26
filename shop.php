<?php
session_start();
include('connection.php');
include('script.php');



if ($_SERVER ["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $quantity = 1;
    // $user_id = $_SESSION['user_id'];
    $product_id = $_POST["product_id"];

    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];

      // Check if the user already has a cart
      $check_cart = mysqli_query($conn, "SELECT cart_id FROM cart WHERE user_id = $user_id LIMIT 1");

      if ($check_cart && mysqli_num_rows($check_cart) == 0){
    
          $max_cart_id_query = mysqli_query($conn, "SELECT MAX(cart_id) AS max_cart_id FROM cart");
          $max_cart_id_row = mysqli_fetch_assoc($max_cart_id_query);
          $max_cart_id = $max_cart_id_row['max_cart_id'];

          $cart_id = $max_cart_id + 1;

    
          $insert_product = mysqli_query($conn, "INSERT INTO cart (cart_id, user_id, product_id, quantity) VALUES ($cart_id, $user_id, $product_id, $quantity)");

          if ($insert_product) {
              // $_SESSION['message'] = 'Product added to cart!';
              echo "hello";
          } else {
              $_SESSION['message'] = 'Failed to add product to cart!';
          }

      } else {
        
          $row = mysqli_fetch_assoc($check_cart);
          $cart_id = $row['cart_id'];
          

          $check_product = mysqli_query($conn, "SELECT * FROM cart WHERE cart_id = $cart_id AND product_id = $product_id");

          if ($check_product && mysqli_num_rows($check_product) > 0) {
          
              $row = mysqli_fetch_assoc($check_product);
              $quantity += $row['quantity']; 
              $update_cart = mysqli_query($conn, "UPDATE cart SET quantity = $quantity WHERE cart_id = $cart_id AND product_id = $product_id");

              if ($update_cart) {
                  $_SESSION['message'] = 'Product quantity updated in cart!';
              } else {
                  $_SESSION['message'] = 'Failed to update product quantity in cart!';
              }
          } else {
        
              $insert_product = mysqli_query($conn, "INSERT INTO cart (cart_id, user_id, product_id, quantity) VALUES ($cart_id, $user_id, $product_id, $quantity)");

              if ($insert_product) {
                  $_SESSION['message'] = 'Product added to cart!';
              } else {
                  $_SESSION['message'] = 'Failed to add product to cart!';
              }
          }
      }
    }
    else{
        // User is not logged in, handle guest cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $product_exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] += $quantity;
                $product_exists = true;
                break;
            }
        }
        
        $_SESSION['message'] = 'Quantity updated!';

        if (!$product_exists) {
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'quantity' => $quantity,
            ];
            $_SESSION['message'] = 'Product added to cart!';
        }

        
    }

   
    header('Location: shop.php');
    exit(); 
  }

// if (isset($_GET['message']) && $_GET['message'] == 'added_to_cart') {
  // echo "<script>
  //     window.onload = function() {
  //         alert('Item added to cart successfully!');
  //         window.history.replaceState({}, document.title, window.location.pathname);
  //     }
  // </script>";
// }

if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];

  unset($_SESSION['message']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="icon" href="img/logo2.jpg" type="image/x-icon">
    <script>
      function clearCartSession(){
       window.location.href = "clear_cart_session.php";
      }
    </script>
</head>
<body>
  <?php include('header.php'); ?>
  
  <button onclick="clearCartSession()">click me</button>
  <section class="container-lg pt-3 pt-md-5">
    <div class="pb-3">
      <nav class="nav" style="font-size: 14px;">
        <a class="nav-link">Home /</a>
        <a class="nav-link" href="#">School</a>
      </nav>
    </div>

    <div class="row">
      <aside class="col-md-3 border-end border-3">
        <div class="p-md-4">
          <div class="range">
            <h4>PRICE</h4>
            <input type="range" class="form-range" id="customRange1">
          </div>
          
          <div class="accordion" id="accordionExample">            
            <div class="accordion-item ">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Category
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <ul class="navbar-nav d-block" style="font-size: 14px;">
                    <li class="nav-item"><a href="#" class="nav-link">Girls</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Boys</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Accessories</a></li>
                  </ul>
                </div>
              </div>     
            </div>

            <div class="accordion-item ">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  Color
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <ul class="navbar-nav d-block" style="font-size: 14px;">
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Red</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">White</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Sky Blue</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Black</a></li>
                  </ul>
                </div>
              </div>     
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                  Sizes
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <ul class="navbar-nav d-block" style="font-size: 14px;">
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Small (16 - 22)</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Medium (24 - 28)</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">Large (30 - 38)</a></li>
                  </ul>
                </div>
              </div>     
            </div>
          </div>
        </div>
      </aside> 

      <div class="mobile ">
        <button class="btn btn-outline-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="bi bi-funnel-fill"></i> Filter</button>

        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-2" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <p>Try scrolling the rest of the page to see this option in action.</p>
          </div>
        </div>
      </div>
      
      <main class="p-3 p-lg-5 col-md-9 col-lg-9">
          <div class="row pb-md-5 p-3">
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM products") or die('Query failed');
              while ($row = mysqli_fetch_array($sql)) {
              ?>
                  <form method="POST" action="shop.php" class="col-sm-6 col-lg-4 fw-semibold mb-md-5 pb-md-5 pb-5">
                      <div class="col mb-3 border text-center p-4">
                          <img src="<?php echo htmlspecialchars($row["product_image"]); ?>" alt="Product Image" width="200px" height="200px">
                      </div>
                      <div class="col d-block">
                          <h6 class="fw-semibold"><?php echo htmlspecialchars($row["product_name"]); ?></h6>
                          <small>Ksh <?php echo htmlspecialchars($row["price"]); ?></small><br>
                          <small class="quantity"><?php echo htmlspecialchars($row["product_quantity"]); ?> in stock</small><br>
                          <button type="submit" class="btn btn-outline-info" name="add_to_cart"><i class="bi bi-bag-fill"></i></button>
                          <button type="button" class="btn btn-outline-info" name="add_to_wishlist"><i class="bi bi-heart-fill"></i></button>
                      </div>
                      <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row["product_id"]); ?>">
                      <input type="hidden" name="quantity" value="1">
                  </form>
              <?php }; ?>
          </div>
      </main>
    </div>
  </section>  
  <script>
    const sessionData = <?php echo json_encode($_SESSION); ?>;
    sessionStorage.setItem('cart', JSON.stringify(sessionData.cart));
    console.log('Session data stored in browser:', sessionStorage.getItem('cart'));
</script>
    <?php include('footer.php'); ?>

</body>
</html>

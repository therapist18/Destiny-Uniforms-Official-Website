<?php
  session_start();
  include('connection.php');
  include('script.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['increment'])) {
    $quantity = $_POST['quantity'] +  1;
    $product_id = $_POST['product_id'];
    $sql = mysqli_query($conn, "UPDATE cart SET quantity = $quantity WHERE product_id = $product_id ");
    echo "quantity updated ";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['decrement'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'] - 1;
    if ($quantity < 1) {
      $quantity = 1; // minimum quantity is 1
    }
    $sql = mysqli_query($conn, "UPDATE cart SET quantity = $quantity WHERE product_id = $product_id ");
    echo "quantity updated ";

  }

  if(isset($_GET['delete'])){
    $remove_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM cart WHERE product_id = '$remove_id'") or die('query failed');
    if($delete_query){
      
       echo '<script> alert ("Product Deleted")</script>';
        header('location:cart.php');
    }
    else{
      //  header('location:cart.php');
      //  $message[] = '<script> alert ("Product not Deleted")</script>';
    }
  };

  if(isset($_GET['delete_all'])){
    $remove_id = $_GET['delete_all'];
    $delete_query = mysqli_query($conn, "DELETE FROM cart") or die('query failed');
    if($delete_query){
      
       echo '<script> alert ("Products Deleted")</script>';
        header('location:cart.php');
    }
    else{
      //  header('location:cart.php');
      //  $message[] = '<script> alert ("Product not Deleted")</script>';
    }
  };

// Increment quantity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['increment'])) {
  $product_id = $_POST['product_id'];
  incrementQuantity($product_id);
  // echo " <script> alert('Quantity Updated successfully');</script>";

  header('Location: cart.php');
}

// Decrement quantity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['decrement']) ) {
  $product_id = $_POST['product_id'];
  decrementQuantity($product_id);
  // echo " <script> alert('Quantity Updated successfully');</script>";

  header('Location: cart.php');

}

// Delete product from session cart
if (isset($_GET['delete'])) {
  $remove_id = $_GET['delete'];
  $cart = $_SESSION['cart'];
  foreach ($cart as $key => $item) {
      if ($item['product_id'] == $remove_id) {
          unset($cart[$key]);
          $_SESSION['cart'] = array_values($cart); // Reset array keys
          $_SESSION['message'] = 'Product deleted from cart successfully!';
          //  echo " <script> alert('Product deleted from cart successfully');</script>";
         
         break;
      }
  }
  header('Location: cart.php?message=delete');
}

function incrementQuantity($product_id) {
  foreach ($_SESSION['cart'] as &$item) {
      if ($item['product_id'] == $product_id) {
          $item['quantity']++;
          break;
      }
  }
}

function decrementQuantity($product_id) {
  foreach ($_SESSION['cart'] as &$item) {
      if ($item['product_id'] == $product_id) {
          if ($item['quantity'] > 1) {
              $item['quantity']--;
          }
          break;
      }
  }
}



if (isset($_GET['message']) && $_GET['message'] == 'delete') {
echo "<script>
  window.onload = function() {
      alert('Item deleted from cart successfully!');
      window.history.replaceState({}, document.title, window.location.pathname);
  }
</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cart</title>  
  <link rel="icon" href="img/logo2.jpg" type="image/x-icon">
</head>
<body>
<?php include('header.php'); ?>

<section class="container-lg mb-5">
  <div class="pb-3">
    <nav class="nav" style="font-size: 14px;">
      <a class="nav-link">Home /</a>
      <a class="nav-link" href="#">School</a>
    </nav>
  </div> 
</section> 

  <?php 
    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
  ?>

  <section class="container-lg">
  <table class="container">
    <thead>
      <tr>
        <th scope="col" class="p-2" style="background-color: var(--primary-color) !important; border-right:3px solid #ffff;">Product</th>
        <th scope="col" class="p-2" style="background-color: var(--primary-color) !important;border-right:3px solid #ffff;">Quantity</th>
        <th scope="col" class="p-2" style="background-color: var(--primary-color) !important;">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $sql = mysqli_query($conn, "SELECT cart.cart_id, cart.user_id, cart.product_id, cart.quantity, products.product_name, products.product_image, products.price FROM cart 
      INNER JOIN products ON cart.product_id = products.product_id 
      WHERE cart.user_id = $user_id") or die('Query failed');
      $subtotal = 0;
      
      if(mysqli_num_rows($sql) > 0){
      while ($row = mysqli_fetch_array($sql)){
        $subtotal += ($row['price'] * $row['quantity']);
      ?>
      <tr class="border-bottom border-info">
        <td class="row p-3">
          <div class="col-12 col-md-3">
            <img src="<?php echo htmlspecialchars($row['product_image']); ?>" width="150px" class="image-fluid">
          </div>
          <div class="col-12 col-md-9 mt-2 mt-lg-4 pt-lg-4 desc">
            <small><?php echo htmlspecialchars($row['product_name']); ?></small><br>
            <small class="fw-light">Price: Ksh <?php echo htmlspecialchars($row['price']); ?></small><br>
            <!-- <button type="button" class="btn btn-outline-info" onclick="removeFromCart(<?php echo $row['product_id']; ?>)"><i class="bi bi-trash-fill"></i></button> -->
            <a href="cart.php?delete=<?php echo htmlspecialchars($row['product_id']); ?>" class="btn btn-outline-info" onclick="return confirm('Are you sure you want to remove item from cart?');"><i class="bi bi-trash-fill"></i></a>
          </div>
        </td>
        <td>
        <form action="" method="POST">
          <div class="card">
            <button type="submit" class="inc-dec-btn" name="increment">+</button>
            <div class="number text-center" min="1" ><?php echo htmlspecialchars($row['quantity']); ?></div>
            <button type="submit" class="inc-dec-btn" name="decrement">-</button>
          </div> 
          
          <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>">
          <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
        </form>         
          <!-- <div class="number text-center" min="1"><?php echo htmlspecialchars($row['quantity']); ?></div> -->
        </td>
        <td>
          <p class="text-center">Ksh <?php echo htmlspecialchars($row['price'] * $row['quantity']); ?></p>
        </td>
      
        <td>
        <?php } }
      else{
                  echo '  <div class="cart-body">
              
                  <p class="empty-cart" >Your Cart is currently empty.</p>
                </div>';
               }?>
      </td>
    </tr>
      <tr>
        <td></td>
        <td class="total col-12 p-3">
          <p>Subtotal </p>
          <!-- You can add more rows for Tax, Total, etc. -->
        </td>
        <td>
          <p>Ksh <?php echo htmlspecialchars($subtotal); ?></p>
          <!-- You can add more rows for Tax, Total, etc. -->
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td class="text-center">
          <a href="cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="ms-3 <?php echo ($subtotal > 1)?'':'disabled'; ?> btn btn-outline-info"> <i class="bi bi-trash-fill"></i> delete all </a></td>
        </td>
        </tr>
    </tbody>
  </table>
  </section>
  
  <?php }
  else {
    if(isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      $subtotal = 0; // Initialize subtotal variable
    }
   ?>
    
    <section class="container-lg">
        <table class="container">
            <thead>
                <tr>
                    <th scope="col" class="p-2" style="background-color: var(--primary-color) !important; border-right:3px solid #ffff;">Product</th>
                    <th scope="col" class="p-2" style="background-color: var(--primary-color) !important;border-right:3px solid #ffff;">Quantity</th>
                    <th scope="col" class="p-2" style="background-color: var(--primary-color) !important;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($cart as $item) {
                    // Fetch product details from the database based on product_id
                    $product_id = $item['product_id'];
                    $product_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $product_id");
                    $product = mysqli_fetch_assoc($product_query);
                    $subtotal += ($product['price'] * $item['quantity']);
                ?>
                <tr class="border-bottom border-info">
                    <td class="row p-3">
                        <div class="col-12 col-md-3">
                            <img src="<?php echo htmlspecialchars($product['product_image']); ?>" width="150px" class="image-fluid">
                        </div>
                        <div class="col-12 col-md-9 mt-2 mt-lg-4 pt-lg-4 desc">
                            <small><?php echo htmlspecialchars($product['product_name']); ?></small><br>
                            <small class="fw-light">Price: Ksh <?php echo htmlspecialchars($product['price']); ?></small><br>
                            <a href="cart.php?delete=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-outline-info" onclick="return confirm('Are you sure you want to remove item from cart?');"><i class="bi bi-trash-fill"></i></a>
                        </div>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <div class="card">
                                <button type="submit" class="inc-dec-btn" name="increment">+</button>
                                <div class="number text-center" min="1" ><?php echo htmlspecialchars($item['quantity']); ?></div>
                                <button type="submit" class="inc-dec-btn" name="decrement">-</button>
                            </div> 
                            
                            <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        </form>         
                    </td>
                    <td>
                        <p class="text-center">Ksh <?php echo htmlspecialchars($product['price'] * $item['quantity']); ?></p>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td class="total col-12 p-3 text-center">
                        <p>Subtotal </p>
                    </td>
                    <td class="text-center">
                        <p>Ksh <?php echo htmlspecialchars($subtotal); ?></p>
                    </td>
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td class="text-center">
                  <a href="cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="ms-3 <?php echo ($subtotal > 1)?'':'disabled'; ?> btn btn-outline-info"> <i class="bi bi-trash-fill"></i> delete all </a></td>
                </td>
                </tr>
            </tbody>
        </table>
    </section>

  <?php } ?>

<section class="container-lg mt-5 mb-5 action-btns">
  <div class="container justify-content-evenly d-flex">
    <a href="shop.php"><button type="button" class="btn btn-outline-info"><i class="bi bi-chevron-left"></i> Continue Shopping</button></a>
    <a href="checkout.php"><button type="button" class="btn btn-outline-info">Proceed to Checkout <i class="bi bi-chevron-right"></i></button></a>
  </div>
</section>

<?php include('footer.php'); ?>

</body>
</html>

<?php

  include("connection.php");
  // Check if user_id is set in the session
  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

  if($user_id == null){
    echo "null user";
  }
  else{
    echo $user_id;
  }
  
  if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
  };

  $select_rows = mysqli_query($conn, " SELECT * FROM cart WHERE user_id = $user_id");
  $row_count = mysqli_num_rows($select_rows);
  $_SESSION['row_count'] =  $row_count;
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/logo2.jpg" type="image/x-icon"> 
  <!-- <script>
     // Function to update the cart count in the UI based on the number of distinct product IDs
    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let count = Object.keys(cart).length;  // Count the number of distinct product IDs
        document.querySelector('.countcart').textContent = count;
    }
        function addToLocalStorage(productId, quantity) {
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            cart[productId] = (cart[productId] || 0) + quantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Item added to local storage cart!');
        }

        function addToCart(productId, quantity) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'shop.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    alert('Item added to cart!');
                }
            };
            xhr.send('product_id=' + productId + '&quantity=' + quantity);
        }

        function handleAddToCart(event) {
            event.preventDefault();
            const form = event.target;
            const productId = form.product_id.value;
            const quantity = parseInt(form.quantity.value);

            const userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;
            if (userId) {
                addToCart(productId, quantity);
            } else {
                addToLocalStorage(productId, quantity);
            }
        }

        // Function to retrieve cart from local storage
        function retrieveCartFromLocalStorage() {
            const cart = JSON.parse(localStorage.getItem('cart')) || {};
            // Update UI with cart items
            console.log(cart);
        }

        window.onload = function() {
        updateCartCount();
    };
    </script> -->
</head>
<body>

  <nav class="navbar navbar-one p-0 navbar-expand-lg">
    <div class="container-lg">
      <div class="left d-flex">
        <div class="d-flex pe-2">
          <i class="bi bi-telephone-fill pe-2"></i>
          <a class="nav-link" href="tel:0759935152"> 0759935152</a>
        </div>

        <a class="nav-link" href="#">Blog</a>
      </div>

      <div class="header-alert-news" style="color: var(--primary-color); font-size: 14px;">
        <p><b>Free Shipping</b></p>
      </div>

      <div class="right">
        
        <!-- <div class="collapse navbar-collapse" id="navbarSupportContent"> -->
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <?php if ($user_id == null ): ?>
              <li class="nav-item "><a class="nav-link" href="login.php">Login</a></li>
            <?php else: ?>
              <li class="nav-item "><a class="nav-link" href="logout.php" onclick="return confirm('are your sure you want to logout?');">Logout</a></li>
            <?php endif; ?>  
            <li class="nav-item desktop-only"><a class="nav-link" href="register.php">Register</a></li>
            <li class="nav-item desktop-only"><a class="nav-link " href="login.php" onclick = " alert('Sign in to track your order');">Order Tracking</a></li>
            <li class="nav-item d-flex"><!--<img src="img/colorwheel.jpeg" width="20px" height="20px">--><a class="nav-link" href="sizechart.php"><i class="bi bi-palette-fill "></i> Colors</a></li>
            <li class="nav-item "><a class="nav-link" href="school.php">Shop By School</a></li>          
          </ul>
        </div>
      </div>
    </div>
  </nav>
  
  <nav class="navbar navbar-two navbar-expand-lg">
    <div class="container-lg desktop-only">
      <div class="left">
        <a href="index.php" class="navbar-brand">
          <img src="img/logo2.jpg" width="70px" height="70px">
        </a>
      </div>

      <div class="right d-flex">
        <form role="search" class="me-5 mt-2">
          <input class="form-control form-control-sm pe-5 " type="search" placeholder="search here" aria-label="Search">
        </form> 

        <div class="header-user-actions">
        <a href="wishlist.php" class="nav-item">
          <button class="action-btn">
            <i class="bi bi-heart"></i> 
            <span class="count">0</span>
          </button>
        </a>  

        <a href="cart.php">
          <button class="action-btn">
            <i class="bi bi-bag"></i>
            <span class="count countcart"><?php echo $row_count;?></span>
          </button>
        </a>
        </div>
      </div>

    </div>

    <div class="container-lg mobile-only">
      <div class="left d-flex justify-content-between">
        <a href="index.php" class="navbar-brand">
          <img src="img/logo2.jpg" width="70px" height="70px">
        </a>

        <div class="header-user-actions mt-3">
          <button class="action-btn">
            <i class="bi bi-heart"></i> 
            <span class="count">0</span>
          </button>
          
          <button class="action-btn">
            <i class="bi bi-bag"></i>
            <span class="count">0</span>
          </button>
        </div>
      </div>

      <div class="right ">
        <form role="search" class="me-5 mt-2">
          <input class="form-control form-control-sm pe-5 " type="search" placeholder="search here" aria-label="Search">
        </form> 
      </div>
    </div>
  </nav>

  <div class="navbar-three sticky-top">
    <div class="container-lg">
      <ul class="nav justify-content-center desktop-only">
        <li class="nav-item mega-links"><a href="#" class="nav-link">MEDICAL<span><i class="bi bi-chevron-down" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">WOMEN</h6>
                  <ul class="navbar-nav d-block" style="font-size: 14px;">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Tops</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Prints</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Labcoats</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Jackets</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Dresses and Skirts</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">MEN</h6>
                  <ul class="navbar-nav d-block">                  
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Tops</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Labcoats</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Jackets</a></li> 
                  </ul>

                  <h6 class="fw-bold mt-5">OTHERS</h6>                  
                  <ul class="navbar-nav d-block">  
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Accessories</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Footwear</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Scrub Caps</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/black_doc.jpg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div> 
        </li>

        <li class="nav-item mega-links"><a href="#" class="nav-link">SCHOOL<span><i class="bi bi-chevron-down"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">GIRLS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold" st>BOYS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/fashion-gf4662c7d0_1280.jpg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div> 
        </li>

        <li class="nav-item mega-links"><a href="#" class="nav-link">INDUSTRIAL<span><i class="bi bi-chevron-down"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">WORKWEAR</h6>
                  <ul class="navbar-nav d-block">                    
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Work Shirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Work Pants</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">AUTOMOTIVE</h6>
                  <ul class="navbar-nav d-block">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Automotive Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Automotive Shirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Automotive Jackets</a></li>
                  </ul>
                </div>
              </div>

              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">FLAME RESISTANT UNIFORMS</h6>
                  <ul class="navbar-nav d-block">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>FR Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>FR Shirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>FR Coveralls</a></li>
                  </ul>

                  <h6 class="fw-bold">HI-VISIBILITY</h6>
                  <ul class="navbar-nav d-block">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>HI-Visibility Shirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>HI-Visibility Vests</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/radiansyellow.jpeg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div>  
        </li>

        <li class="nav-item mega-links"><a href="#" class="nav-link">CORPORATE<span><i class="bi bi-chevron-down"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">IMAGEWEAR</h6>
                  <ul class="navbar-nav d-block">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>T-Shirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Polos</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Accessories</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">OUTWEAR</h6>
                  <ul class="navbar-nav d-block">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Jackets</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">CAREERWEAR</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                      <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Blazers</a></li>
                      <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Vests</a></li>
                      <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Blouses</a></li>
                      <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>DressShirts</a></li>
                      <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                      <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                      <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/corporate.jpeg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div> 
        </li>

        <li class="nav-item mega-links"><a href="#" class="nav-link">HOSPITALITY<span><i class="bi bi-chevron-down"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">GIRLS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">BOYS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/chefJ 2.jpeg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div>  
        </li>

        <li class="nav-item mega-links"><a href="#" class="nav-link">PUBLIC SAFETY<span><i class="bi bi-chevron-down"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">GIRLS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">BOYS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/public_safety.jpg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div>  
        </li>

        <li class="nav-item mega-links"><a href="#" class="nav-link">FOOTWARE<span><i class="bi bi-chevron-down"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">GIRLS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">BOYS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/shoes.jpg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div>  
        </li>

        <li class="nav-item mega-links"><a href="#" class="nav-link">THEME UNIFORMS<span><i class="bi bi-chevron-down"></i></span></a>
          <div class="container-fluid mega-box">
            <div class="row">
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">GIRLS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
    
              <div class="container col-md-3 p-3">
                <div class="main">
                  <h6 class="fw-bold">BOYS</h6>
                  <ul class="navbar-nav d-block">
                    <h6>Tops</h6>
                    
                    <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                    <h6>Bottoms</h6>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="container col-md-3 p-3"><img src="img/african_theme_uniform.jpg"></div>
            </div>

            <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
          </div>  
        </li>
      </ul>
      <div class="menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="bi bi-list float-end"></i></div>

      <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header" id="offcanvasWithBothOptionsLabel">
          <h3 class="fw-semi-bold" id="offcanvasLabel">Menu</h3>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body">          
          <div class="accordion" id="accordionExample">
            
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Medical
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">WOMEN</h6>
                          <ul class="navbar-nav d-block" style="font-size: 14px;">
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Tops</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Prints</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Labcoats</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Jackets</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Dresses and Skirts</a></li>
                          </ul>
                        </div>
                      </div>
            
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">MEN</h6>
                          <ul class="navbar-nav d-block">                  
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Tops</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Labcoats</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Jackets</a></li> 
                          </ul>
        
                          <h6 class="fw-bold mt-5">OTHERS</h6>                  
                          <ul class="navbar-nav d-block">  
                            <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Accessories</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Footwear</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Scrub Caps</a></li>
                          </ul>
                        </div>
                      </div>
                      
                      <div class="container col-md-3 p-3"><img src="img/black_doc.jpg"></div>
                    </div>
        
                    <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                  </div> 
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  School
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="container-fluid ">
                    <div class="row">
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">GIRLS</h6>
                          <ul class="navbar-nav d-block">
                            <h6>Tops</h6>
                            
                            <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                            <h6>Bottoms</h6>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                          </ul>
                        </div>
                      </div>
            
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold" st>BOYS</h6>
                          <ul class="navbar-nav d-block">
                            <h6>Tops</h6>
                            
                            <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                            <h6>Bottoms</h6>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                          </ul>
                        </div>
                      </div>
                      
                      <div class="container col-md-3 p-3"><img src="img/fashion-gf4662c7d0_1280.jpg"></div>
                    </div>
        
                    <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                 Corporate
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">IMAGEWEAR</h6>
                          <ul class="navbar-nav d-block">
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>T-Shirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Polos</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Accessories</a></li>
                          </ul>
                        </div>
                      </div>
            
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">OUTWEAR</h6>
                          <ul class="navbar-nav d-block">
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Jackets</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                          </ul>
                        </div>
                      </div>
                      
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">CAREERWEAR</h6>
                          <ul class="navbar-nav d-block">
                            <h6>Tops</h6>
                              <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Blazers</a></li>
                              <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Vests</a></li>
                              <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Blouses</a></li>
                              <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>DressShirts</a></li>
                              <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                            <h6>Bottoms</h6>
                              <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                              <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                          </ul>
                        </div>
                      </div>
                      
                      <div class="container col-md-3 p-3"><img src="img/corporate.jpeg"></div>
                    </div>
        
                    <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                  </div> 
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                 Industrial
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">WORKWEAR</h6>
                          <ul class="navbar-nav d-block">                    
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Work Shirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Work Pants</a></li>
                          </ul>
                        </div>
                      </div>
            
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">AUTOMOTIVE</h6>
                          <ul class="navbar-nav d-block">
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Automotive Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Automotive Shirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Automotive Jackets</a></li>
                          </ul>
                        </div>
                      </div>
        
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">FLAME RESISTANT UNIFORMS</h6>
                          <ul class="navbar-nav d-block">
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>FR Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>FR Shirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>FR Coveralls</a></li>
                          </ul>
        
                          <h6 class="fw-bold">HI-VISIBILITY</h6>
                          <ul class="navbar-nav d-block">
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>HI-Visibility Shirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>HI-Visibility Vests</a></li>
                          </ul>
                        </div>
                      </div>
                      
                      <div class="container col-md-3 p-3"><img src="img/radiansyellow.jpeg"></div>
                    </div>
        
                    <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                  </div> 
                 </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                 Hospitality
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="container-fluid ">
                    <div class="row">
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">GIRLS</h6>
                          <ul class="navbar-nav d-block">
                            <h6>Tops</h6>
                            
                            <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                            <h6>Bottoms</h6>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                          </ul>
                        </div>
                      </div>
            
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">BOYS</h6>
                          <ul class="navbar-nav d-block">
                            <h6>Tops</h6>
                            
                            <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                            <h6>Bottoms</h6>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                          </ul>
                        </div>
                      </div>
                      
                      <div class="container col-md-3 p-3"><img src="img/chefJ 2.jpeg"></div>
                    </div>
        
                    <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                  </div> 
                 </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                 Public Saftey
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="container-fluid ">
                  <div class="row">
                    <div class="container col-md-3 p-3">
                      <div class="main">
                        <h6 class="fw-bold">GIRLS</h6>
                        <ul class="navbar-nav d-block">
                          <h6>Tops</h6>
                          
                          <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                          <h6>Bottoms</h6>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                        </ul>
                      </div>
                    </div>
          
                    <div class="container col-md-3 p-3">
                      <div class="main">
                        <h6 class="fw-bold">BOYS</h6>
                        <ul class="navbar-nav d-block">
                          <h6>Tops</h6>
                          
                          <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                          <h6>Bottoms</h6>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                        </ul>
                      </div>
                    </div>
                    
                    <div class="container col-md-3 p-3"><img src="img/public_safety.jpg"></div>
                  </div>
      
                  <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                </div> 
              </div>
            </div>    

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                  Footwear
                </button>
              </h2>
              <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="container-fluid ">
                  <div class="row">
                    <div class="container col-md-3 p-3">
                      <div class="main">
                        <h6 class="fw-bold">GIRLS</h6>
                        <ul class="navbar-nav d-block">
                          <h6>Tops</h6>
                          
                          <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                          <h6>Bottoms</h6>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                        </ul>
                      </div>
                    </div>
          
                    <div class="container col-md-3 p-3">
                      <div class="main">
                        <h6 class="fw-bold">BOYS</h6>
                        <ul class="navbar-nav d-block">
                          <h6>Tops</h6>
                          
                          <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                          <h6>Bottoms</h6>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                          <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                        </ul>
                      </div>
                    </div>
                    
                    <div class="container col-md-3 p-3"><img src="img/shoes.jpg"></div>
                  </div>
      
                  <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                </div> 
              </div>
            </div>  
          
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                 Theme Uniforms
                </button>
              </h2>
              <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="container-fluid ">
                    <div class="row">
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">GIRLS</h6>
                          <ul class="navbar-nav d-block">
                            <h6>Tops</h6>
                            
                            <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                            <h6>Bottoms</h6>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                          </ul>
                        </div>
                      </div>
            
                      <div class="container col-md-3 p-3">
                        <div class="main">
                          <h6 class="fw-bold">BOYS</h6>
                          <ul class="navbar-nav d-block">
                            <h6>Tops</h6>
                            
                            <li class="nav-item"><a href="" class="nav-link"><i class="bi bi-chevron-right"></i>Shirt</a></li>
                            <h6>Bottoms</h6>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Pants</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Shorts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skirts</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chevron-right"></i>Skorts</a></li>
                          </ul>
                        </div>
                      </div>
                      
                      <div class="container col-md-3 p-3"><img src="img/african_theme_uniform.jpg"></div>
                    </div>
        
                    <div class="credit text-center p-4 m-4 border-top">  &#169 2023 | all rights reserved </div>            
                  </div>  
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
  </div>    

  
</body>
</html>
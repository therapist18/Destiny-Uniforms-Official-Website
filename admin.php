<?php
include('connection.php');
include('script.php');
session_start();

  $first_name = $_SESSION['first_name'];

  if(!isset($user_name)){
    header('location:login.php');
  };

  if(isset($_GET['logout'])){
    unset($user_name);
    session_destroy();
    header('location:login.php');
  };

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="img/logo2.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <!-- MATERIAL CDN -->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
</head>
<body>

<section class="container-fluid dashboard">
  <div class="row px-4">
    <div class="col-lg-2">
      <aside>
        <a href="index.php" class="navbar-brand d-flex mt-2">
          <img src="img/logo2.jpg" width="40px" height="40px" class="m-2">
          <h4 class="fw-semibold m-2">DESTINY <span style="color:var(--primary-color);"><br> UNIFORMS</span></h4>       
        </a>

        <div class="sidebar">
          <a href="admin.php" class="active">
            <span class="material-icons-sharp">grid_view</span>
            <h6>Dashboard</h6>
          </a>
          <a href="customer.php" >
            <span class="material-icons-sharp">person_outline</span>
            <h6>Customers</h6>
          </a>
          <a href="orders.php">
            <span class="material-icons-sharp">receipt_long</span>
            <h6>Orders</h6>
          </a>
          <a href="#">
            <span class="material-icons-sharp">insights</span>
            <h6>Analytics</h6>
          </a>
          <a href="#">
            <span class="material-icons-sharp">mail_outline</span>
            <h6>Messages</h6>
            <span class="message-count">26</span>
          </a>
          <a href="products.php">
            <span class="material-icons-sharp">inventory</span>
            <h6>Products</h6>
          </a>
          
          <a href="#">
            <span class="material-icons-sharp">settings</span>
            <h6>Settings</h6>
          </a>
          <a href="addproduct.php">
            <span class="material-icons-sharp">add</span>
            <h6>Add Product</h6>
          </a>
          <a href="login.php">
            <span class="material-icons-sharp">logout</span>
            <h6>Logout</h6>
          </a>
        </div>
      </aside>
    </div>

    <div class="col-lg-7">
      <h2 class="fw-semibold my-4">Dashboard</h2>

      <div class="date my-3 py-2 px-5"><input type="date"></div>
      
      <div class="insights">
        <div class="sales">
          <span class="material-icons-sharp">analytics</span>
          <div class="middle">
            <div class="left">
              <h6>Total Sales</h6>
              <h3>$25,024</h3>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>81%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Last 24 Hours</small>
        </div>
        <!------------ END OF SALES -------------->
        <div class="expenses">
          <span class="material-icons-sharp">bar_chart</span>
          <div class="middle">
            <div class="left">
              <h6>Total Expenses</h6>
              <h3>$14,160</h3>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>62%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Last 24 Hours</small>
        </div>
        <!------------ END OF EXPENSES -------------->
        <div class="income">
          <span class="material-icons-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h6>Total Income</h6>
              <h3>$10,864</h3>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>44%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Last 24 Hours</small>
        </div>
    <!------------ END OF INCOME -------------->
      </div>
     
      <div class="recent-orders row">
        <h4>Recent Orders</h4>
        <table>
            <thead>
              <tr>
                <th>Order Number</th>
                <th>Product Name</th>
                <th>Phone Number</th>
                <th>Quantity</th>
                <th>Payment</th>
                <th>Total</th>
                <th>Discount</th>
                <th>Amt Paid</th>
                <th>Status</th>
                <th></th>
              </tr>
              </thead>
            <tbody>
              <?php
                $order_query = mysqli_query($conn, "SELECT orders.order_id, orders.user_id, 
                order_items.product_id, order_items.quantity,orders.amt_paid,orders.status,orders.pay_means,order_items.disc_allowd,
                products.product_name, products.price,users.phone_no
                FROM orders 
                JOIN order_items ON orders.order_id = order_items.order_id 
                JOIN users ON orders.user_id = users.user_id
                JOIN products ON order_items.product_id = products.product_id") 
                or die('Query failed');
                $total = 0;
                if(mysqli_num_rows($order_query) > 0){
                    while($fetch_order = mysqli_fetch_assoc($order_query)){
                      $total = ($fetch_order["quantity"] * $fetch_order["price"]);
              ?>
              <tr >
              <td><?php echo $fetch_order["order_id"]; ?></td>
              <td><?php echo $fetch_order["product_name"]; ?></td>
              <td><?php echo $fetch_order["phone_no"]; ?></td>
              <td><?php echo $fetch_order["quantity"]; ?></td>
              <td><?php echo $fetch_order["pay_means"]; ?></td>
              <td><?php echo $total ?></td>
              <td><?php echo $fetch_order["disc_allowd"]; ?></td>
              <td><?php echo $fetch_order["amt_paid"]; ?></td>
              <td><?php echo $fetch_order["status"]; ?></td>
              <?php }
              }; ?>
            </tbody>
          </table>
          <a href="#">Show All</a>
      </div>
    </div>

    <div class="col-lg-3 ps-5">
    <div class="right">
        <div class="top mb-4">
          <button id="menu-btn">
            <span class="material-icons-sharp">menu</span>
          </button>
          <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
          </div>
          <div class="profile">
            <div class="info">
              <p>Hey, <b><?php echo $first_name?></b></p>
              <small class="text-muted">Admin</small>
            </div>
            <div class="profile-photo">
              <img src="img/black_doc.jpg" />
            </div>
          </div>
        </div>
        <!-- END OF TOP -->
        <div class="recent-updates">
          <h4 class="my-3 py-2 fw-semibold">Recent Updates</h4>
          <div class="updates">
            <div class="update">
              <div class="profile-photo">
                <img src="img/black_doc.jpg" />
              </div>
              <div class="message">
                <p>
                  <b>Mike Tyson</b> received his order of Night lion tech GPS
                  drone.
                </p>
                <small class="text-muted">2 Minutes Ago</small>
              </div>
            </div>
            <div class="update">
              <div class="profile-photo">
                <img src="img/black_doc.jpg" />
              </div>
              <div class="message">
                <p>
                  <b>Mike Tyson</b> received his order of Night lion tech GPS
                  drone.
                </p>
                <small class="text-muted">2 Minutes Ago</small>
              </div>
            </div>
            <div class="update">
              <div class="profile-photo">
                <img src="img/black_doc.jpg" />
              </div>
              <div class="message">
                <p>
                  <b>Mike Tyson</b> received his order of Night lion tech GPS
                  drone.
                </p>
                <small class="text-muted">2 Minutes Ago</small>
              </div>
            </div>
          </div>
        </div>
        <!----------------- END OF RECENT UPDATES -------------------->
        <div class="sales-analytics">
          <div class="item add-product">
            <div>
              <span class="material-icons-sharp">add</span>
              <h6>Add Product</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// show sidebar
menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

// close sidebar
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
})

// change theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})
</script>
 <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


  </body>
</html>

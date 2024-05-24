<?php 
session_start();
include('script.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destiny Uniforms</title> 
  <link rel="icon" href="img/logo2.jpg" type="image/x-icon">

</head>
<body>

<?php include('header.php');?>
    
  <section class="hero container-fluid position-relative">
    <div class="row float-end mb-5 ">
      <div class="col-md-6 position-relative d-flex align-items-center"> <!-- Added d-flex and align-items-center -->
        <div class="image mx-auto"> <!-- Added mx-auto to center the image horizontally -->
          <img src="img/suit-removebg-preview.jpg" class="img-fluid">
          <div class="overlay"></div>
        </div>
        <div class="overlay-text position-absolute top-50 start-50 translate-middle text-center text-md-start">
          <h1 class="lh-base">Exception for everyone with unique style</h1>
          <h6 class="fw-semibold">Perfect costume created for just its owner only</h6>
          <a href="shop.php" class="d-block mt-3">
            <button class="butn">Shop Now!</button>
          </a>
        </div>
      </div>
      <div class="col-md-6 align-self-center">
        <div class="col col-lg-10">
        <div class="text-center text-md-start p-md-5 d-none d-md-block">
          <h1 class="lh-base">Exception for everyone with unique style</h1>
          <h6 class="fw-semibold">Perfect costume created for just its owner only</h6>
          <a href="shop.php">
            <button class="butn mt-4">Shop Now!</button>
          </a>
        </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="services container-fluid mt-5 p-md-5 p-3"> <!-- Added smaller padding for medium and above screens -->
    <div class="container row mx-auto ">
      <div class="col-lg-4 col-md-6 mb-4 box">
        <div class="col bg-light d-flex">
          <div class="col-2 border-end border-3 border-white text-center">
            <i class="bi bi-headset"></i>
          </div>
  
          <div class="col-md-10 ms-2">
            <div class="service-desc">
              <h6>EMBROIDERY</h6>
              <small>Get Custom Embroidery On Your Uniforms.</small>         
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-lg-4 col-md-6 mb-4 box">
        <div class="col bg-light d-flex">        
          <div class="col-2 border-end border-3 border-white text-center">
            <i class="bi bi-headset"></i>
          </div>
  
          <div class="col-md-10 ms-2">
            <div class="service-desc">
              <h6>T SHIRT PRINTING</h6>
              <small>Talk To Our Team About T Shirt Printing Today.</small>    
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-lg-4 col-md-6 mb-4 box">
        <div class="col bg-light d-flex">        
          <div class="col-2 border-end border-3 border-white text-center">
            <i class="bi bi-headset"></i>
          </div>
  
          <div class="col-md-10  ms-2">
            <div class="service-desc">
              <h6>DYE SUBLIMATION</h6>
              <small>Lorem, ipsum dolor sit amet.Lorem, ipsum dolo</small>     
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="featured-products">
    <div class="container-fluid">
      <div class="row container mb-5 mt-5 mx-auto">
        <div class="col-md-4 bg-info p-0">
            <img src="img/black kid.jpg" class="">            
        </div>

        <div class="col-md-8 p-5">
          <h3 class="mb-5">SHOP SCHOOL UNIFORMS</h3>
          <div class="row">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="col-md-4 swiper-slide fw-semibold p-2">
                  <div class="col mb-3">
                    <img src="img/creamshirt.jpeg" class="">
                  </div>

                  <div class="col d-block">
                    <h6 class="fw-semibold">Cream Shirt</h6>
                    <small>500</small><br>
                    <button class="btn btn-outline-info"><i class="bi bi-bag-fill"></i></button>
                    <button class="btn btn-outline-info"><i class="bi bi-heart-fill"></i></button>
                  </div> 
                </div>

                <div class="col-md-4 swiper-slide fw-semibold p-2">
                  <div class="col mb-3">
                    <img src="img/black T.jpg" class="">
                  </div>

                  <div class="col d-block">
                    <h6 class="fw-semibold">Black T-shirt</h6>
                    <small>500</small><br>
                    <button class="btn btn-outline-info"><i class="bi bi-bag-fill"></i></button>
                    <button class="btn btn-outline-info"><i class="bi bi-heart-fill"></i></button>
                  </div> 
                </div>

                <div class="col-md-4 swiper-slide fw-semibold p-2">
                  <div class="col mb-3">
                    <img src="img/radiansyellow.jpeg" class="">
                  </div>

                  <div class="col d-block">
                    <h6 class="fw-semibold">HI-Visibility Shirt</h6>
                    <small>500</small><br>
                    <button class="btn btn-outline-info"><i class="bi bi-bag-fill"></i></button>
                    <button class="btn btn-outline-info"><i class="bi bi-heart-fill"></i></button>
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row container mb-5 mt-5 mx-auto">
        <div class="col-md-8 p-5">
          <h3 class="mb-5">SHOP SCHOOL UNIFORMS</h3>
          <div class="row">            
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="col-md-4 swiper-slide fw-semibold p-2">
                  <div class="col mb-3">
                    <img src="img/black chef coat.jpeg" class="">
                  </div>

                  <div class="col d-block">
                    <h6 class="fw-semibold">Cream Shirt</h6>
                    <small>500</small><br>
                    <button class="btn btn-outline-info"><i class="bi bi-bag-fill"></i></button>
                    <button class="btn btn-outline-info"><i class="bi bi-heart-fill"></i></button>
                  </div> 
                </div>

                <div class="col-md-4 swiper-slide fw-semibold p-2">
                  <div class="col mb-3">
                    <img src="img/tshirt-red.jpeg" class="">
                  </div>

                  <div class="col d-block">
                    <h6 class="fw-semibold">Black T-shirt</h6>
                    <small>500</small><br>
                    <button class="btn btn-outline-info"><i class="bi bi-bag-fill"></i></button>
                    <button class="btn btn-outline-info"><i class="bi bi-heart-fill"></i></button>
                  </div> 
                </div>

                <div class="col-md-4 swiper-slide fw-semibold p-2">
                  <div class="col mb-3">
                    <img src="img/socks.jpeg" class="">
                  </div>

                  <div class="col d-block">
                    <h6 class="fw-semibold">HI-Visibility Shirt</h6>
                    <small>500</small><br>
                    <button class="btn btn-outline-info"><i class="bi bi-bag-fill"></i></button>
                    <button class="btn btn-outline-info"><i class="bi bi-heart-fill"></i></button>
                  </div> 
                </div>
              </div>
            </div>
            </div>
        </div>

        <div class="col-md-4 bg-info p-0">
          <img src="img/redkap-mainsubbanner1.jpg" class="">            
      </div>
      </div>
    </div>
  </section>

  <!-- <section class="about container-fluid">
    <div class="text-center bg-light p-5">
      <h1>ALL UNIFORM WEAR</h1>
      <h5 class="fw-normal">Our family-owned business has been providing uniforms for schools and private institutions for over <br>40 years. We also offer professional workwear for those in the medical or industrial fields <br>by the top brands for protective clothing</h5>

      <div class="d-flex justify-content-center p-5">
        <button class="btn btn-outline-info m-4">Read our Story</button>
        <button class="btn btn-outline-info m-4">Store Locator</button>
                
      </div>
    </div>
  </section> -->

  <?php include('footer.php'); ?>
  

  <a href="project.html">hey</a>
</body>
</html>
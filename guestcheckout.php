<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schools</title>  
  <link rel="icon" href="img/logo2.jpg" type="image/x-icon">
  
</head>
<body>
<?php include('script.php'); ?>
<?php include('header.php'); ?>

  <section class="container-lg">   
    <div class="row justify-content-around ">
      <div class="col-md-5 my-5 p-2 p-md-0">
        <div class="bg-body-tertiary p-3 p-md-5">
          <h4 class="border-bottom py-2">Billing Info</h4>
          <form action="">
            <input class="form-control form-control-sm p-2 p-sm-3 my-3" type="text" placeholder="First Name" aria-label=".form-control-sm example">       
            <input class="form-control form-control-sm p-2 p-sm-3 my-3" type="text" placeholder="Last Name" aria-label=".form-control-sm example">       
            <input class="form-control form-control-sm p-2 p-sm-3 my-3" type="text" placeholder="Email" aria-label=".form-control-sm example">       
            <input class="form-control form-control-sm p-2 p-sm-3 my-3" type="text" placeholder="Phone no." aria-label=".form-control-sm example">       
            <input class="form-control form-control-sm p-2 p-sm-3 my-3" type="text" placeholder="Address" aria-label=".form-control-sm example">       
            
          </form>
        </div>
      </div>

      <div class="col-md-5 my-5">
          <div class="row p-2 p-md-0">
            <div class="bg-body-tertiary p-3 p-md-5">
          <h4 class="py-2 border-bottom">Delivery Address</h4>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
              Default (<small>same as billing address</small>)   
            </label>
          </div>

          <div class="form-check py-2">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
              Add a different Address   
            </label>
          </div>
            </div>
          </div>
          <div class="row px-2 pt-5 px-md-0">
            <div class="bg-body-tertiary p-3 p-md-5">
              <h4 class="py-2 border-bottom">Shipping Method</h4>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                <label class="form-check-label" for="flexRadioDefault3">
                  Ksh 4225 <br><small style="font-size: 8px;">Prepayment of duties and taxes supported</small><br>
                <p class="py-2"> Chania (Road) 5 to 6 business days </p>
                </label>
              </div>
            </div>  
          </div>
      </div>
    </div>

    <div class="row justify-content-around row2" >
      <div class="col-md-5 mt-md-5 bg-body-tertiary p-4 p-md-5 mt-4">
        <h4 class="border-bottom py-2">Payment <small style="font-size: 8px;">SECURED ENCRYPTED TRANSACTION</small></h4>
        <p>Please choose your payment method</p>
      </div>

      <div class="col-md-5 mt-md-5 bg-body-tertiary p-4 p-md-5 mt-4">
        <h4 class="border-bottom py-2">Billing Summary</h4>
        
        <div class="row d-flex">
          <div class="col">Items total</div>
          <div class="col text-end">Ksh 1000</div>
        </div>
        <div class="row d-flex">
          <div class="col">Shipping</div>
          <div class="col text-end">Ksh 300</div>
        </div>
        <div class="row d-flex">
          <div class="col">Duties, taxes $ fees</div>
          <div class="col text-end">Ksh 100</div>
        </div>

        <div class="row d-flex fw-bold py-5">
          <div class="col">Total For Your Order</div>
          <div class="col text-end">Ksh 2000</div>
          <small class="py-2" style="font-size: 8px;">By clicking Pay and  Place Order, you agree to purchase your item(s) from Global-e as merchant of record for this transaction, on Global-e’s Terms of Sale and Privacy Policy. Global-e is an international fulfilment service provider to Destiny Uniforms.</small>

        </div>
      </div>
    </div>

    <button type="submit" name="submit" value="submit" class="btn btn-info m-3 py-3 text-white" style="width: 100%;">PAY AND PLACE YOUR ORDER</button>

  </section>

    
<?php include('footer.php'); ?>
</body>
</html>
  
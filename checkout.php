<?php

    session_start();
    
    include('same.php');

    // for place order button


    if(isset($_POST["place_order"]))
    {
        $f_name=$_POST["fnm"];
        $l_name=$_POST["lnm"];
        $address=$_POST["addr"];
        $apprtment=$_POST["apprtment_name"];
        $city=$_POST["cty"];
        $zip_number=$_POST["zip"];
        $mobile=$_POST["mob"];
        $email=$_POST["email"];
        $total=$_POST["total"];
        $cid=$_POST["cno"];
        $date=date('Y-m-d');
        
        //print_r($date);
        //print_r($cid);
        
        
        $qry="insert into order_master (o_id,date,amount,c_id) values('','$date',$total,$cid);";
        
        $result=mysql_query($qry,$con);
        
         echo "<script>alert('bill !!');
         window.location='print_bill.php'</script>";
         exit();
        
        
      
    }
    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Checkout Process</title>
    
    <?php include("header.php"); ?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>
      <br>

      
<?php
      
      if(!empty($_SESSION["vegetable_cart"]) && !empty($_SESSION["customer_id"]))
      {
          $mob=$_SESSION["customer_id"];
          
          //echo $mob;
          
          $result=mysql_query("SELECT * FROM customer WHERE mob=$mob",$con);
          $row=mysql_fetch_assoc($result);
          
           //print_r(date('Y-m-d'));
          
          //print_r($row);
?>
      <form action="" method="post">
      
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
						<form action="#" class="billing-form">
							<h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="firstname">Firt Name</label>
	                  <input type="text" class="form-control" placeholder="" value="<?php echo $row['c_name']; ?>" name="fnm" readonly>
	                </div>
	              </div>
                    <input type="hidden" name="cno" value="<?php echo $row['c_id']; ?>">
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Last Name</label>
	                  <input type="text" class="form-control" placeholder="" name="lnm" required>
	                </div>
                </div>
                
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="streetaddress">Street Address</label>
	                  <input type="text" class="form-control" placeholder="House number and street name" value="<?php echo $row['addr']; ?>" name="addr" required>
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                  <input type="text" class="form-control" placeholder="Appartment, suite, unit etc: (optional)" name="apprtment_name" required>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">Town / City</label>
	                  <input type="text" class="form-control" placeholder="" value="<?php echo $row['city']; ?>" name="cty" readonly>
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="postcodezip">Postcode / ZIP *</label>
	                  <input type="text" class="form-control" placeholder="" name="zip" required>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input type="text" class="form-control" placeholder="" value="<?php echo $row['mob']; ?>" name="mob" readonly>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress">Email Address</label>
	                  <input type="text" class="form-control" placeholder="" value="<?php echo $row['email']; ?>" name="email" readonly>
	                </div>
                </div>
                
	            </div>
	          </form><!-- END -->
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
		    						<span>Subtotal</span>
                            <?php
                            $total=$_SESSION["total"]['totalofvegetable'];
                            if(!empty($total))
                            {
                            ?>
                            <input type="hidden" name="total" value="<?php echo $total; ?>">
    						<span> Rs.<?php echo $total; ?></span>
                            <?Php
                            }
                            else
                            {
                            ?>
                            <span>Rs.0.00</span>
                            <?php
                            }
                            ?>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
    						<span>Rs.0.00</span>
    					</p>
    					<p class="d-flex">
    						<span>Discount</span>
    						<span>Rs0.00</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<?php
                            if(!empty($total))
                            {
                            ?>
    						<span> Rs.<?php echo $total; ?></span>
                            <?Php
                            }
                            else
                            {
                            ?>
                            <span>Rs.0.00</span>
                            <?php
                            }
                            ?>
    					</p>
    				</div>
	          	</div>
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2" checked readonly> Cash on Delivery</label>
											</div>
										</div>
									</div>

								<!--	<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div> -->
                                    <button type="submit" class="btn btn-primary py-3 px-4" name="place_order">Place an order</button>
								</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
          
    </form>
      
<?php
      }
    else
    {
?>

      <div class="alert alert-warning"><h1 align="center">Login and add to cart then after bill process</h1></div>

      
<?php
    }
?>
 
      <?php
      
        include('footer.php');
      ?>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
    
  </body>
</html>
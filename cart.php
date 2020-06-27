<?php
session_start();

include('same.php');

    // for remove button

    if(isset($_POST["remove_vegetable"]))
    {
        
        foreach ($_SESSION["vegetable_cart"] as $keys => $val)
        {
            //echo $_POST["remove_vegetable"];
            
            if($val["vegetable_id"] == $_POST["remove_vegetable"])
            {
                               
                unset($_SESSION["vegetable_cart"][$keys]);
                echo "<script>alert('vegetable is Remove from cart');
                window.location='cart.php'</script>;";
               
            }
        }
    }
    
    // for update button

    if(isset($_POST["update_vegetable"]))
    {
        $idd=$_POST["update_vegetable"];
        
        $result=mysql_query("SELECT * FROM veg_sell WHERE v_id=$idd",$con);
        $row=mysql_fetch_assoc($result);
        
        $quantity=$row['v_qty'];
        
        
    
        if(isset($_POST['chk250']))
        {
            $price_for_250gm_user=$_POST['chk250'];
        }
        else
        {
            $price_for_250gm_user='0';
        }
        
        if(isset($_POST['chk500']))
        {
            $price_for_500gm_user=$_POST['chk500'];
        }
        else
        {
            $price_for_500gm_user='0';
        }
    
        if(isset($_POST['v_1kg']))
        {
           $user_select_1kg=$_POST['v_1kg'];
        }
        else
        {
           $user_select_1kg='0';    
        }
        
            if($price_for_250gm_user=='0' && $price_for_500gm_user=='0' && $user_select_1kg=='0')
            {

                echo "<script>alert('select quantity in kg or gm');
                window.location='cart.php'</script>;";
            }
            else
            {

            if($user_select_1kg >= $quantity)
            {

                echo "<script>alert('to much quantity not in stock');
                window.location='cart.php'</script>;";
            }
             else
             {
            
                 
                 if(isset($_SESSION["vegetable_cart"]))
                 {
                        
                        foreach($_SESSION["vegetable_cart"] as $keys => $val)
                        {
                            if($_SESSION["vegetable_cart"][$keys]['vegetable_id'] == $_POST["update_vegetable"])
                            {
                                if($price_for_250gm_user == '0')
                                {
                                    $_SESSION["vegetable_cart"][$keys]['for_250gm_price'] = '0';
                                }
                                else
                                {
                                    $_SESSION["vegetable_cart"][$keys]['for_250gm_price']=$price_for_250gm_user;
                                }
                                
                                if($price_for_500gm_user == '0')
                                {
                                   $_SESSION["vegetable_cart"][$keys]['for_500gm_price'] = '0'; 
                                }
                                else
                                {
                                    $_SESSION["vegetable_cart"][$keys]['for_500gm_price']=$price_for_500gm_user;
                                }
                                
                               
                                   $_SESSION["vegetable_cart"][$keys]['from_input_1kg'] = $user_select_1kg;
                                
                                  
                                echo "<script>alert('Update  vegetable cart');
                                window.location='cart.php'</script>;";
                            }
                        }

                 }
        }
        
    }
}

// for all remove vegetable


    if(isset($_POST["remove_allvegetable"]))
    {
        unset($_SESSION["vegetable_cart"]);
        
        echo "<script>alert('All vegetable Remove from cart');
        window.location='cart.php'</script>;";
        
        
        
    }



// check for payment process user login or not

    if(isset($_POST["chkforpayment"]))
    {
        if(empty($_SESSION["customer_id"]))
        {
             echo "<script>alert('First of All login/Registration');
             window.location='login.php'</script>;";
        }
        else
        {
            $tot=$_POST["totalofall"];
            
            $array_for_total =array('totalofvegetable' => $tot);
            
            $_SESSION["total"]=$array_for_total;
            
            echo "<script>alert('Now Time For Payment');
             window.location='checkout.php'</script>;";
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Cart Vegetable</title>
    
    <?php include("header.php"); ?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
                       <h1 align="center">Vegetable Cart Details</h1>
	    				<table class="table">
						    <thead class="thead-primary">
                              
						      <tr class="text-center">
						        <th>Vegetable Image</th>
						        <th>Vegetable name</th>
						        <th>Select quantity </th>
						        <th>price</th>
						        <th>Total</th>
                                <th>Update</th>
                                <th>Remove</th>
						      </tr>
						    </thead>
                            
                            <?php
                            
                            if(!empty($_SESSION["vegetable_cart"]))
                            {
                            
                            $total=0;
                                
                            foreach($_SESSION["vegetable_cart"] as $keys => $val )
                             {
                                    
                                   // print_r($val);
                                
                                
                            ?>
                            <form action="" method="post">
                                
                                <input type="hidden" name="vid" value="<?php echo $val["vegetable_id"]; ?>">
                                
						    <tbody>
						      <tr class="text-center">
						        
						        <td class="image-prod"><div class="img" style="background-image:url(admin/<?php echo $val["vegetable_image"] ; ?>);"></div></td>
						        
						        <td class="product-name">
						        	<h3><?php  echo $val["vegetable_name"]; ?></h3>
						        	
						        </td>
						        
						        <td class="price">
                                    
                                    <!-- check-box and input kg disabled or enable ---------->
                           
                                    <?php
                                    $ap=$val["for_250gm_price_db"];
                                    if($ap == '0')
                                    {
                                        $chk_val250gm='0';
                                    ?>

                                        <div class="form-check col text-center">
                                            <input type="checkbox" name="chk250" class="form-check-input" id="pr250gm" disabled>250 gm
                                        </div>

                                    <?php
                                    }
                                    else
                                    {
                                        $wb=$val["for_250gm_price"];
                                        if($wb > '0')
                                        {
                                            $chk_val250gm=$val["for_250gm_price_db"];
                                        ?>
                                            
                                            <div class="form-check col text-center">

                                                <input type="checkbox" name="chk250" class="form-check-input chk1" id="pr250gm" value="<?php echo $val["for_250gm_price"]; ?>"  onchange="valueChanged1()" checked>250 gm
                                            </div>
                                        <?php
                                        }
                                        else
                                        {
                                            $chk_val250gm='0';
                                        ?>
                                            
                                        <div class="form-check col text-center">

                                                <input type="checkbox" name="chk250" class="form-check-input chk1" id="pr250gm" value="<?php echo $val["for_250gm_price_db"]; ?>"  onchange="valueChanged1()">250 gm
                                            </div>


                                        <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    $jj=$val["for_500gm_price_db"];
                                    if($jj == '0')
                                    {
                                        $chk_val500gm='0';
                                    ?>

                                        <div class="form-check col text-center">
                                            <input type="checkbox" name="chk500" class="form-check-input" id="per500gm" disabled>500 gm
                                        </div>

                                    <?php
                                    }
                                    else
                                    {
                                        $sq=$val["for_500gm_price"];
                                        if($sq > '0')
                                        {
                                            $chk_val500gm=$val["for_500gm_price_db"];
                                        ?>

                                            <div class="form-check col text-center">
                                                <input type="checkbox" name="chk500" class="form-check-input chk" id="per500gm" value="<?php echo $val["for_500gm_price_db"]; ?>" onchange="valueChanged()" checked>500 gm
                                            </div>

                                        <?php
                                        }
                                        else
                                        {
                                          $chk_val500gm='0';  
                                        ?>    

                                        <div class="form-check col text-center">
                                                <input type="checkbox" name="chk500" class="form-check-input chk" id="per500gm" value="<?php echo $val["for_500gm_price_db"]; ?>" onchange="valueChanged()">500 gm
                                            </div>

                                        <?php
                                        }
                                    }
                                    ?>

                                     <?php
                                    $bb=$val["from_db_1kg"];
                                    if($bb == '0')
                                    {
                                    ?>

                                   <div class="qty mt-5" id="q1">
                                    kg. <br> <strong><big>0</big></strong>
                                   </div>
                                     <?php
                                    }
                                    else
                                    {
                                    ?>

                                    <br><div class="col text-center">
                                    <button type="button" id="sub" class="btn w-25 bg-light border rounded-circle sub"><i class="fas fa-minus">-</i></button>
                                         <input type="text" id="1" value="<?php echo $val["from_input_1kg"]; ?>" class="form-control w-25 d-inline field" name="v_1kg">
                                    <button type="button" id="add" class="btn w-25 bg-light border rounded-circle add"><i class="fas fa-plus">+</i></button>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                   <!-- check-box and input kg disabled or enable end here ---------->
                                    
                                  </td>
						        
						        <td class="quantity">
				
                                        
					             <!-- display price or not for gm & kg ---------------->
                            
                        

                                    <?php
                                    $gg=$val["for_250gm_price_db"];
                                    if($gg == '0')
                                    {
                                    ?>


                                    <?php
                                    }
                                    else
                                    {
                                    ?>

                                    <div class="divans1">
                                            <p class="price"><span>Rs.<?php echo $val["for_250gm_price_db"]; ?> per 250gm</span></p>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                     <?php
                                    $iiq=$val["for_500gm_price_db"];
                                    if($iiq == '0')
                                    {
                                    ?>


                                    <?php
                                    }
                                    else
                                    {
                                    ?>

                                    <div id="prfor500gm" class="divans">
                                            <p class="price"><span>Rs.<?php echo $val["for_500gm_price_db"]; ?> per 500gm</span></p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    
                                    <?php
                                    $ff=$val["from_db_1kg"];
                                    if($ff == '0')
                                    {
                                    ?>

                                    <?php
                                    }
                                    else
                                    {
                                    ?>

                                    <div>
                                        <div>
                                            <p class="price"><span id="per1kg">Rs.<?php echo $val["from_db_1kg"]; ?> per kg</span></p>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                            
                                    <!-- display price or not for gm & kg  end here ---------------->
                                    
					          	
					          </td>
						        
						        <td class="total">Rs.<?php echo number_format($chk_val250gm + $chk_val500gm + ($val["from_db_1kg"] * $val["from_input_1kg"]),2); ?></td>
                                  
                             <?php
                                    $total=$total+($chk_val250gm + $chk_val500gm + ($val["from_db_1kg"] * $val["from_input_1kg"]));
                                ?>
                                 
                                <td><button type="submit" name="update_vegetable" class="btn btn-warning" value="<?php echo $val["vegetable_id"]; ?>">Update</button></td>  
                                <td><button type="submit" name="remove_vegetable" class="btn btn-danger" value="<?php echo $val["vegetable_id"]; ?>">Remove</button></td>
                               
						      </tr><!-- END TR-->
                                
						    </tbody>
                                </form>
                            <?php
                               
                            }
                            
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right" colspan="2">Total = Rs.<?php echo number_format($total,2); ?></td>
                                <form action="" method="post">
                                <td colspan="2"><button type="submit" name="remove_allvegetable" class="btn btn-danger" value="<?php echo $val["vegetable_id"]; ?>">Remove All</button></td>
                                </form>
                                <br><hr>
                            </tr>
                                    
						  
                        <?php
                        }
                        else
                        {
                        ?>
                            <div class="alert alert-info" align="center"><h1>Empty Cart!!</h1></div> 
                        <?php
                        }
                        ?>
                            
                        </table>
                        
					  </div>
    			</div>
    		</div>
                
            <div class="row justify-content-end">
    			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
                            <?php
                            if(!empty($total))
                            {
                            ?>
    						<span> Rs.<?php echo number_format($total,2); ?></span>
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
    						<span> Rs.<?php echo number_format($total,2); ?></span>
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
                            <?php
                            if(empty($total))
                            {
                            ?>
    						<p><a href="checkout.php" class="btn btn-primary py-3 px-4" hidden="">Proceed to Checkout</a></p>
                            <?Php
                            }
                            else
                            {
                            ?>
                                <form action="" method="post">
                                     <input type="hidden" name="totalofall" value="<?php echo number_format($total,2); ?>">
                                <p><button type="submit" name="chkforpayment" value="checkout" class="btn btn-primary py-3 px-4">Proceed to Checkout</button></p>    
                                </form>
                                
                            <?php
                                
                            }
                            ?>
    				
    			</div>
    		</div><br>
                
            <div class="container">
                
              <h1 align="center">Track Your Order</h1><br>
                
                
            
            <?php
              
                if(isset($_SESSION["customer_id"]))
                {
                     $mobileno=$_SESSION["customer_id"];
                    
                    //print_r($mobileno);
                    
                    $qre=mysql_query("select c_id from customer where mob=$mobileno",$con);
                    
                    $fetch=mysql_fetch_assoc($qre);
                    
                    $cidd=$fetch["c_id"];
                    
                    //print_r($cidd);
                    
                    
                    $qre2=mysql_query("select delivery_status from order_master where c_id=$cidd",$con);
                    
                    $fetch2=mysql_fetch_assoc($qre2);
                    
                    $status=$fetch2["delivery_status"];
                    
                    $qre3=mysql_query("select o_id from order_master where c_id=$cidd",$con);
                    
                    $fetch3=mysql_fetch_assoc($qre3);
                    
                    $oids=$fetch3["o_id"];
                    
                    //print_r($status);
                    
                    
                ?>
                    
                    <h4 align="left">order id :#<?php echo $oids; ?> &nbsp;&nbsp;(see on botton of printed bill)</h4><br>
                    <h4 align="center" style="color: darkgreen">Progress bar</h4><br>
                <?php
                    
                    if($status == 'confirm')
                    {
                ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active bg-success" style="width: 30%">30%
                        </div>
                        
                    </div>     
                   <br> <div style="margin-left: 20%;"><h4>ORDER CONFORM</h4></div>
                <?php
                    }
                    if($status == 'packing vegetable')
                    {
                ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active bg-success" style="width: 60%">60%
                        </div>
                        
                    </div>     
                   <br> <div style="margin-left: 50%;"><h4>PACK VEGETABLES</h4></div>
                
                 <?php
                    }
                    if($status == 'onway')
                    {
                ?>
                
                <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active bg-success" style="width: 80%">80%
                        </div>
                        
                    </div>     
                   <br> <div style="margin-left: 70%;"><h4>ON WAY</h4></div>
                
                <?php
                    }
                    if($status == 'done')
                    {
                ?>
                
                <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active bg-success" style="width: 100%">100%
                        </div>
                        
                    </div>     
                   <br> <div style="margin-left: 70%;"><h4>REACH AT YOUR HOME</h4></div>
                
                
                <?php
                    }
                
                 
                
                }
                
       
            ?>
        </div>
    		<!--	<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Coupon Code</h3>
    					<p>Enter your coupon code if you have one</p>
  						<form action="#" class="info">
	              <div class="form-group">
	              	<label for="">Coupon code</label>
	                <input type="text" class="form-control text-left px-3" placeholder="">
	              </div>
	            </form>
    				</div>
    				<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
    			</div>  
    			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Estimate shipping and tax</h3>
    					<p>Enter your destination to get a shipping estimate</p>
  						<form action="#" class="info">
	              <div class="form-group">
	              	<label for="">Country</label>
	                <input type="text" class="form-control text-left px-3" placeholder="" value="INDIA" readonly>
	              </div>
	              <div class="form-group">
	              	<label for="country">State/Province</label>
	                <input type="text" class="form-control text-left px-3" placeholder="" value="GUJRAT" readonly>
	              </div>
	              <div class="form-group">
	              	<label for="country">Zip/Postal Code</label>
	                <input type="text" class="form-control text-left px-3" placeholder="" value="******" readonly>
	              </div>
	            </form>
    				</div>
    				<p><button type="submit" name="estimation" class="btn btn-primary py-3 px-4" disabled>Estimate</button></p>
    			</div>  -->
            
			</div>
		</section>

	<?php
      
      include('footer.php');
      
    ?>
      
<!-- for incre,dec values of kg by button --------------->
       
 <script>
        var unit ="<?php echo $val["from_input_1kg"]; ?>";
        var total;
        // if user changes value in field
     
        $('.field').change(function() {
          unit = this.value;
        });
        $('.add').click(function() {
          unit++;
          var $input = $(this).prevUntil('.sub');
          $input.val(unit);
          unit = unit;
        });
        $('.sub').click(function() {
          if (unit > 0) {
            unit--;
            var $input = $(this).nextUntil('.add');
            $input.val(unit);
          }
        });
</script>

  

<!-- for incre,dec values of kg by button end here---------------->
      



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



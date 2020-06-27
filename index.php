<?php
	session_start();
 
    //header("Cache-Control: no-cache");
    //session_cache_limiter("private_no_expire");

    //Set no caching
     /* header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: no-store, no-cache, must-revalidate"); 
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache"); */
    

include('same.php');  



if (isset($_POST['v_id']))
{
        
        
        $idd=$_POST['v_id'];
        $result=mysql_query("SELECT * FROM veg_sell WHERE v_id=$idd",$con);
        $row=mysql_fetch_assoc($result);
        
        $idd=$row['v_id'];
        $v_name=$row['v_name'];
        $v_250gm_db=$row['pr_250gm'];
        $v_500gm_db=$row['pr_500gm'];
        $price_for_1kg_db=$row['pr_1kg'];
        $quantity=$row['v_qty'];
        $v_image=$row['v_img'];
        
        
    
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
    window.location='index.php'</script>;";
}
else
{
   
if($user_select_1kg >= $quantity)
{
   
    echo "<script>alert('to much quantity not in stock');
    window.location='index.php'</script>;";
}
 else
 {
    
    //echo  $price_for_250gm_user."-".$price_for_500gm_user."-".$user_select_1kg;  
    
   if(isset($_SESSION["vegetable_cart"])) 
        {
       
            $is_again=0;
       
            foreach($_SESSION["vegetable_cart"] as $k => $v)
            {
                if($_SESSION["vegetable_cart"][$k]['vegetable_id'] == $_POST['v_id'])
                {
                     
                    echo "<script>alert('vegetable Already Added');
                    window.location='index.php'</script>;";
                    
                    if($_SESSION["vegetable_cart"][$k]['vegetable_id'] == $_POST['v_id']){
                    $is_again++;
                    }
                }
            }
            if($is_again == 0)
            {
            
                $vegetable_store_Array = array(
                                 $idd=>array(
                                 'vegetable_id' => $idd,
                                 'vegetable_name' => $v_name,
                                 'for_250gm_price' => $price_for_250gm_user,
                                 'for_250gm_price_db' => $v_250gm_db,     
                                 'for_500gm_price' => $price_for_500gm_user,
                                 'for_500gm_price_db' => $v_500gm_db,
                                 'from_input_1kg' => $user_select_1kg,
                                 'from_db_1kg' => $price_for_1kg_db,
                                 'vegetable_quantity' => $quantity,
                                 'vegetable_image' => $v_image)
                                );
                 //print_r($vegetable_store_Array);
                
            $_SESSION["vegetable_cart"] = array_merge($_SESSION["vegetable_cart"],$vegetable_store_Array);
                    
                    echo "<script>alert('next vegetable is Added to cart');
                    window.location='index.php'</script>;";
            }
            
            
           // print_r(array_keys($_SESSION["vegetable_cart"]));
        }else
        {
            $vegetable_store_Array = array(
                                 $idd=>array(
                                 'vegetable_id' => $idd,
                                 'vegetable_name' => $v_name,
                                 'for_250gm_price' => $price_for_250gm_user,
                                 'for_250gm_price_db' => $v_250gm_db,     
                                 'for_500gm_price' => $price_for_500gm_user,
                                 'for_500gm_price_db' => $v_500gm_db,
                                 'from_input_1kg' => $user_select_1kg,
                                 'from_db_1kg' => $price_for_1kg_db,
                                 'vegetable_quantity' => $quantity,
                                 'vegetable_image' => $v_image)
                                );
       
                 //print_r($vegetable_store_Array);
                
             $_SESSION["vegetable_cart"] = $vegetable_store_Array; 
            echo "<script>alert('vegetable is Added to cart');
                window.location='index.php'</script>;";
            
            
         }
    }
 }

}

?>
    
 <!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vegetables Shop</title>

<?php

    include('header.php');

?>

  <section id="home-section" class="hero">
      <div class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(images/bg_1.jpg);">
          <div class="overlay"></div>
          <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

              <div class="col-md-12 ftco-animate text-center">
                <h1 class="mb-2">We serve Fresh Vegestables &amp; Fruits</h1>
                <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                <p><a href="about.php" class="btn btn-primary">View Details</a></p>
              </div>

            </div>
          </div>
        </div>

        <div class="slider-item" style="background-image: url(images/bg_2.jpg);">
          <div class="overlay"></div>
          <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

              <div class="col-sm-12 ftco-animate text-center">
                <h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
                <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                <p><a href="about.php" class="btn btn-primary">View Details</a></p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
      
<br><br><br><br>


  <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Our Products</h2>
          </div>   		
    	</div>



 <section class="ftco-section">       
          
    
     <div class="container">
            
		<div class="row"> 
      
            
    	
   
                
      <!-- php code here---------------->
           
       <?php
       
        include('same.php');
       
        $q="select * from veg_sell where available='y' and v_qty > 0 order by v_id  ";
        
        $r=mysql_query($q,$con);
		
		
		
       
        while($k=mysql_fetch_array($r))
        {
            
       ?>
    
             

    			<div class="col-md-3 col-sm-6">
    				<div class="product">
                        <!-- form start here--------->
                        
                        <form method="post" action=""> 
                        
                        <input type="hidden" name="v_id" value="<?php echo $k[0]; ?>">
                            
                        <input type="hidden" name="v_img" value="<?php echo $k[6]; ?>">
    					<a href="#" class="img-prod"><img class="img-fluid" src="admin/<?php echo $k[6]; ?>" alt="emp..." style="width: 400px;height: 260px;" >
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
                            <input type="hidden" name="v_name" value="<?php echo $k[1]; ?>">
    						<h3><a href="#"><?php echo $k[1]; ?></a></h3>
                            
                            
                            <!-- display price or not for gm & kg ---------------->
                            
                            <?php
                            $ff=$k[4];
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
		    						<p class="price"><span id="per1kg">Rs.<?php echo $k[4]; ?> per kg</span></p>
		    					</div>
	    					</div>
                            <?php
                            }
                            ?>
                            
                            <?php
                            $gg=$k[2];
                            if($gg == '0')
                            {
                            ?>
                            
    
                            <?php
                            }
                            else
                            {
                            ?>
                           
                            <div class="divans1" style="display: none">
		    						<p class="price"><span>Rs.<?php echo $k[2]; ?> per 250gm</span></p>
		    					</div>
                            <?php
                            }
                            ?>
                           
                            
                             <?php
                            $ii=$k[3];
                            if($ii == '0')
                            {
                            ?>
                            
    
                            <?php
                            }
                            else
                            {
                            ?>
                           
                            <div id="prfor500gm" class="divans" style="display: none">
		    						<p class="price"><span>Rs.<?php echo $k[3]; ?> per 500gm</span></p>
		    					</div>
                            <?php
                            }
                            ?>
                            
                            <!-- display price or not for gm & kg  end here ---------------->
                            
                            <!-- check-box and input kg disabled or enable ---------->
                           
                            <?php
                            $ap=$k[2];
                            if($ap == '0')
                            {
                            ?>
                            
                                <div class="form-check col text-center">
                                    <input type="checkbox" name="chk250" class="form-check-input" id="pr250gm" disabled>250 gm
                                </div>
                               
                            <?php
                            }
                            else
                            {
                            ?>
                                 
                                <div class="form-check col text-center">
                                    
                                    <input type="checkbox" name="chk250" class="form-check-input chk1" id="pr250gm" value="<?php echo $k[2]; ?>"  onchange="valueChanged1()">250 gm
                                </div>
                           
                            
                                
                            <?php
                            }
                            ?>
                            
                            <?php
                            $jj=$k[3];
                            if($jj == '0')
                            {
                            ?>
                               
                                <div class="form-check col text-center">
                                    <input type="checkbox" name="chk500" class="form-check-input" id="per500gm" disabled>500 gm
                                </div>
                            
                            <?php
                            }
                            else
                            {
                            ?>
                                 
                                <div class="form-check col text-center">
                                    <input type="checkbox" name="chk500" class="form-check-input chk" id="per500gm" value="<?php echo $k[3]; ?>" onchange="valueChanged()">500 gm
                                </div>
                           
                            <?php
                            }
                            ?>
                            
                             <?php
                            $bb=$k[4];
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
                            <strong>kg.</strong> 
                            <br><div class="col text-center">
                            <button type="button" id="sub" class="btn bg-light border rounded-circle sub"><i class="fas fa-minus">-</i></button>
                                 <input type="text" id="1" value="0" class="form-control w-25 d-inline field" name="v_1kg">
                            <button type="button" id="add" class="btn bg-light border rounded-circle add"><i class="fas fa-plus">+</i></button>
                            </div>
                            <?php
                            }
                            ?>
                            
                           <!-- check-box and input kg disabled or enable end here ---------->
                       
                            
                             <div class="col text-center">
                            <p><br><button type="submit" name="addtobag" class="btn btn-outline-primary py-1 px-5">ADD TO BAG</button></p>
                                       
                            </div>
                                                        
                            <!-- /input-group -->

                            </div>
                            
                    </form>
                    <!-- form end here--------->       
    					
    				</div>
                        
			</div>
          
                     <?php
		
        } ?> 
           
        </div>
            
                
    </div>
    
    
 </div>
     

</section>


	
      
       
<!-- for incre,dec values of kg by button --------------->
       
 <script>
        var unit = 0;
        var total;
        var u ="<?php echo $k[0]; ?>";
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
       
       
<!-- for checkbox 250gm and 500gm  ----------->
       
<script type="text/javascript">
function valueChanged()
{
    if($('.chk').is(":checked"))   
        $(".divans").show();
    else
        $(".divans").hide();
}
</script>

<script type="text/javascript">
function valueChanged1()
{
    if($('.chk1').is(":checked"))   
        $(".divans1").show();
    else
        $(".divans1").hide();
}
</script>
       
<!-- for checkbox 250gm and 500gm  end here----------->
       


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
    
  </body>
</html>

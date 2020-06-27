<?php
session_start();
include('same.php');
if(strlen($_SESSION['admin_nm'])==0)
	{	
header('location:index.php');
}
else{

?>

<!doctype html>
<html>
<head>
    <!-- Meta tegs--------------->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    
     <!-- Meta tegs end--------------->
    
    <!-- script start--------------------->
    
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    
    <!-- script end--------------------->
    
    <!-- css styling-------------------->
    
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/morris.css" type="text/css"/>
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <script src="js/jquery-2.1.4.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    
    <!-- css styling end here-------------------->
    
    
    

<title>Edit vegetable price</title>
</head>

<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="panel.php">Home</a><i class="fa fa-angle-right"></i>price of vegetable</li>
            </ol>
		<!--grid-->
    
      <!-- php code here for fetch data from table------------------>
    
    <?php
     
     include('same.php');
     
     if(isset($_GET["w"]))
     {
         $idd=$_GET["w"];
         
         $qr="select v_id,v_name,pr_250gm,pr_500gm,pr_1kg from veg_sell where v_id=$idd";
         
         $result=mysql_query($qr,$con);
         
         $rr=mysql_fetch_array($result);
     }
     
     
    ?>
    
    <!-- php code end here ------------------>
    
       <!-- add form for editing vegetable price--------->
    
    <div class="container">
    
    <form action="" method="post" name="f1">
        
       
        
        <div class="form-group">
            <label>Vegetable id</label>
            
            <input type="text" name="v_id" value="<?php echo $rr[0]; ?>" class="form-control" readonly><br>
            
            
        	<label >Add vegetable</label><br>              							
            
            <input type="text" class="form-control" name="v_nm" value="<?php echo $rr[1]; ?>" readonly><br>
            
            
            <label >price for 250gm</label><br>              							
            
            <input type="text" class="form-control" name="v_250gm" value="<?php echo $rr[2]; ?>"><br>
            
            
            <label >price for 500gm</label><br>              							
            
            <input type="text" class="form-control" name="v_500gm" value="<?php echo $rr[3]; ?>"><br>
            
            
            <label >price for 1kg</label><br>              							
            
            <input type="text" class="form-control" name="v_1kg" value="<?php echo $rr[4]; ?>"><br>
            
            
            <input type="submit" name="edit" value="Change" class="btn btn-default">
      			    
        </div>
   
    </form>
    
    <!-- add form for editing vegetable price end here--------->
  </div>  
    
</body>
</html>
<br><br>
    

 <!-- php code here----------------->
    

    <?php
     
     if(isset($_POST["edit"]))
     {
         $vid=$_POST["v_id"];
         $vnm=$_POST["v_nm"];
         $v250gm=$_POST["v_250gm"];
         $v500gm=$_POST["v_500gm"];
         $v1kg=$_POST["v_1kg"];
         
         $a="update veg_sell
             set pr_250gm=$v250gm,pr_500gm=$v500gm,pr_1kg=$v1kg
             where v_id=$vid";
         $b=mysql_query($a,$con);
         if($a)
         {
            header('Location:manage-price-of-vegetable.php');
         }
         else
         {
             echo "not change";
         }
     }
     
     
    ?>
    
<!-- php code here----------------->

<!-- script-for sticky-nav -->
 
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	  

<?php } ?>



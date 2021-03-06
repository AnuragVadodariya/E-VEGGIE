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
    
    
    

<title>Add vegetable</title>
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
                <li class="breadcrumb-item"><a href="panel.php">Home</a><i class="fa fa-angle-right"></i>Add Vegetable</li>
            </ol>
		<!--grid-->
    <div class="container"> 
    <form action="" method="post" name="f1" enctype="multipart/form-data">
       
        <div class="form-group">
        	<label >Add vegetable</label><br>              							
            
            <input type="text" class="form-control" name="v_nm" placeholder="name of vegeble" required><br>
        </div>
        
        <div class="form-group">
        	<label >Quantity of vegetable</label><br>              							
            
            <input type="text" class="form-control" name="v_qty" placeholder="qty in kg" required><br>
            
      			    
        </div>
        
        <div class="form-group">
        	<label >Image of vegetable</label><br>              							
            
            <input type="file" name="v_image" required><br>
            
      			    
        </div>
        
        <div class="form-group">
        
            <label>Vegetable Available : <span>For Available vegetable Enter Y otherwise N </span></label>
            
            <input type="text" name="chk" class="form-control"> 
        </div>
            <input type="submit" name="add" value="Add" class="btn btn-default">
      			    
        
   
    </form>
    </div>
</body>
</html><br><br>

<!-- php code here---------------->
    
<?php

include('same.php');

if(isset($_POST['add']))
{
    $vnm=$_POST["v_nm"];
    $qt=$_POST["v_qty"];
    $av=$_POST["chk"];
    
    $r1=rand(1111,9999);
    $r2=rand(1111,9999);
    
    $v=$r1.$r2;
    
    $dec=md5($v);
    
    $fnm=$_FILES["v_image"]["name"];
    $dst="./vegetable_image/".$v.$fnm;
    $dst2="vegetable_image/".$v.$fnm;
    
    $qw="select v_name from veg_sell where v_name='$vnm'";
    
    $qa=mysql_query($qw,$con);
    
    
    if(mysql_num_rows($qa) > 0)
    {
      echo "vegetable is allready added";   
    }
    else
    {
    
    move_uploaded_file($_FILES["v_image"]["tmp_name"],$dst);
    
    $qry="insert into veg_sell (v_id,v_name,v_qty,v_img,available) values('','$vnm',$qt,'$dst2','$av');";
    
    $res=mysql_query($qry,$con);
    
    if($res)
    {
        echo "vegetable add successful";
        
    }
    else
    {
        echo "vegetable not add";
    }
 }
    
}
     
    
?>
    
<!-- php code  end here---------------->    

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



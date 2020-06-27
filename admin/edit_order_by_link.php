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
    
    
    

<title>Manage order</title>
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
                <li class="breadcrumb-item"><a href="panel.php">Home</a><i class="fa fa-angle-right"></i>Manage order</li>
            </ol>
		<!--grid-->
    
 
        <?php
            $qry="select o_id,date,amount,c_id,delivery_status from order_master";
            $v=mysql_query($qry,$con);
            while($r=mysql_fetch_array($v))
            {
        ?>
    
 <!-- php code end here ------------------>
    
   <!-- add form for editing order--------->
    
    <div class="container">
    
    <form action="" method="post" name="f1">
        
       
        
        <div class="form-group">
            <label>order id</label>
            
            <input type="text" name="o_id" value="<?php echo $r[0]; ?>" class="form-control" readonly><br>
            
            
        	<label >Edit order status</label><br>              							
            
            <input type="text" class="form-control" name="status" value="<?php echo $r[4]; ?>"><br>
            
            <p> order status= [1]' confirm is default ' [2]' packing vegetable ' [3]' onway ' [4]' done ' </p>
            
            
            <input type="submit" name="edit" value="Change" class="btn btn-default">
      			    
        </div>
   
    </form>
    
    <!-- add form for editing order end here--------->
  </div>  
            
        
    <?php  } ?>
    
    

<!-- table ends here-------------->    
    
</body>
</html>
    
    
<!-- php code here---------------->
    
<!-- qty to update colunm order_status


ALTER TABLE order_master ADD CONSTRAINT chk_status CHECK (
delivery_status IN (
'conform',
'packing',
'onway',
'done'
)
);


-->
    
<?php

include('same.php');

if(isset($_POST['edit']))
{
    $oid=$_POST["o_id"];
    $status=$_POST["status"];
    
    $qry="update order_master
          set delivery_status='$status'
          where o_id=$oid";
    
    $res=mysql_query($qry,$con);
    
    //print_r($oid);
    //print_r($status);
    
    
    header('Location:manage_order.php');
   
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



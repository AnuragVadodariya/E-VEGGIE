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
                <li class="breadcrumb-item"><a href="panel.php">Home</a><i class="fa fa-angle-right"></i>Done order</li>
            </ol>
		<!--grid-->
    
 
        <?php
            
     
            $qry2="select o_id from order_master where delivery_status='done'";
     
            $v2=mysql_query($qry2,$con);
     
     
           // print_r($v2);
     
            
            while($rq=mysql_fetch_array($v2))
            {
                $ro=$rq[0];
                
        ?>
    
 <!-- php code end here ------------------>

    <div class="container">
    
        <!-- table start here-------------->
    
<table class="table table-responsive">
    
    <tr>
        <th>o_id</th>
        <th>v_id</th>
        <th>v_name</th>
        <th>delete</th>
    
    </tr>
    <tr>
        <?php
            $qry="select o_id,v_id,v_name from order_details where o_id=$ro";
            $v=mysql_query($qry,$con);
            while($r=mysql_fetch_array($v))
            {
                
            
        ?>
        <td><?php echo $r[0]; ?></td>
        <td><?php echo $r[1]; ?></td>
        <td><?php echo $r[2]; ?></td>
        <td><a href="delete_order_by_link.php?q=<?php echo $r[0]; ?>">delete</td>
        
        
    </tr>
    <?php  } ?>
</table>
    

<!-- table ends here-------------->   
        
  </div>  
            
        
    <?php }  ?>
    
    

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



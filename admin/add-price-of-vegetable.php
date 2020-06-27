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
    
    
    

<title>Add vegetable price</title>
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
    
    <!-- php code here ----------------->
    
    
    <?php 
    
     include('same.php');
     
     $a="select v_id,v_name from veg_sell";
     
     $b=mysql_query($a,$con);
     
    
     
    ?>
    
    
    <!-- php code  end here ----------------->
    

    
    
     <div class="container">
    <form action="" method="post" name="f1">
       
        <div class="form-group">
            
                        <label>Select Vegetable</label>
                               <select class="form-control" name="veg_name" id="category" size="1" required>
                                     <option value="" selected disabled>Select </option>
                                   
                                    <?php             while($d=mysql_fetch_array($b))
													 {
								   ?>
									        <option><?php echo $d[1]; ?></option>				
                                   
								    <?php
													}
								    ?>
                                         
                                    
                                     
                                         
                                </select><br>                  
        </div>
        
        <table class="table">
            <tr>
                <th>weight</th>
                <th>price</th>
            </tr>
            <tr>
               <td> <input type="checkbox" name="c1" id="chkPassport" onclick="EnableDisableTextBox(this)">250 gm  </td>
               <td><input type="text" name="in1" id="txtPassportNumber" disabled="disabled"></td>
            </tr>
            <tr>
               <td> <input type="checkbox" name="c2" id="chkPassport2" onclick="EnableDisableTextBox2(this)">500 gm  </td>
               <td><input type="text" name="in2" id="txtPassportNumber2" disabled="disabled"></td>
            </tr>
            <tr>
               <td> <input type="checkbox" name="c3" id="chkPassport3" onclick="EnableDisableTextBox3(this)">1 kg  </td>
               <td><input type="text" name="in3" id="txtPassportNumber3" disabled="disabled"></td>
            </tr>
        
        </table>
            
       
            <input type="submit" name="prc" value="Add" class="btn btn-default">
        
  <!-- when check textbox will be enable -------------->
        
     <script type="text/javascript">
    function EnableDisableTextBox(chkPassport) {
        var txtPassportNumber = document.getElementById("txtPassportNumber");
        txtPassportNumber.disabled = chkPassport.checked ? false : true;
        if (!txtPassportNumber.disabled) {
            txtPassportNumber.focus();
        }
    }
</script>   
        

     <script type="text/javascript">
    function EnableDisableTextBox2(chkPassport2) {
        var txtPassportNumber2 = document.getElementById("txtPassportNumber2");
        txtPassportNumber2.disabled = chkPassport2.checked ? false : true;
        if (!txtPassportNumber2.disabled) {
            txtPassportNumber2.focus();
        }
    }
</script>   
        
        
         <script type="text/javascript">
    function EnableDisableTextBox3(chkPassport3) {
        var txtPassportNumber3 = document.getElementById("txtPassportNumber3");
        txtPassportNumber3.disabled = chkPassport3.checked ? false : true;
        if (!txtPassportNumber3.disabled) {
            txtPassportNumber3.focus();
        }
    }
</script>       
        
        
  <!-- when check textbox will be enable end -------------->
   
    </form> 
    </div>
</body>
</html>
<br>
    
<!-- php code here---------------->
    
<?php
     
     
     include('same.php');
     
     if(isset($_POST["prc"]))
     {
         $dr_val=$_POST["veg_name"];
        
         
         if(empty($_POST["in1"]))
         {
             $p1=0;
         }
         else
         {
             $p1=$_POST["in1"];
         }
         
         if(empty($_POST["in2"]))
         {
             $p2=0;
         }
         else
         {
             $p2=$_POST["in2"];
         }
         
         if(empty($_POST["in3"]))
         {
             $p3=0;
         }
         else
         {
             $p3=$_POST["in3"];
         }
         
         
         $q1="update veg_sell
              set pr_250gm=$p1,pr_500gm=$p2,pr_1kg=$p3
              where v_name='$dr_val'";
         
         //$q1="insert into veg_sell (pro1_250gm,pro2_500gm,pro3_1kg) values($p1,$p2,$p3) select v_name from veg_sell where v_name='$dr_val'";
         
         $res_of_qry=mysql_query($q1,$con);
         
         if($res_of_qry)
         {
             echo "price add successfull";
         }
         else
         {
             echo "price not added";
         }
     }
     
?>
    
    
<br><br>
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



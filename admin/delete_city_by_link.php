<?php
session_start();
include('same.php');
if(strlen($_SESSION['admin_nm'])==0)
	{	
header('location:index.php');
}
else{

?>




<!-- php code here---------------->
    
<?php



    $cid=$_GET["t"];
    
    
    $qry="delete from city where city_id=$cid";
    
    $res=mysql_query($qry,$con);
    
    
    header('Location:manage-city.php');
   

     
    
?>
    
<!-- php code  end here---------------->    


<?php } ?>



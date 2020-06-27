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



    $aid=$_GET["k"];
    
    
    $qry="delete from city_area where area_id=$aid";
    
    $res=mysql_query($qry,$con);
    
    
    header('Location:manage-city-area.php');
   

     
    
?>
    
<!-- php code  end here---------------->    


<?php } ?>



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



    $vid=$_GET["q"];
    
    
    $qry="delete from veg_sell where v_id=$vid";
    
    $res=mysql_query($qry,$con);
    
    
    header('Location:manage-vegitable.php');
   

     
    
?>
    
<!-- php code  end here---------------->    


<?php } ?>



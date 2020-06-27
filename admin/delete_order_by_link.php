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



    $oid=$_GET["q"];
    
    
    $qry="delete from order_details where o_id=$oid";
    
    $res=mysql_query($qry,$con);
    
    if($res)
    {
        $qry2="delete from order_master where delivery_status='done'";
     
            $v2=mysql_query($qry2,$con);
     
     
           // print_r($v2);
     
            
            if($v2)
            {
             
                 header('Location:delete_order.php');
            }
    }
    else
    {
        header('Location:delete_order.php');
    }
    
   
     
    
?>
    
<!-- php code  end here---------------->    


<?php } ?>



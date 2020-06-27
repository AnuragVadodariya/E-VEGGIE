<?php

include('same.php');
     
     
         $idd=$_GET["w"];
         
        // $qr="select v_id,v_name,pr_250gm,pr_500gm,pr_1kg from veg_sell where v_id=$idd";
         
        // $result=mysql_query($qr,$con);
         
        // $rr=mysql_fetch_array($result);
         
         $a="update veg_sell
             set pr_250gm=0,pr_500gm=0,pr_1kg=0
             where v_id=$idd";
         
         $c=mysql_query($a,$con);
         
         if($c)
         {
             header('Location:manage-price-of-vegetable.php');
             
         }
         else
         {
             echo "not change";
         }
         
     
    

?>
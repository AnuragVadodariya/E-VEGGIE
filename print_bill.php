<?php

session_start();

include('same.php');

ini_set('SMTP',"server.com");
ini_set('smtp_port',"25");
ini_set('sendmail_form',"anuragvadodariya32@gmail.com");


//header('Content-Type: application/pdf');

    //check for 250gm
        
            $mob=$_SESSION["customer_id"];


            // for print

            $print=mysql_query("select * from customer where mob=$mob");

            $print_result=mysql_fetch_assoc($print);

            $user_email=$print_result["email"];

            $user_addr=$print_result["addr"];

            $user_name=$print_result["c_name"];

            $user_city=$print_result["city"];

            $user_area=$print_result["addr_area"];
        
            //print_r($mob);
        
            $qr="SELECT c_id
                FROM customer
                WHERE mob=$mob";

            $res=mysql_query($qr,$con);

            $row=mysql_fetch_assoc($res);
        
           // print_r($row);


            $qr3="SELECT email
                FROM customer
                WHERE mob=$mob";

            $res3=mysql_query($qr3,$con);

            $row3=mysql_fetch_assoc($res3);

            $em=$row3["email"];
        
           // print_r($row3);


            $id=$row["c_id"];
            
            $qrt="select o_id from order_master where c_id=$id";

            $ree=mysql_query($qrt,$con);
            
           $row2=mysql_fetch_assoc($ree);

            $order_id=$row2["o_id"];
            
            // print_r($order_id);



    foreach($_SESSION["vegetable_cart"] as $keys => $val)
    {
            
            
          // print_r($_SESSION["vegetable_cart"]);
            
            $vidd=$_SESSION["vegetable_cart"][$keys]['vegetable_id'];
            
            $vname=$_SESSION["vegetable_cart"][$keys]['vegetable_name'];
            
                if($_SESSION["vegetable_cart"][$keys]['for_250gm_price'] == '0')
                {
                    $qty250gm=0;
                }
                else
                {
                    $qty250gm=1;
                }

                //check for 500gm

                if($_SESSION["vegetable_cart"][$keys]['for_500gm_price'] == '0')
                {
                    $qty500gm=0;
                }
                else
                {
                    $qty500gm=1;
                }

                $qty1kg= $_SESSION["vegetable_cart"][$keys]['from_input_1kg'];

              /*  print_r($order_id);
                print_r($vidd);
                print_r($vname);
                print_r($qty250gm);
                print_r($qty500gm);
                print_r($qty1kg);
                echo '<br>'; */

                $qry2="insert into order_details (o_id,v_id,v_name,250gm,500gm,1kg) values($order_id,$vidd,'$vname',$qty250gm,$qty500gm,$qty1kg);";

                $resq=mysql_query($qry2,$con);

                
            
        } 


        // for qty minus 


        foreach($_SESSION["vegetable_cart"] as $keys => $val)
        {
            $idv=$_SESSION["vegetable_cart"][$keys]['vegetable_id'];
            
            $q=mysql_query("select v_qty from veg_sell where v_id=$idv",$con);
            
            $r=mysql_fetch_assoc($q);
            
            $qv=$r['v_qty'];
            
            //print_r($qv);
            
            //qty minus for 250gm
            
            if($_SESSION["vegetable_cart"][$keys]['for_250gm_price_db'] == '0')
            {
                
            }
            else
            {
                $qty250user=$_SESSION["vegetable_cart"][$keys]['for_250gm_price'];
                
               // print_r($qty250user);
                
                if($qty250user == '0')
                {
                    
                }
                else
                {
                    
                    $qty250user='0.25';
                    
                    $qv-=$qty250user;
                    
                    $up="update veg_sell
                         set v_qty=$qv
                         where v_id=$idv";
                    $e=mysql_query($up,$con);
                    
                }
            }
            
            //qty minus for 500gm
            
            if($_SESSION["vegetable_cart"][$keys]['for_500gm_price_db'] == '0')
            {
                
            }
            else
            {
                $qty500user=$_SESSION["vegetable_cart"][$keys]['for_500gm_price'];
                
                if($qty500user == '0')
                {
                    
                }
                else
                {
                    $qty500user='0.50';
                    
                   $qv-=$qty500user;
                    
                    $up1="update veg_sell
                         set v_qty=$qv
                         where v_id=$idv";
                    
                    $e1=mysql_query($up1,$con);
                    
                }
            }
            
            //qty minus for 1kg
            
            
            if($_SESSION["vegetable_cart"][$keys]['from_db_1kg'] == '0')
            {
                
            }
            else
            {
               
                $qty1kguser=$_SESSION["vegetable_cart"][$keys]['from_input_1kg'];
                
                //print_r($qty1kguser);
                
                if($qty1kguser == '0')
                {
                    
                }
                else
                {                    
                    
                  $qv-=$qty1kguser;
                    
                  $up2="update veg_sell
                       set v_qty=$qv
                       where v_id=$idv";
                    
                  $e2=mysql_query($up2,$con);
                    
                   // print_r($qv);
                    
                }
            }
        }
        
        
            /*    if($resq)
                {
                    $to=$em;
                    //print_r($to);
                    $sub="vegetable selling Bill";
                    $message="conform your order";
                    $header="Form:anuragvadodariya32@gmail.com";
                    
                    $mail_user=mail($to,$sub,$message,$header);
                    
                    if($mail_user)
                    {
                        echo "<script>alert('conform order with Send bill to way mail')</script>";
                    }
                    else
                    {
                        echo "<script>alert('check internet connection email not send')</script>";
                    } 
                }
                else
                {
                   echo "<script>alert('Something is Wrong')</script>";
                } */

        
    

?>

<!doctype html>
<html>
<head>
<meta http-equiv="refresh" content="5;url=auto_session_des.php" charset="utf-8"/>
<title>Print Bill :)</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body onload="window.print()">
    <h1 align="center">Your Bill by Bak@la Sales store</h1>
    <br><br><hr>
    <h2 align="left">orderid:#<?php echo $order_id; ?></h2><br>
    
    
    <h3 align="left">Form:</h3> <h3 style="text-align: right;margin-right: 10%;">To:</h3> 
    
    <p>Bak@la Sales</p><br> <p style="float: right;margin-right: 10%;">name:<strong><?php echo $user_name; ?></strong></p>
    
    <p>Contect:<strong>9898989898</strong></p> <p style="text-align: right;margin-right: 10%;">Addr:<strong><?php echo $user_addr; ?></strong></p>
    
    <p>email:<strong>anu@gmail.com</strong></p>  <p style="text-align: right;margin-right: 10%;">mobile no:<strong><?php echo $mob; ?></strong></p>
    
    
    <p style="text-align: right;margin-right: 10%;">Email:<strong><?php echo $user_email; ?></strong></p><br>
    
    <p style="text-align: right;margin-right: 10%;">City:<strong><?php echo $user_city; ?></strong></p>
    
    <p style="text-align: right;margin-right: 10%;">area:<strong><?php echo $user_area; ?></strong></p><br>
    
    
    <div class="table-responsive" id="order_table">
        
	<table class="table table-bordered table-striped">
        
        <tr>
            <th>vegetable name</th>
            <th>250gm qty</th>
            <th>500gm qty</th>
            <th>in kg qty</th>
        </tr>

        <?php
        
        foreach($_SESSION["vegetable_cart"] as $keys => $val)
         {
            $vnm=$_SESSION["vegetable_cart"][$keys]['vegetable_name'];
            $v250gm=$_SESSION["vegetable_cart"][$keys]['for_250gm_price'];
            $v500gm=$_SESSION["vegetable_cart"][$keys]['for_500gm_price'];
            $vkg=$_SESSION["vegetable_cart"][$keys]['from_input_1kg'];
        ?>
        
        <tr>
            <td><?php echo $vnm; ?></td>
            
            <?php  if($v250gm == '0'){ ?>
            <td>no</td>
            <?php }else{ ?>
            <td>yes</td>
            <?php } ?>
            
            <?php  if($v500gm == '0'){ ?>
            <td>no</td>
            <?php }else{ ?>
            <td>yes</td>
            <?php } ?>
            
            <td><?php echo $vkg; ?></td>
            
        </tr>
        
        <?php
        }
        $tot=$_SESSION["total"]['totalofvegetable'];
        ?>
        <tr>  
        <td colspan="3" align="right">Total</td>  
        <td align="right"><?php echo $tot; ?></td>  
          
    </tr>
    </table>
    </div>
  
</body>
</html>

<?php

unset($_SESSION["vegetable_cart"]);
unset($_SESSION["total"]);

?>

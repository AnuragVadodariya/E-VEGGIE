<?php

session_start();

include('same.php');




if(isset($_SESSION["manage_login"]))
{
    $id=$_SESSION['customer_id'];
    

    $qry="select * from customer where mob=$id";

    $res=mysql_query($qry,$con);

    $row=mysql_fetch_assoc($res);
    
    //for customer id get
    
    
    $qry2="select c_id from customer where mob=$id";
    

    $res2=mysql_query($qry2,$con);

    $row2=mysql_fetch_assoc($res2);
    
    $r=$row2["c_id"];
    
    //print_r($r);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>manage Details</title>
    
   <?php include('header.php');  ?>

      
      <div class="container">
            <div class="w-50 m-auto py-5">
                 <form action="" name="f1" method="post">
                    <h1 class="text-center">Your Details </h1>
                     
                        <div class="form-group">

                                    <label class="elements">Customer Name :</label> <input type="text" name="cnm" class="form-control" placeholder="Enter Username " required autocomplete="off" value="<?php echo $row["c_name"]; ?>"><br>
                         </div>
                     
                         <div class="form-group">

                                    <label class="elements">Address :</label> <textarea class="form-control" placeholder="address Here" autocomplete="off" name="addr" value="<?php echo $row["addr"]; ?>" required><?php echo $row["addr"]; ?></textarea><br>
                         </div>
                         
                        
                        <div class="form-group">

                                    <label class="elements">Mobile no :</label> <input type="text" name="mob" class="form-control" placeholder="Enter Mobile number" readonly required autocomplete="off" value="<?php echo $row["mob"]; ?>" ><br>
                         </div>
                     
                         
                         <div class="form-group">

                                    <label class="elements">Email id :</label> <input type="email" name="eid" class="form-control" placeholder="Entet email" required autocomplete="off" value="<?php echo $row["email"]; ?>" ><br>
                         </div>
                     
                         
                         <div class="form-group">   
                                    <label>City</label>
                                     <select class="form-control" name="cty"  size="1" onchange="myfun(this.value)" required>
                                         <option value="" selected disabled><?php echo $row["city"]; ?></option>
                                         <?php
                                         
                                         $q="select * from city";
                                         $ress=mysql_query($q,$con);
                                         while($rq=mysql_fetch_array($ress))
                                         {
                                        ?>
                                         <option value="<?php echo $rq['city_id']; ?>"><?php echo $rq['city_name']; ?> </option>
                                        <?php
                                         }
                                         ?>
                                        
                                     </select><br>
                         </div>
                     
                         <div class="form-group">   
                                    <label>City Area</label>
                                     <select class="form-control" id="dataget" size="1" name="area" required>
                                         <option value="" selected disabled><?php echo $row["addr_area"]; ?></option>
                                         
                                       
                                     </select><br>
                         </div>
                     
                         <div class="form-group">
                                    <label>password : </label>  <input type="password" name="pass1" class="form-control" placeholder="Password" required autocomplete="off"><br><br>
                        </div>
                             
                             <div class="form-group">
                                    <label>Conform password : </label>  <input type="password" name="pass2" class="form-control" placeholder=" conform Password" required autocomplete="off"><br><br>
                             </div>
                         
                                 
                            <div class="text-center">
                                
                             <input type="submit" name="sub" value="Done" class="btn btn-success py-8 w-100"> 
                                <br><br><br>
                            

                            </div>

                       
                </form>
            </div>
        </div>
      
    </body>
    
</html>


<!-- Ajax code here ---------------->

<script type="text/javascript">
    
    function myfun(datavalue){
    
        $.ajax({
           
            url:'ajax_data_get.php',
            type:'POST',
            data:{datapost:datavalue},
            
            success:function(result){
                $('#dataget').html(result);
            }
            
        });
        
    }
</script>

<!-- Ajax code here ---------------->


<!-- php code here -------------------->

<?php
    
    
    if(isset($_POST["sub"]))
    {
       include('same.php');
        
        // to get all values
        
        $nm=$_POST["cnm"];
        $addr=$_POST["addr"];
        $mob=$_POST["mob"];
        $eid=$_POST["eid"];
        $city_id=$_POST["cty"];
        $area=$_POST["area"];
        $p1=$_POST["pass1"];
        $p2=$_POST["pass2"];
        
       // print_r($p1);
        
      //print_r($p2);
        
        $a=mysql_query("select city_name from city where city_id=$city_id",$con);
        
        $b=mysql_fetch_array($a);
        
        $city_name=$b[0];
        
        //print_r($city_name);
        
        // print_r($area);
        
         $q="select * from customer where mob=$mob";
         $res=mysql_query($q,$con);
         $chk=mysql_num_rows($res);
         $row=mysql_fetch_assoc($res);
        
        if(!preg_match("/^[a-zA-Z]*$/",$nm))
        {
            echo "<script>alert('Enter validute username');
            window.location='manage_profile.php'</script>";
            exit();
        }
        elseif(!preg_match("/^[0-9]{10}$/",$mob))
        {
            echo "<script>alert('Enter 10 digit mobile number');
            window.location='manage_profile.php'</script>";
            exit();
        }
        elseif(!filter_var($eid, FILTER_VALIDATE_EMAIL))
        {
            echo "<script>alert('Enter validute email');
            window.location='manage_profile.php'</script>";
            exit();
        }
        elseif($p1 !== $p2)
        {
            echo "<script>alert('password not match');
            window.location='manage_profile.php'</script>";
            exit();
        }
        else{
            
                        
                        $secure_pass1=md5($p1);
                        $secure_pass2=md5($p2);
            
                        //print_r($secure_pass1);
                        //print_r($secure_pass2);

                        $q3="update customer
                              set c_name='$nm',addr='$addr',email='$eid',pswd='$secure_pass1',conform_pswd='$secure_pass2',city='$city_name',addr_area='$area' where c_id=$r";
 
                        $qry5=mysql_query($q3,$con);
            
            
                        if($qry5)
                        {
                             echo "<script>alert('change successfull');
                             window.location='profile.php'</script>";
                             exit();
                            
                        }
                        else
                        {
                            echo "<script>alert('something is wrong');
                            window.location='manage_profile.php'</script>";
                            exit();
                            
                        }
                        
                            
            
        }
    }
?>

<?php
 
}

?>
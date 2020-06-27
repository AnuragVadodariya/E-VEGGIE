<?php
session_start();

include("same.php");

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>registration here</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- css file include ---------------------->
    
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
    
    <!-- jquery code ----------------------------->
    
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        
   
            
</head>

<body>
     <div class="container">
            <div class="w-50 m-auto py-5">
                 <form action="" name="f1" method="post">
                    <h1 class="text-center">Registration Here </h1>
                     
                        <div class="form-group">

                                    <label class="elements">Customer Name :</label> <input type="text" name="cnm" class="form-control" placeholder="Enter Username " required autocomplete="off"><br>
                         </div>
                         
                         <div class="form-group">

                                    <label class="elements">Address :</label> <textarea class="form-control" placeholder="address Here" autocomplete="off" name="addr" required></textarea><br>
                         </div>
                     
                        <div class="form-group">

                                    <label class="elements">Mobile no :</label> <input type="text" name="mob" class="form-control" placeholder="Enter Mobile number" required autocomplete="off"><br>
                         </div>
                     
                         
                         <div class="form-group">

                                    <label class="elements">Email id :</label> <input type="email" name="eid" class="form-control" placeholder="Entet email" required autocomplete="off"><br>
                         </div>
                     
                         
                         <div class="form-group">   
                                    <label>City</label>
                                     <select class="form-control" name="cty"  size="1" onchange="myfun(this.value)" required>
                                         <option value="" selected disabled>Select City</option>
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
                                         <option value="" selected disabled>Select City Area</option>
                                         
                                       
                                     </select><br>
                         </div>
                         
                     
                         <div class="form-group">
                                    <label>password : </label>  <input type="password" name="pass1" class="form-control" placeholder="Password" required autocomplete="off"><br><br>
                        </div>
                             
                             <div class="form-group">
                                    <label>Conform password : </label>  <input type="password" name="pass2" class="form-control" placeholder=" conform Password" required autocomplete="off"><br><br>
                             </div>
                                 
                            <div class="text-center">
                                
                             <input type="submit" name="sub" value="Registration Success" class="btn btn-success py-8 w-100"> 
                                <br><br><br>
                            

                        <!--    <a href="registration.html" class="text-center">create new account :)</a> -->
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
        
        $a=mysql_query("select city_name from city where city_id=$city_id",$con);
        
        $b=mysql_fetch_array($a);
        
        $city_name=$b[0];
        
       // print_r($c);
        
         $q="select * from customer where mob=$mob";
         $res=mysql_query($q,$con);
         $chk=mysql_num_rows($res);
         $row=mysql_fetch_assoc($res);


         $as=mysql_query("select * from customer where email='$eid'",$con);

         $df=mysql_num_rows($as);

        
        if(!preg_match("/^[a-zA-Z]*$/",$nm))
        {
            echo "<script>alert('Enter validute username');
            window.location='registration.php'</script>";
            exit();
        }
        elseif(!preg_match("/^[0-9]{10}$/",$mob))
        {
            echo "<script>alert('Enter 10 digit mobile number');
            window.location='registration.php'</script>";
            exit();
        }
        elseif(!filter_var($eid, FILTER_VALIDATE_EMAIL))
        {
            echo "<script>alert('Enter validute email');
            window.location='registration.php'</script>";
            exit();
        }
        elseif(!preg_match("^[a-z A-Z 0-9]+(. | _)?[a-z A-Z 0-9]*\@(yahoo|gmail|rediff|email)\.(in|com|org|gov)$^",$eid))
        {
            echo "<script>alert('Enter validute email');
            window.location='registration.php'</script>";
            exit();
        }
        elseif($df > 0)
        {
            echo "<script>alert('This Email is use');
            window.location='registration.php'</script>";
            exit();
        }
        elseif($chk > 0)
        {
            echo "<script>alert('This number use');
            window.location='registration.php'</script>";
            exit();
        }
        elseif($p1 !== $p2)
        {
            echo "<script>alert('password not match');
            window.location='registration.php'</script>";
            exit();
        }
        else{
            
                        
                        $secure_pass1=md5($p1);
                        //$secure_pass2=md5($p2);

                        $qq="insert into customer (c_name,addr,mob,email,pswd,city,addr_area) values('$nm','$addr',$mob,'$eid','$secure_pass1','$city_name','$area');";
 
                        $qry=mysql_query($qq,$con);
                            
                            
                           echo "<script>alert('registration success');
                           window.location='login.php'</script>";
                           exit();
            
        }
    }
?>
        
        <!--validation of password & mob --------------->
        
   <!--     if(!preg_match("/^[0-9]{10}$/",$mob))
        {
            header("Location:registration.php?registration=m_invalid");
            exit();
        }else{
            $q="select * from customer where mob=$mob";
            $res=mysql_query($q,$con);
            $chk=mysql_num_rows($res);
            
            if($chk > 0)
            {
                header("Location:registration.php?registration=m_use");
                exit();
            }else{
                if(!$p1==$p2)
                {
                    header("Location:registration.php?registration=pnot_match");
                    exit();
                }
                else{
                        if($rows=mysql_fetch_assoc($res))
                        {
                            
                        $secure_pass1= password_hash($p1, PASSWORD_DEFAULT);
                        $secure_pass2= password_hash($p2, PASSWORD_DEFAULT);

                        $qq="insert into customer (c_name,addr,mob,pswd,conform_pswd,city,addr_area) values('$nm','$addr',$mob,'$secure_pass1','$secure_pass2','$city','$area');";

                        $qry=mysql_query($qq,$con);
                        
                            header("Location:login.php?login=success");
                            exit();
                        }
                        }

                }
        
        
        
    }
} 
 else
{
    header("Location:registration.php?registration=fail");
    exit();
} -->
    
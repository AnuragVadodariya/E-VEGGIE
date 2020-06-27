<?php

session_start();

unset($_SESSION["manage_login"]);

include('same.php');

$id=$_SESSION['customer_id'];

$qry="select * from customer where mob=$id";

$res=mysql_query($qry,$con);

$row=mysql_fetch_assoc($res);

//print_r($row);


if(isset($_POST["sub"]))
{
    echo "<script>alert('First Verification');
    window.location='manage_login.php'</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Details</title>

  <?php  include("header.php");  ?>

      
      <div class="container">
            <div class="w-50 m-auto py-5">
                 <form action="" name="f1" method="post">
                    <h1 class="text-center">Your Details </h1>
                     
                        <div class="form-group">

                                    <label class="elements">Customer Name :</label> <input type="text" name="cnm" class="form-control" placeholder="Enter Username " required autocomplete="off" value="<?php echo $row["c_name"]; ?>" readonly><br>
                         </div>
                         
                         <div class="form-group">

                                    <label class="elements">Address :</label> <textarea class="form-control" placeholder="address Here" autocomplete="off" name="addr" value="<?php echo $row["addr"]; ?>" required readonly><?php echo $row["addr"]; ?></textarea><br>
                         </div>
                     
                        <div class="form-group">

                                    <label class="elements">Mobile no :</label> <input type="text" name="mob" class="form-control" placeholder="Enter Mobile number" required autocomplete="off" value="<?php echo $row["mob"]; ?>" readonly><br>
                         </div>
                     
                         
                         <div class="form-group">

                                    <label class="elements">Email id :</label> <input type="email" name="eid" class="form-control" placeholder="Entet email" required autocomplete="off" value="<?php echo $row["email"]; ?>" readonly><br>
                         </div>
                     
                         
                         <div class="form-group">   
                                    <label>City</label>
                                     <select class="form-control" name="cty"  size="1" onchange="myfun(this.value)">
                                         <option value="" selected disabled><?php echo $row["city"]; ?></option>
                                        
                                        
                                     </select><br>
                         </div>
                     
                         <div class="form-group">   
                                    <label>City Area</label>
                                     <select class="form-control" id="dataget" size="1" name="area">
                                         <option value="" selected disabled><?php echo $row["addr_area"]; ?></option>
                                         
                                       
                                     </select><br>
                         </div>
                         
                                 
                            <div class="text-center">
                                
                             <input type="submit" name="sub" value="Change something" class="btn btn-success py-8 w-100"> 
                                <br><br><br>
                            

                            </div>

                       
                </form>
            </div>
        </div>
      
    </body>
    
</html>

<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
            
    </head>
    <title>Login</title>
	<body>
        <div class="container">
            <div class="w-50 m-auto py-5">
                 <form action="" name="f1" method="post">
                    <h1 class="text-center">verification Login </h1>
                        <div class="form-group">

                                    <label class="elements">Mobile no :</label> <input type="text" name="mob" class="form-control" placeholder="Enter Mobile number" required autocomplete="off"><br><br>
                         </div>
                         <div class="form-group">
                                    <label>password : </label>  <input type="password" name="pass" class="form-control" placeholder="Password" required autocomplete="off"><br><br><br>
                            <div class="text-center">
                                
                             <input type="submit" name="sub" value="login" class="btn btn-success py-8 w-100"> 
                                <br><br><br>
                            

                            </div>

                        </div>
                </form>
            </div>
        </div>
    </body>
</html>


<?php


    
    if(isset($_POST["sub"]))
    {
    
            include('same.php');

            $m=$_POST["mob"];
            $pass=$_POST["pass"];
            
            $dec=md5($pass);
            
            $q="select mob,pswd from customer";
            //$q="SELECT `mob`,`pswd` FROM `customer` WHERE `mob`=$m,`pswd`='$dec'";

                
               $res=mysql_query($q,$con);

              /*  $row=mysql_fetch_array($res);

                print_r($row);
                exit();
                */

                // fetch all mob and password from customer table
        

                 while($row=mysql_fetch_array($res))
                {
                    if($m==$row[0] && $dec==$row[1])
                    {
                        
                        $_SESSION["manage_login"]=$_POST["mob"];
                        
                        echo "<script>alert('Both Right');
                        window.location='manage_profile.php'</script>";
                        
                        
                       
                    }
                    else if($m==$row[0])
                    {
                        echo "<script>alert('Please Enter Valid mobile number');
                        window.location='manage_login.php'</script>";
                    }
                    else if($pass==$row[1])
                    {
                        echo "<script>alert('Please Enter Valid password');
                        window.location='manage_login.php'</script>";
                    }
                    else
                    {
                        echo "<script>alert('Please Enter Valid ');
                        window.location='manage_login.php'</script>";
                    }
                    
               } 
    
    }
?>
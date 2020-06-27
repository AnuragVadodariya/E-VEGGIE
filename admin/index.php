<?php

    session_start();
    
    if(isset($_POST["sub"]))
    {
    
            include('same.php');

            $m=$_POST["unm"];
            $pass=$_POST["pass"];
            
            $dec=md5($pass);
            
            $q="select admin_name,pswd from admin_login";
            
                
               $res=mysql_query($q,$con);

              /*  $row=mysql_fetch_array($res);

                print_r($row);
                exit();
                */

                // fetch all admin name and password from admin_login table
        

                 while($row=mysql_fetch_array($res))
                {
                    if($m==$row[0] && $dec==$row[1])
                    {
                        
               
                         $_SESSION['admin_nm']=$_POST["unm"];
                        // $_SESSION['password']=$pass['pswd'];
               
                       echo "<script>alert('Welcome Admin');
                            window.location='panel.php'</script>";
                    }
                    else if($m==$row[0])
                    {
                        echo "<script>alert('Please Enter Valid Admin name');
                        window.location='index.php'</script>";
                    }
                    else if($dec==$row[1])
                    {
                        echo "<script>alert('Please Enter Valid password');
                        window.location='index.php'</script>";
                    }
                    
               } 
    
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="../css/bootstrap.min.css">
            
    </head>
    <title>Admin Login</title>
	<body>
        <div class="container">
            <div class="w-50 m-auto py-5">
                 <form action="" name="f1" method="post">
                    <h1 class="text-center">Admin Login </h1>
                        <div class="form-group">

                                    <label class="elements">Admin-name :</label> <input type="text" name="unm" class="form-control" placeholder="Admin Name" required autocomplete="off"><br><br>
                         </div>
                         <div class="form-group">
                                    <label>password : </label>  <input type="password" name="pass" class="form-control" placeholder="Password" required autocomplete="off"><br><br><br>
                            <div class="text-center">
                                
                             <input type="submit" name="sub" value="login" class="btn btn-success py-8 w-100"> 
                                <br><br><br>
                            

                           <!--    <a href="registration.php" class="text-center">create new account :)</a>  -->
                            </div>

                        </div>
                </form>
            </div>
        </div>
    </body>
</html>


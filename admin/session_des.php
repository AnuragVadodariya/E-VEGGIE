<?php

        session_start();
        session_destroy();
        unset($_SESSION['admin_nm']);
        //unset($_SESSION['password']);
        header("Location:index.php");
        exit();

?>
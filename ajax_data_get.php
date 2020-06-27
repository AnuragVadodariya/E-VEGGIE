<?php

    include('same.php');

    $nameid=$_POST['datapost'];


    $q="select * from city_area where city_id=$nameid";
    $r=mysql_query($q,$con);

    while($re=mysql_fetch_array($r))
    {
?>
        <option> <?php echo $re['area_name']; ?> </option>
<?php
    }

?>
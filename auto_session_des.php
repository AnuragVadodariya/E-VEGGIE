<?php

session_start();

unset($_SESSION["vegetable_cart"]);
unset($_SESSION["total"]);

echo "<script>alert('order success');
window.location='cart.php'</script>;";

?>


<?php 
session_start();
echo $_SESSION['firstname'];
echo $_SESSION['name'];
echo $_SESSION['id_user'];
echo $_SESSION['usertype'];
echo "Yo user";
echo "<a href='../login/index.php'>Login</a>";
?>
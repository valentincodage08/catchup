<?php 
session_start();
echo $_SESSION['firstname'];
echo $_SESSION['name'];
echo $_SESSION['id_user'];
echo $_SESSION['usertype'];
echo "Yo modo";
echo "<a href='../login/index.php'>Login</a>";
?>
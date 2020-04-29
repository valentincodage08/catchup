<?php 
session_start();
if(isset($_SESSION['firstname'])) {
    echo $_SESSION['firstname'];
    echo $_SESSION['name'];
    echo $_SESSION['id_user'];
    echo $_SESSION['usertype'];
    echo "Yo admin";
    echo "<a href='../login/index.php'>Login</a>";
}
else {
    echo "MEEEERDE";
}
?>
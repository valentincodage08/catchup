<?php
session_start();

if ($_SESSION['usertype'] == 2) { ?>
<p>Hello admin</p>




<?php } 
else {
    header('location: index.php');
}
?>
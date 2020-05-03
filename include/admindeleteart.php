<?php
session_start();
if ($_SESSION['usertype'] == 2) { 
require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();


$thisarticle = $_GET['id'];

$req = $db->prepare(" DELETE FROM CUArticle WHERE id_article = $thisarticle");
          $req ->execute();

          $req->closecursor();
          header('Location: ../views/tabadmin.php?success=4');
} 
else {
    header('location: ../views/index.php');
}
?>
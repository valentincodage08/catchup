<?php
session_start();
if ($_SESSION['usertype'] == 2) { 
require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

$thisarticle = $_GET['id'];

$title = $_POST['title'];
$category = $_POST['category'];
$image = $_POST['image'];

$req = $db->prepare(" UPDATE CUArticle SET title = '$title', category = '$category', image = '$image' WHERE id_article = $thisarticle");
        $req->execute();

        $req->closecursor();

        header('location: ../views/tabadmin.php?success=3');
} 
else {
  header('location: ../views/index.php');
}
?>
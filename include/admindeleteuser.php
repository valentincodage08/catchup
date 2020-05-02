<?php
session_start();
require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();


$userid = $_GET['id'];

$req = $db->prepare(" DELETE FROM CUUser WHERE id_user = $userid");
          $req ->execute();

          $req->closecursor();
          header('Location: ../views/tabadmin.php?success=2');
?>
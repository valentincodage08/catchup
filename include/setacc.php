<?php
session_start();

require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

$userid = $_GET['id'];

$name = $_POST['name'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];

$req = $db->prepare(" UPDATE CUUser SET name = '$name', firstname = '$firstname', email = '$email' WHERE id_user = $userid");
        $req->execute();

        $req->closecursor();

$_SESSION['firstname'] = $firstname;

          header("Location: updateacc.php?id=$userid&success=1");
?>
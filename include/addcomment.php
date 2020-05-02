<?php
session_start();
require_once('../models/class_Database.php');

$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

$thisarticle = $_GET['article'];
$msg = $_POST['message'];
$today = date("d/m/Y");

$req = $db->prepare("INSERT INTO CURcomart (rid_article) VALUES ('$thisarticle')");
$req->execute();
$req->closeCursor();

$req2 = $db->prepare("INSERT INTO CUComments (id_creator, posted_at, content) VALUES (:id_creator, :posted_at, :content)");
$req2->execute(array(
    ':id_creator' => $_SESSION['id_user'],
    ':posted_at' => $today,
    ':content' => $msg
));
$req2->closeCursor();

header("location:javascript://history.go(-1)");

?>
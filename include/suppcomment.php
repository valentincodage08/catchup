<?php
session_start();
require_once('../models/class_Database.php');

$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

$thisarticle = $_GET['article'];
$thiscomment = $_GET['comment'];

$req = $db->prepare("DELETE FROM CURcomart WHERE rid_article = '$thisarticle' AND rid_comment = '$thiscomment'");
$req->execute();
$req->closeCursor();

$req2 = $db->prepare("DELETE FROM CUComments WHERE id_comment = '$thiscomment'");
$req2->execute();
$req2->closeCursor();

header("location:javascript://history.go(-1)");

?>
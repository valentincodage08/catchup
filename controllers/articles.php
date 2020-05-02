<?php
session_start();
require_once('../models/class_Database.php');
require_once('../models/class_User.php');

// Je créée l'objet $connexion qui est la connexion à ma db
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

// Je récupère l'id de l'article
$thisarticle = $_GET['article']


?>
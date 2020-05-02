<?php
session_start();
require_once('../models/class_Database.php');
require_once('../models/class_User.php');

// Je créée l'objet $connexion qui est la connexion à ma db
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

// Je récupère mes données du formulaire de login
$firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : NULL;
$name = !empty($_POST['name']) ? $_POST['name'] : NULL;
$email = !empty($_POST['email']) ? $_POST['email'] : NULL;
$password = !empty($_POST['password']) ? $_POST['password'] : NULL;

// Je créée mon objet user avec les données au-dessus
$user = new User($email, $password);
$user->addUser($db);

?>
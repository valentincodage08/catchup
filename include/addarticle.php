<?php
session_start();
if ($_SESSION['usertype'] == 2) { 
require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

$title = $_POST['title'];
$content = $_POST['content'];
$image = $_POST['image'];
$category = $_POST['category'];
$author = $_SESSION['id_user'];
$today = date("d/m/Y");

$req = $db->prepare("INSERT INTO CUArticle (title, content, author, image, category, created) 
                        VALUES (:title, :content, :author, :image, :category, :created)");
$req->execute(array(
    ':title' => $title,
    ':content' => $content,
    ':author' => $author,
    ':image' => $image,
    ':category' => $category,
    ':created' => $today
));
$req->closeCursor();
header('Location: ../views/tabadmin.php?success=5');


} 
else {
    header('location: ../views/index.php');
}
?>
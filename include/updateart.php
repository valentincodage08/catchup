<?php
session_start();
// Bien entendu pour les update/delete coté admin, restreindre l'accès uniquement à l'admin si qqn joue avec l'url
if ($_SESSION['usertype'] == 2) { 
require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bg-light">

<?php

$thisarticle = $_GET['id'];

$req = $db->prepare("SELECT * FROM CUArticle WHERE id_article = $thisarticle");
$req->execute();


  while ($donnees = $req->fetch())
{

?>

<h3 class="font-weight-light text-black-50 mt-4 mb-5">
    <center>Modifier l'article</center>
  </h3>

  <div class="container">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
      <form id="contact" action="setart.php?id=<?= $thisarticle;?>" method="post">
          <div class="form-group">
            <label>Titre</label>
            <input type="text" class="form-control" name="title" tabindex="2" value="<?= $donnees['title'];?>">
          </div>
          <div class="form-group">
            <label>Contenu</label>
            <input type="text" class="form-control" name="content" tabindex="3" value="<?= $donnees['content'];?>">
          </div>
          <label for="exampleFormControlSelect1">Catégorie</label>
          <select class="form-control" name="category" tabindex="4" required>
            <option>Sport</option>
            <option>Memes</option>
          </select>
          <div class="form-group">
            <label>Image</label>
            <input type="text" class="form-control mb-3" name="image" tabindex="4" value="<?= $donnees['image'];?>">
          </div>
          <center><button type="submit" class="btn btn-outline-secondary mb-3" value="submit">Modifier</button></center>
        </form>
          <a href="../views/tabadmin.php"><center><button class="btn btn-outline-secondary">Retour</button></center></a>
      </div>
    </div>
  </div>

  <?php } ?>
</body>
</html>
<?php } 
else {
    header('location: ../views/index.php');
}
?>
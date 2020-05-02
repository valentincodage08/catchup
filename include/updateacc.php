<?php
session_start();
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

$userid = $_GET['id'];

$req = $db->prepare("SELECT * FROM CUUser WHERE id_user = $userid");
$req->execute();


  while ($donnees = $req->fetch())
{

?>

<h3 class="font-weight-light text-black-50 mt-4 mb-5">
    <center>Modifier votre profil</center>
  </h3>

  <div class="container">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
      <?php 
        if(isset($_GET['success'])){
          if($_GET['success'] == '1') {?>
            <div class="alert alert-secondary" role="alert">
              Votre profil a bien été modifié.
            </div>
      <?php }} ?>
      <form id="contact" action="setacc.php?id=<?= $userid;?>" method="post">
          <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" name="name" tabindex="2" value="<?= $donnees['name'];?>">
          </div>
          <div class="form-group">
            <label>Prénom</label>
            <input type="text" class="form-control" name="firstname" tabindex="3" value="<?= $donnees['firstname'];?>">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control mb-3" name="email" tabindex="4" value="<?= $donnees['email'];?>">
          </div>
          <center><button type="submit" class="btn btn-outline-secondary mb-3" value="submit">Modifier</button></center>
        </form>
          <a href="../views/index.php"><center><button class="btn btn-outline-secondary">Retour</button></center></a>
      </div>
    </div>
  </div>

  <?php } ?>
</body>
</html>
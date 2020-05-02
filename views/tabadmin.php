<?php
session_start();

if ($_SESSION['usertype'] == 2) { 
require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">
</head>
<body class="bg-light">
<h1 class="text-center font-weight-light font-italic text-black-50 mt-4 mb-5">Bienvenue dans votre interface
    Administrateur</h1>
    <center><a href="index.php" class="text-black-50 mb-5">Revenir à l'accueil</a></center>
    <div class="container mt-2">
    <h3 class="font-weight-light text-black-50 mt-4 mb-5">
    <center>Utilisateurs</center>
  </h3>

  <div class="container mt-2">
  <?php 
                if(isset($_GET['success'])){
                if($_GET['success'] == '1') {?>
                    <div class="alert alert-secondary" role="alert">
                    Les données de l'utilisateur viennent d'être modifiées.
                    </div>

                <?php
                } elseif($_GET['success'] == '2') {?>
                  <div class="alert alert-secondary" role="alert">
                  Vous venez de supprimer un utilisateur.
                  </div>
            <?php }} ?>
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Mail</th>
          <th scope="col">Rang</th>
          <th scope="col">Modifier</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <tbody>


        <?php
$req = $db->prepare("SELECT * FROM CUUser");
    $req->execute();

    while ($donnees = $req->fetch())
{ ?>
        <tr>
          <th scope="row"><?= $donnees['id_user']; ?></th>
          <td><?= $donnees['name']; ?></td>
          <td><?= $donnees['firstname']; ?></td>
          <td><?= $donnees['email']; ?></td>


          <?php if($donnees['usertype'] == 0) { ?>
            <td>Utilisateur</td>
          <?php } elseif($donnees['usertype'] == 1) { ?>
            <td>Modérateur</td>
            <?php } else { ?>
            <td>Administrateur</td>
            <?php } ?>



          <td><a href="../include/updateacc.php?id=<?= $donnees['id_user'];?>" class="text-muted"><i
                class="fas fa-user-edit"></i></a></td>
          <td><a href="../include/admindeleteuser.php?id=<?= $donnees['id_user'];?>" class="text-muted"><i
                class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php
}
$req->closecursor();
?>
      </tbody>
    </table>
  </div>



  <div class="container mt-2">
    <h3 class="font-weight-light text-black-50 mt-4 mb-5">
    <center>Articles</center>
  </h3>

  <div class="container mt-2">
  <?php 
                if(isset($_GET['success'])){
                if($_GET['success'] == '3') {?>
                    <div class="alert alert-secondary" role="alert">
                    Article modifié.
                    </div>

                <?php
                } elseif($_GET['success'] == '4') {?>
                  <div class="alert alert-secondary" role="alert">
                  Article supprimé.
                  </div>
            <?php }} ?>
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Mail</th>
          <th scope="col">Rang</th>
          <th scope="col">Modifier</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <tbody>


        <?php
$req = $db->prepare("SELECT * FROM CUUser");
    $req->execute();

    while ($donnees = $req->fetch())
{ ?>
        <tr>
          <th scope="row"><?= $donnees['id_user']; ?></th>
          <td><?= $donnees['name']; ?></td>
          <td><?= $donnees['firstname']; ?></td>
          <td><?= $donnees['email']; ?></td>


          <?php if($donnees['usertype'] == 0) { ?>
            <td>Utilisateur</td>
          <?php } elseif($donnees['usertype'] == 1) { ?>
            <td>Modérateur</td>
            <?php } else { ?>
            <td>Administrateur</td>
            <?php } ?>



          <td><a href="../include/updateacc.php?id=<?= $donnees['id_user'];?>" class="text-muted"><i
                class="fas fa-user-edit"></i></a></td>
          <td><a href="../include/admindeleteuser.php?id=<?= $donnees['id_user'];?>" class="text-muted"><i
                class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php
}
$req->closecursor();
?>
      </tbody>
    </table>
  </div>




<?php } 
else {
    header('location: index.php');
}
?>
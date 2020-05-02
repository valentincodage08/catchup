<?php 
session_start();
require_once('../models/class_Database.php');
$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();
$thisarticle = $_GET['article'];


$req = $db->prepare("SELECT * FROM CUArticle WHERE id_article = $thisarticle");
$req->execute();
while($donnees = $req->fetch() ) { ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?=$donnees['title']; ?></title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="../css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="../css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		
	<?php include('../include/nav.php'); ?>

	<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('<?= $donnees['image'] ?>');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category cat-2" href="category.php"><?= $donnees['category'] ?></a>
								<!-- <span class="post-date">Article par (author name )</span> -->
							</div>
							<h1><?= $donnees['title'] ?></h1>
						</div>
					</div>
				</div>
			</div>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								<h3><?= $donnees['title'] ?></h3>
								<p><?= $donnees['content'] ?></p>
								
						<?php

						$author = $donnees['author'];

						$req2 = $db->prepare("SELECT * FROM CUUser WHERE id_user = $author");
						$req2->execute();
						while($auth = $req2->fetch() ) { ?>


						<!-- author -->
						<div class="section-row">
							<div class="post-author">
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="../img/author.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h3><?= $auth['firstname'] ?> <?= $auth['name'] ?></h3>
										</div>
										<p>Administrateur</p>
										<ul class="author-social">
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- /author -->

						<?php $req2->closeCursor(); } ?>

						<!-- comments -->
						<div class="section-row">
							<div class="section-title">
								<h2>Commentaires</h2>
							</div>

							<?php

							$req3 = $db->prepare("SELECT picture, firstname, name, posted_at, content, rid_comment FROM CUComments as c, CURcomart as r, CUUser as u WHERE r.rid_article = $thisarticle AND r.rid_comment = c.id_comment AND c.id_creator = u.id_user");
							$req3->execute();
							while($com = $req3->fetch() ) { ?>

							<div class="post-comments">
								<!-- comment -->
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="<?= $com['picture'] ?>" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?= $com['firstname'] ?> <?= $com['name'] ?></h4>
											<span class="time"><?= $com['posted_at'] ?></span>
											<?php if($_SESSION['usertype'] == 1){ ?>
												<span class="time"><a href="../include/suppcomment.php?article=<?=$thisarticle?>&comment=<?= $com['rid_comment'] ?>">Supprimer</a></span>
											<?php } ?>
											<?php if($_SESSION['usertype'] == 2){ ?>
												<span class="time"><a href="../include/suppcomment.php?article=<?=$thisarticle?>&comment=<?= $com['rid_comment'] ?>">Supprimer</a></span>
											<?php } ?>
										</div>
										<p><?= $com['content'] ?></p>
									</div>
								</div>
								<!-- /comment -->

							<?php } $req3->closeCursor(); ?>

							</div>
						</div>
						<!-- /comments -->

						<?php if(isset($_SESSION['usertype'])) {?>

						<!-- reply -->
						<div class="section-row">
							<div class="section-title">
								<h2>Commenter</h2>
							</div>
							<form action="../include/addcomment.php?article=<?=$thisarticle?>" method="POST">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Commentaire"></textarea>
										</div>
										<button class="primary-button" value="submit">Poster</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<?php } else { ?>

						<div class="section-row">
							<div class="section-title">
								<h2>Veuillez vous <a href="../login/index.php">connecter</a> pour commenter</h2>
							</div>
						</div>

					<?php } ?>

					

		<!-- Footer -->
		<footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index.html" class="logo"><img src="../img/logo.png" alt=""></a>
							</div>
							<ul class="footer-nav">
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Advertisement</a></li>
							</ul>
							<div class="footer-copyright">
								<span>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">About Us</h3>
									<ul class="footer-links">
										<li><a href="about.html">About Us</a></li>
										<li><a href="#">Join Us</a></li>
										<li><a href="contact.html">Contacts</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">Catagories</h3>
									<ul class="footer-links">
										<li><a href="category.html">Web Design</a></li>
										<li><a href="category.html">JavaScript</a></li>
										<li><a href="category.html">Css</a></li>
										<li><a href="category.html">Jquery</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Join our Newsletter</h3>
							<div class="footer-newsletter">
								<form>
									<input class="input" type="email" name="newsletter" placeholder="Enter your email">
									<button class="newsletter-btn"><i class="fa fa-paper-plane"></i></button>
								</form>
							</div>
							<ul class="footer-social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							</ul>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->

		<!-- jQuery Plugins -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/main.js"></script>

	</body>
</html>
<?php } ?>
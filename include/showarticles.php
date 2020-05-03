<?php
require_once('../models/class_Database.php');

$connexion = new Database('db5000303630.hosting-data.io', 'dbs296617', 'dbu526536', '7f,7]WCg');
$db = $connexion->PDOConnexion();

$req=$db->prepare("SELECT * FROM CUArticle");
$req->execute();
while($articles = $req->fetch()) { ?>

<div class="col-md-6">
	<div class="post post-thumb">
		<a class="post-img" href="blog-post.php?article=<?= $articles['id_article'] ?>"><img src="<?= $articles['image'] ?>" alt=""></a>
		<div class="post-body">
			<div class="post-meta">

                <?php if($articles['category'] == 'Memes') {?>

				<a class="post-category cat-2" href="category.php"><?= $articles['category'] ?></a>

                <?php } if($articles['category'] == 'Sport') {?>

                <a class="post-category cat-1" href="category.php"><?= $articles['category'] ?></a>

                <?php } ?>


				<span class="post-date"><?= $articles['created'] ?></span>
			</div>
		<h3 class="post-title"><a href="blog-post.php?article=<?= $articles['id_article'] ?>"><?= $articles['title'] ?></a></h3>
		</div>
	</div>
</div>
                    <?php
} $req->closecursor();
?>
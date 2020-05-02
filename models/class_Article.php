<?php
session_start();
require_once('class_Database.php');

class Article {

    private $_title;
    private $_content;
    private $_author;
    private $_image;
    private $_category;

    public function __construct($_title, $_content, $_author, $_image, $_category) {
        $this->_title = $_title;
        $this->_content = $_content;
        $this->_author = $_author;
        $this->_image = $_image;
        $this->_category = $_category;
    }

    public function showArticles($db) {
        $req=$db->prepare("SELECT * FROM CUArticle");
        $req->execute();
        $article = $req->fetch();
        $req->closeCursor();
    }

    public function showThisArticle($db, $thisarticle) {
        $req=$db->prepare("SELECT * FROM CUArticle WHERE id_article = $thisarticle");
        $req->execute();
        $article = $req->fetch();
        $req->closeCursor();
    }

    public function addArticle($db) {
        $req = $db->prepare("INSERT INTO CUArticle (title, content, author, image, category)
                              VALUES (:title, :content, :author, :image, :category)");
        $req->execute(array(
                ':title' => $this->_title,
                ':content' => $this->_content,
                ':author' => $_SESSION['id_user'],
                ':image' => $this->_image,
                ':category' => $this->_category
        ));
        $req->closeCursor();
    }





}
?>
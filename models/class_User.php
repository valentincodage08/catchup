<?php
session_start();
require_once('class_Database.php');

class User {

    private $_firstname;
    private $_name;
    private $_email;
    private $_password;

    public function __construct($_email, $_password) {
        $this->_email = $_email;
        $this->_password = $_password;
    }

    public function connectUser($db) {
        $req = $db->prepare("SELECT * FROM CUUser WHERE email = :email AND password = :password");
        $req->execute(array(
                ':email' => $this->_email,
                ':password' => $this->_password
        ));

        $resultat = $req->fetch();

        if (isset($resultat['email'])) {

            if ($resultat['password']==$this->_password) {

                if ($resultat['usertype'] == 0){
                    session_start();
                    $_SESSION['firstname'] = $resultat['firstname'];
                    $_SESSION['name'] = $resultat['name'];
                    $_SESSION['id_user'] = $resultat['id_user'];
                    $_SESSION['usertype'] = $resultat['usertype'];
                    header('location: ../views/index.php');
                }
                // Modérateur
                elseif ($resultat['usertype'] == 1) {
                    session_start();
                    $_SESSION['firstname'] = $resultat['firstname'];
                    $_SESSION['name'] = $resultat['name'];
                    $_SESSION['id_user'] = $resultat['id_user'];
                    $_SESSION['usertype'] = $resultat['usertype'];
                    header('location: ../views/index.php');
                }
                else {
                    // Admin
                    session_start();
                    $_SESSION['firstname'] = $resultat['firstname'];
                    $_SESSION['name'] = $resultat['name'];
                    $_SESSION['id_user'] = $resultat['id_user'];
                    $_SESSION['usertype'] = $resultat['usertype'];
                    header('location: ../views/index.php');
                }
                
            }
            else {
                // erreur : mdp identifiants incorrects
                header('location: ../login/index.php?success=2');
            }

        }
        else {
            // erreur : identifiants incorrects ( ici pas de mail)
            header('location: ../login/index.php?success=2');
        }

        $req->closeCursor();

    }

    public function addUser($db) {
        $req = $db->prepare("INSERT INTO CUUser (firstname, name, email, password, token, verified, usertype)
                              VALUES (:firstname, :name, :email, :password, :token, 0, 0)");
        $req->execute(array(
                ':firstname' => $_POST['firstname'],
                ':name' => $_POST['name'],
                ':email' => $this->_email,
                ':password' => $this->_password,
                ':token' => $token = substr(str_shuffle(str_repeat("0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN", 32)), 0, 32)
        ));
        $req->closeCursor();
        // mail($this->_username, "Veuillez confirmer votre mail", "Veuillez confirmer votre mail en cliquant ici : http://demandat.simplon-charleville.fr/exo-POO-2/confirm.php?token=$token");
        header('location: ../login/index.php?success=1');
    }
}
?>
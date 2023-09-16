<?php
    require_once 'config.php';
    //Si toutes les conditions sont remplies et que les variables existent
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['identifiant']) && $_POST['password'])
    {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $password = htmlspecialchars($_POST['password']);

        //Vérification de l'existance de l'utilisateur
        $check = $bdd->prepare('SELECT identifiant, prenom, nom, password FROM utilisateurs WHERE identifiant = ?');
        $check->execute(array($identifiant));
        $data = $check->fetch();
        $row = $check->rowCount();

        //Vérification de la longueur des champs
        if($row == 0){ 
            if(strlen($identifant) <= 5){
                if(strlen($prenom) <= 100){
                    if(strlen($nom) <= 100){
                        // On hash le mdp avec Bcrypt
                        $cost = ['cost' => 12];
                        $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                        // Utilisation d'un tableau associatif
                        $insert = $bdd->prepare('INSERT INTO utilisateurs(identifiant, prenom, nom, password) VALUES(:identifiant, :prenom, :nom, :password)');
                        $insert->execute(array(
                            'identifiant' => $identifiant,
                            'prenom' => $prenom,
                            'nom' => $nom,
                            'password' => $password,
                        ));
                        
                        // Si inscription réussie, renvoie vers la page de connexion
                        header('Location:connexion.php?login_err=success');
                        die();
                            
                    }else{ header('Location: inscription.php?reg_err=nom'); die();}
                }else{ header('Location: inscription.php?reg_err=prenom'); die();}
            }else{ header('Location: inscription.php?reg_err=identifiant'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }
?>
<?php
    // Permet de se connecter
    session_start(); 
    require_once 'config.php';

    //Si toutes ces entrées sont renseignées
    if(isset($_POST['identifiant']) && $_POST['password'])
    {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $password = htmlspecialchars($_POST['password']);

        // Vérifie si la personen existe
        $check = $bdd->prepare('SELECT identifiant, password FROM utilisateurs WHERE identifiant = ?');
        $check->execute(array($identifiant));
        $data = $check->fetch();
        $row = $check->rowCount();

        // Vérifie si la personne existe et que le mot de passe correspond
        if($row > 0)
        {
            // Si le mot de passe est bon
            if(password_verify($password, $data['password']))
            {
                //Création de session et redirection vers map.php pour accéder à la carte
                $_SESSION['user'] = $data['identifiant'];
                header('Location:map.php'); 
            }else{ header('Location: connexion.php?login_err=password'); die(); }
        }else{ header('Location: connexion.php?login_err=identifiant'); die(); }
    
    }else{ header('Location: connexion.php'); die();}
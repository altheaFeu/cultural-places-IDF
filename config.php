<?php

// Connexion à la base de donnée

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=connexion_projet;charset=utf8', 'root', '');
}catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
}

?>
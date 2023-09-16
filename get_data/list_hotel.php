
<?php
    require ('./config.php');
    
    $result = $bdd->prepare("SELECT nom_commerc, code_postal, adresse, ST_AsGeoJSON(geom) as geom FROM hotels");
    $list_hotels=[];

    if (!$result) {
        echo "Erreur.\n";
        exit;
    }else{
        $result->execute();

        if ($result->rowCount() > 0) {    
            while($row = $result->fetch()){
            $list_hotels[] = $row;
        }}
    }
?>
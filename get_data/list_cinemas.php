<?php
    require ('./config.php');
    
    $result = $bdd->prepare("SELECT dep, nom, region_admi, adresse, code_insee, commune, ST_AsGeoJSON(geom) as geom FROM cinemas LIMIT 100");
    $list_cinemas=[];

    if (!$result) {
        echo "Erreur.\n";
        exit;
    }else{
        $result->execute();

        if ($result->rowCount() > 0) {    
            while($row = $result->fetch()){
            $list_cinemas[] = $row;
        }}
    }
?>
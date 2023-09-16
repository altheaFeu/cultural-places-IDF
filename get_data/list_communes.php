<?php
    require ('./config.php');
    
    $result = $bdd->prepare("SELECT departement,departement_1, libelle_de_, population_, hypermarche, supermarche, grande_surf, superette, epicerie, 
                                    boulangerie, boucherie_c, produits_su, poissonneri, librairie_p, magasin_de_, magasin_d_e, 
                                    magasin_de__1, magasin_de__2, magasin_d_a, magasin_de__3, droguerie_q, parfumerie, horlogerie_, 
                                    fleuriste, magasin_d_o, station_ser, ST_AsGeoJSON(geom) as geom FROM communes");
    $list_communes=[];

    if (!$result) {
        echo "Erreur.\n";
        exit;
    }else{
        $result->execute();

        if ($result->rowCount() > 0) {    
            while($row = $result->fetch()){
            $list_communes[] = $row;
        }}
    }
?>
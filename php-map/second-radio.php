<html>
    <?php
        include('./get_data/list_hotel.php');
        include('./get_data/list_cinemas.php');
    ?>
    
    <script>  
        function secondRadio(){

            // Suppression de l'ensemble des couches pour mettre à jour la carte
            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });
            tiles.addTo(map);
            
            // Faire la somme de tout les commerces pour savoir combien de commerce il y a par commune
            geoJ.eachLayer(function (feature) {

                var proprietes = feature.feature.properties;

                var somme = proprietes.hypermarche + proprietes.supermarche + proprietes.grande_surf + 
                proprietes.superette + proprietes.epicerie+ proprietes.boulangerie + 
                proprietes.boucherie_c + proprietes.produits_su + proprietes.poissonneri +
                proprietes.librairie_p + proprietes.magasin_de_ + proprietes.magasin_d_e +
                proprietes.magasin_de__1 + proprietes.magasin_de__2 + proprietes.magasin_d_a +
                proprietes.magasin_de__3 + proprietes.droguerie_q + proprietes.parfumerie + proprietes.horlogerie_+
                proprietes.fleuriste+proprietes.magasin_d_o

                // Display the count on the feature
                if (somme<2){
                    feature.addTo(map);
                }
            });  

            // Zoom sur les features
            map.flyToBounds(geoJ.getBounds());
        }
   
    </script>
</html>  

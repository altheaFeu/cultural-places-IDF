<html>
    <?php
        include('./get_data/list_cinemas.php');
    ?>
    
    <script>  
        function firstRadio(){

            // Suppression de l'ensemble des couches pour mettre à jour la carte
            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });
            tiles.addTo(map);
            
            var list_cinemas = <?php echo json_encode($list_cinemas); ?>;
        
            geoJ.eachLayer(function (feature) {

                var count = 0;
                var bounds = feature.getBounds();
                
                // Pour chaque cinema, regarder s'il est compris dans les limites de la feature
                for (var j=0; j < list_cinemas.length; j++){
                    var cine = list_cinemas[j];
                    var array = cine["geom"].substring(40, cine["geom"].length-4).split(',');
                    
                    var m = L.marker([array[1], array[0]]);
                    point = m.getLatLng();

                    if (bounds.contains(point)) {
                        count++;
                    }
                };

                // S'il y a plus de 5 cinemas, afficher la feature
                if (count>5){
                    feature.addTo(map);
                }
            });  

            // Zoom sur les features
            map.flyTo([48.864716, 2.349014], 11);
        }
   
    </script>
</html>  
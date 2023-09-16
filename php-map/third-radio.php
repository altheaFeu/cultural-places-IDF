<html>
    <?php
        include('./get_data/list_hotel.php');
    ?>
    
    <script>  
        function thirdRadio(){

            // Suppression de l'ensemble des couches pour mettre à jour la carte
            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });
            tiles.addTo(map);

            var list_hotels = <?php echo json_encode($list_hotels); ?>;
        
            geoJ.eachLayer(function (feature) {

                var count = 0;
                var bounds = feature.getBounds();
                
                // Pour chaque hotel, regarder s'il est compris dans les limites de la feature
                for (var j=0; j < list_hotels.length; j++){
                var hotel = list_hotels[j];
                var array = hotel["geom"].substring(40, hotel["geom"].length-4).split(',');
                
                var m = L.marker([array[1], array[0]]);
                point = m.getLatLng();

                if (bounds.contains(point)) {
                    count++;
                    }
                };

                // Display the count on the feature
                if (count>=20){
                    feature.addTo(map);
                }
            });  
        }

    </script>
</html>  
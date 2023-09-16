<html>
    <?php
        include('./get_data/list_hotel.php');
        include('./get_data/list_cinemas.php');
    ?>
    
    <script>  
        function lastRadio(){

            // Suppression de l'ensemble des couches pour mettre à jour la carte
            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });
            tiles.addTo(map);

            var list_hotels = <?php echo json_encode($list_hotels); ?>;
            var list_cinemas = <?php echo json_encode($list_cinemas); ?>;
        
            geoJ.eachLayer(function (feature) {

                var countCinema = 0;
                var countHotel = 0;
                var bounds = feature.getBounds();
                
                // Pour chaque cinema, regarder s'il est compris dans les limites de la feature
                for (var j=0; j < list_cinemas.length; j++){
                    var cine = list_cinemas[j];
                    var array1 = cine["geom"].substring(40, cine["geom"].length-4).split(',');
                    
                    var m1 = L.marker([array1[1], array1[0]]);
                    pointCine = m1.getLatLng();

                    if (bounds.contains(pointCine)) {
                        countCinema++;
                    }
                };

                // Pour chaque hotel, regarder s'il est compris dans les limites de la feature
                for (var z=0; z < list_hotels.length; z++){
                    var hotel = list_hotels[z];
                    var array2 = hotel["geom"].substring(40, hotel["geom"].length-4).split(',');
                    
                    var m2 = L.marker([array2[1], array2[0]]);
                    pointHotel = m2.getLatLng();

                    if (bounds.contains(pointHotel)) {
                        countHotel++;
                    }
                };

                // Display the count on the feature
                if (countCinema<5 && countHotel<15 ){
                    feature.addTo(map);
                }
            });  
            
        }
   
    </script>
</html>  
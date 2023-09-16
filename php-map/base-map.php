<html>

    <?php
        include('./get_data/list_communes.php');
    ?>
    <script>
        // Créer une carte Open Street Map
        const map = L.map('map').setView([48.864716, 2.349014], 11);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // // Encodage de l'array en json des communes
        var list_communes = <?php echo json_encode($list_communes); ?>;  

        // Afficher les communes
        function getGeoJSON(list_communes) {
            var geoJSON = {
                "type": "FeatureCollection",
                'crs': {
                            'type': 'name',
                            'properties': {
                            'name': 'EPSG:4326',
                            }
                        },
                "features": [],
            };

            // Boucle dans la liste
            for(var i = 0; i < list_communes.length; i++) {
                var element = list_communes[i];
                // Création de l'objet "Feature"
                var feature = {
                    "type": "Feature",
                    "geometry": {},
                    "properties": {}
                };
                for(var key in element) {
                    if(key == "geom") {
                        feature.geometry = JSON.parse(element[key]);
                        polygonMap=L.polygon(feature.geometry.coordinates).addTo(map)
                    }
                    else {
                        feature.properties[key] = element[key];
                    }
                }
                
                var count = 0;

                // Lorsque le feature est créé, ajout à la liste GeoJson
                geoJSON.features.push(feature);
            }
            // Retour du résultat
            return geoJSON;
        };


        /**
        * Fonction qui s'exécute pour chaque feature du geoJSON (permet d'afficher les infos popup lorsqu'on clique sur un feature)
        */
        function onEachFeature(feature, layer) {
            let popupContent = `<p>Nom : ${feature.properties.libelle_de_}</p>`;

            if (feature.properties) {
                popupContent += `<p>Departement: ${feature.properties.departement}</p>`;
                popupContent += `<p>Num commune: ${feature.properties.departement_1}</p>`;
                popupContent += `<p>Nb hotel: ${feature.properties.population_}</p>`;
            }

            layer.bindPopup(popupContent);
        };

        // Passage de la liste à la fonction pour création du GeoJson
        var list_communes_geojson = getGeoJSON(list_communes);

        var geoJ = L.geoJSON([list_communes_geojson], {
            onEachFeature,
        })
        
    </script>
</html>

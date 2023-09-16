<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" content="Lieux culturels IDF">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Ministère de la Culture - Lieux culturels en IDF</title>
        <link rel="icon" href="./img/marianne.ico" type="image/x-icon"/>

        <!-- jQuery -->
        <script defer src="js/jquery-3.6.3.min.js"></script>
        <script defer src="js/backToTop.js"></script>
        <link rel="stylesheet" href="css/backToTop.css"/>

        <!-- Boostrap CSS et js-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        
        <!-- Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        
        <!-- Utilisation du plugin Leaflet.PointInPolygon -->
        <script src="https://rawgit.com/hayeswise/Leaflet.PointInPolygon/master/wise-leaflet-pip.js"></script>

        <!-- FontAwesome -->
        <script defer src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>

        <style>
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
    	</style>

    </head>

    <body>
        <header>
            <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-success">
                
                <a 
                    href="https://www.culture.gouv.fr" 
                    class="navbar-brand fs-3 h1 mb-0">
                    <img src="./img/logo_ministere_culture.png" class="bg-white p-2 ms-2" width="100" height="70"
                    class = "d-inline-block my-auto"/>    
                    <span class="ms-2"> Carte des lieux cultures en IDF </span>
                </a>
                
                <button 
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    class="navbar-toggler"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>
                    
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a href="index.php" class="nav-link active text-warning">
                                Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main class="row justify-content-center" style="margin-top:110px;">
            <div id = "map" class="map p-10 col-auto">
                <?php
                    // Permet d'inclure le code php à la carte
                    include('./php-map/base-map.php');
                    include('./php-map/first-radio.php');
                    include('./php-map/second-radio.php');
                    include('./php-map/third-radio.php');
                    include('./php-map/last-radio.php');
                ?>
                
            </div>
            <!-- Boutons radios qui permettent de choisir une carte et appelle une fonction au click -->
            <fieldset class="col-auto">
                <legend>Choisissez ce que vous voulez afficher sur la carte :</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="cine" name="donnees" value="cine" onclick="firstRadio()">
                    <label class="form-check-label" for="cine">Afficher et zoomer sur les communes qui ont plus de 5 cinémas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="commerce" name="donnees" value="commerce" onclick="secondRadio()">
                    <label class="form-check-label" for="commerce">Afficher et zoomer sur les communes ayant moins de deux commerces</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="hotel" name="donnees" value="hotel" onclick="thirdRadio()">
                    <label class="form-check-label" for="hotel">Afficher les communes ayant plus de 20 hôtels</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="cine-hotel" name="donnees" value="cine-hotel" onclick="lastRadio()">
                    <label class="form-check-label" for="cine-hotel">Afficher les communes ayant moins de 15 hôtels et moins de 5 cinémas</label>
                </div>
            </fieldset>

        </main>
    </body>
</html>
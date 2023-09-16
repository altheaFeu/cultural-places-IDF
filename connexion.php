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

        <!-- JS pour la barre de recherche -->
        <script defer src="js/active-searchbar.js" type="text/javascript"></script>

        <!-- Bouton back to top et js pour les yeux -->
        <script defer src="js/backToTop.js"></script>
        <link rel="stylesheet" href="css/backToTop.css"/>
        <script defer src="js/eye.js"></script>

        <!-- Boostrap CSS et js-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            
        <!-- FontAwesome -->
        <script defer src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>

        <style>
            .link-search:hover{
                text-decoration:underline;
            }

            .inscription{
                text-decoration: none;
            }

            .inscription:hover{
                transform: scale(1.3);
                transition:transform .3s;
            }

            .button:hover{
                transform: scale(1.1);
                transition:transform .2s;
                font-weight:bold;
                border-color:green;
            }
        </style>

    </head>

    <body class="text-center d-flex justify-content-center">
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
                    
                
                <div class="collapse navbar-collapse justify-content-around" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a href="index.php" class="nav-link">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="connexion.php" class="nav-link text-warning active">
                                Connexion
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="consulter.php" class="nav-link">
                                Consulter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="infos.php" class="nav-link">
                                A propos
                            </a>
                        </li>
                    </ul>

                    <!-- Barre de recherche -->
                    <div id="searchUsers" class="pt-1 ">
                        <form action="connexion.php" method="POST" id="form-search form-inline" role="search" class="form-control bg-transparent border border-0">
                            <input id="searchBar" name="keyword" class="rounded px-2" type="text" placeholder="Recherchez..." aria-label="search" value="Recherchez" maxlength="25" autocompelte="off" onMouseDown="active();" onBlur="inactive();" spellcheck="true"/>
                            <button type="submit" name="envoyer" class="btn bg-transparent button-search pb-2">
                                <i class="fas fa-search text-white"></i>
                            </button>                                
                        </form>

                        <!-- Boîte de suggestions -->
                        <?php
                            require_once 'config.php'; 
                            if(isset($_POST['keyword'])){
                                $keyword = $_POST['keyword'];

                                $query = $bdd->prepare("SELECT * FROM recherche WHERE nom LIKE '%$keyword%' OR description LIKE '%$keyword%'");
    
                                $query->execute();
    
                                if ($query->rowCount() > 0) {
    
                                    echo '<div class="autocom-box flex-column bg-white p-2 ms-3" style="position:fixed; width:190px;">';
    
                                    while($row = $query->fetch()){
                                        $id = $row['id'];
                                        $nom = $row['nom'];
                                        $page = $row['page'];
                                        $description = $row['description'];
                                        echo '<p class="m-0"><a class = "link-search nav-link text-success" href="' . $page . '.php">' . $nom . '</a></p><p>' . $description . '</p><br>';
                                        
                                    };
                                    echo '</div>';
                                }   
                            }
                        ?>
                    </div>
                </div>
            </nav>

        </header>

        <main style="margin-top:110px;">
            <div class="boite-connexion">
                <!-- Permet de gérer les erreurs de connexion mais aussi les réussites d'inscription -->
                <?php
                    if(isset($_GET['login_err']))
                    {
                        $err = htmlspecialchars($_GET['login_err']);

                        switch($err)
                        {
                            case 'success':
                                ?>
                                    <div class="alert alert-success">
                                        <strong>Succès</strong> inscription réussie !
                                    </div>
                                <?php
                            break;  

                            case 'identifiant':
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Erreur</strong> Identifiant incorrect
                                    </div>
                                <?php
                            break;

                            case 'password':
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Erreur</strong> Mot de passe incorrect
                                </div>
                            <?php
                            break;
                        }
                    }
                ?>

                <div>
                    <form action="identification.php" method="post"> 
                        
                        <!-- Formulaire de connexion -->
                        <label class="mb-1" for="identifiant">ID : </label><br>
                        <input class="rounded px-1" type="text" name="identifiant" id="identifiant" pattern="[0-9]{5}" required/><br>
                        <label class="mb-1" for="password">Mot de passe : </label><br>
                        <input class="rounded px-1 s-2" style="width:170px" type="password" name="password" id="password" required/>
                        <i class="fas fa-eye pt-2 ps-2" id="eye"></i><br>
                        <button type="submit" class="button mt-3 mb-3 rounded bg-white ">Connexion</button>
                        
                    <p class="h2">OU</p>
                    <div class="inscription">
                        <a href="inscription.php" class="inscription link-dark hover-focus"><span>Inscrivez-vous !</span></a>
                    </div>
                </div>
            </div>
        </main>

    </body>
</html>
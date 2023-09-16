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

        <!-- JS pour la barre de recherche -->
        <script defer src="js/active-searchbar.js" type="text/javascript"></script>

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
        </style>

    </head>

    <body style="height: 1000px">
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
                            <a href="connexion.php" class="nav-link text-warning">
                                Connexion
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="consulter.php" class="nav-link">
                                Consulter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="infos.php" class="nav-link active">
                                A propos
                            </a>
                        </li>
                    </ul>

                    <!-- Barre de recherche -->
                    <div id="searchUsers" class="pt-1 ">
                        <form action="infos.php" method="POST" id="form-search form-inline" role="search" class="form-control bg-transparent border border-0">
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

        <main>
            <div class="bg-secondary" style="height: 500px; margin-top:90px;">
                <div style="margin-left:20px;">
                    <div class="text-white h1" style="padding-top:20px">Titre</div>
                    <p class="text-white">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
                </div>
            </div> 
        </main>
    </body>
</html>
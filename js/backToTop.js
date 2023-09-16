$(document).ready(function () {

    // Ajout du boutton
        if ($('#backToTopBtn').length == 0) {
            $('body').append('<button onclick="topFunction()" id="backToTopBtn" title="Vers le haut de la page"><i class="fas fa-arrow-up"></i></button>');
        }
    
        mybutton = document.getElementById("backToTopBtn");
    
    // Affichage du bouton
        window.onscroll = function () {
            scrollFunction()
        };
    });
    
    // Montre le bouton lorsque l'on descend de 20% de la page
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    
    // Va en haut de la page lorsque l'on clique sur le boutton
    function topFunction() {
        document.body.scrollTop = 0; // Pour Safari
        document.documentElement.scrollTop = 0; // Pour Chrome, Firefox, IE and Opera
    }
    
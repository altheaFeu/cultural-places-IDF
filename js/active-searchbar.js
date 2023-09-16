// Supprime le mot "Recherchez" quand l'utilisateur pointe dessus
function active(){
    var searchBar = document.getElementById('searchBar');
    if(searchBar.value == 'Recherchez'){
        searchBar.value = ''
        searchBar.placeholder = 'Recherchez'
    }
}
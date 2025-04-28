//Je vais en avoir besoin pour faire la gestion des évènements genre quand onmouseclicke sur le filtre on ajoute les divers filtres possibles

//Etape 1 : on get les id ou class ou tags necessaires
//Si on clique sur l'icone filter, alors on change le contenu de la page en dessous de la barre de recherche 

document.getElementsByClassName("filter").addEventListener("click", function() {
    document.getElementsByClassName().innerHTML = "";
});
function affichage() {
    var x = document.getElementById("profil");
    var y =document.getElementById("liste");
    if (x.style.display === "none") {
      x.style.display = "block";
      y.style.display = "none";
    } else {
      x.style.display = "none";
      y.style.display = "block"
    }
  }
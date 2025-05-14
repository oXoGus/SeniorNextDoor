function afficher() {
    var notifContainer = document.getElementById("notificationContainer");

    if (notifContainer.style.display === "none") {
      notifContainer.style.display = "flex";
    } else {
      notifContainer.style.display = "none";
    }
  }
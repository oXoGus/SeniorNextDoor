
var message_box = document.querySelector('.message_box');
setInterval(function () {
  var urlParams = new URLSearchParams(window.location.search);
  var idAmi = urlParams.get('idAmi') || 1;
  var xhttp = new XMLHttpRequest()
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      message_box.innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/SeniorNextDoor/ajax/actualisationMsg.php?idAmi=" + idAmi, true);
  xhttp.send();
}, 500);
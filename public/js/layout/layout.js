
var mapOptions = {
    center: new google.maps.LatLng(20.9978058, 105.8055),
    zoom: 15,
}
var map = new google.maps.Map(document.getElementById("map"), mapOptions);

var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
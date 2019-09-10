<input type="hidden" name="" value="<?=$model->shipping_address?>" id="start">
<input type="hidden" name="" id="end" value="<?=$model->delivery_address?>">
<script>
  function initMap() {
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: {lat: 41.85, lng: -87.65}
    });
    directionsRenderer.setMap(map);
    calculateAndDisplayRoute(directionsService, directionsRenderer);
   
  }

  function calculateAndDisplayRoute(directionsService, directionsRenderer) {
    directionsService.route(
        {
          origin: {query: document.getElementById('start').value},
          destination: {query: document.getElementById('end').value},
          travelMode: 'DRIVING'
        },
        function(response, status) {
          if (status === 'OK') {
            directionsRenderer.setDirections(response);
            var bounds = new google.maps.LatLngBounds;
            var markersArray = [];
            var origin1 = document.getElementById('start').value;
            var destinationA = document.getElementById('end').value;
            
            var geocoder = new google.maps.Geocoder;

            var service = new google.maps.DistanceMatrixService;
            service.getDistanceMatrix({
              origins: [origin1],
              destinations: [destinationA],
              travelMode: 'DRIVING',
              unitSystem: google.maps.UnitSystem.METRIC,
              avoidHighways: false,
              avoidTolls: false
            }, function(response, status) {
              if (status !== 'OK') {
                alert('Error was: ' + status);
              } else {
                var originList = response.originAddresses;
                var destinationList = response.destinationAddresses;
                var time = document.getElementById('time');
                time.innerHTML = '';
                var destination = document.getElementById('destination');
                destination.innerHTML = '';
                
                deleteMarkers(markersArray);
                for (var i = 0; i < originList.length; i++) {
                  var results = response.rows[i].elements;
                for (var j = 0; j < results.length; j++) {
                      time.innerHTML += results[j].duration.text;
                      destination.innerHTML += results[j].distance.text;
                  }
                }
               }
            });
          
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
  }
  function deleteMarkers(markersArray) {
    for (var i = 0; i < markersArray.length; i++) {
      markersArray[i].setMap(null);
    }
    markersArray = [];
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAIUZfJr01SrsKER6zBPwBcmPNy0rfXPc&callback=initMap">
</script>

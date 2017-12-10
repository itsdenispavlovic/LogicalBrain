<!--Footer.php -->
    <!--This is for the GEOLOCATION -->
    <script type="text/javascript">
    var marker = null;
    function initMap() {
      var mapCanvas = document.getElementById("map");
      var myCenter=new google.maps.LatLng(51.508742,-0.120850);
      var mapOptions = {center: myCenter, zoom: 5};
      var map = new google.maps.Map(mapCanvas, mapOptions);
      google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(map, event.latLng);
      });
    }
    var latlng = <?php echo json_encode($loc);?>;
    window.eqfeed_callback = function(results) {
        for (var i = 0; i < results.features.length; i++) {
          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1],coords[0]);
          var marker = new google.maps.Marker({
            position: latlng,
            map: map
          });
        }
      }

    function placeMarker(map, location) {
      if(marker != null) {
        marker.setMap(null);
      }
        marker = new google.maps.Marker({
        position: location,
        map: map
      });
      var infowindow = new google.maps.InfoWindow({
        content: 'Lat: ' + location.lat() + ' Lng: ' + location.lng()
      });
      infowindow.open(map,marker);
      var dr = document.getElementById("coordation");
      dr.value = 'Lat: ' + location.lat() + ' Lng: ' + location.lng() ;
    }






    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</div> <!--End Container -->
  </body>
</html>
<!--End Footer-->

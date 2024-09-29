<!DOCTYPE html>
<html>
  <head>
    <title>Real-time GPS Tracker</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqm58SgYCVN-CdOxefv0BPG_PTJ75yINM"></script>
    <style>
      #map {
        height: 100vh;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      let map, marker;

      function initMap() {
        // Initialize the map with a default location (centered at a random point)
        const defaultLocation = { lat: 14.5995, lng: 120.9842 }; // Manila, Philippines

        map = new google.maps.Map(document.getElementById("map"), {
          center: defaultLocation,
          zoom: 14,
        });

        marker = new google.maps.Marker({
          position: defaultLocation,
          map: map,
        });

        // Get the user's current location and track their movements
        if (navigator.geolocation) {
          navigator.geolocation.watchPosition(
            (position) => {
              const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
              };

              // Update the map and marker positions
              map.setCenter(pos);
              marker.setPosition(pos);
            },
            () => {
              handleLocationError(true, map.getCenter());
            }
          );
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, pos) {
        const infoWindow = new google.maps.InfoWindow();
        infoWindow.setPosition(pos);
        infoWindow.setContent(
          browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
      }

      window.onload = initMap;
    </script>
  </body>
</html>

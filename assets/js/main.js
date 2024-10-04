var map = L.map('map').setView([51.505, -0.09], 13);

// Add base map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
}).addTo(map);

var pointsLayer = L.layerGroup().addTo(map);
var polygonsLayer = L.layerGroup().addTo(map);

var overlayMaps = {
    "Points": pointsLayer,
    "Polygons": polygonsLayer
};

L.control.layers(null, overlayMaps).addTo(map);

// Fetch points and add to map
fetch('../public/get_points.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(point => {
            var latlng = JSON.parse(point.geom).coordinates.reverse();
            L.marker(latlng)
              .bindPopup(`<b>${point.name}</b><br>${point.description}`)
              .addTo(pointsLayer);
        });
    })
    .catch(err => console.log('Error fetching points:', err));

// Fetch polygons and add to map
fetch('../public/get_polygons.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(polygon => {
            var coords = JSON.parse(polygon.geom).coordinates[0].map(coord => coord.reverse());
            L.polygon(coords)
              .bindPopup(`<b>${polygon.name}</b><br>${polygon.description}`)
              .addTo(polygonsLayer);
        });
    })
    .catch(err => console.log('Error fetching polygons:', err));

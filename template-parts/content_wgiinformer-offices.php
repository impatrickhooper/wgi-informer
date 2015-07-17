<?php
/**
 * The template part for displaying the Offices page.
 *
 * @package WGI Informer
 */
?>

<div class="wrapper wrapper-offices">
  <div id="offices">
    <div id='map'></div><!-- #map -->
    <form id='divisions'>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='all' id="divisions_all" checked>
        <label for="divisions_all">All</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='civil' id="divisions_civil">
        <label for="divisions_civil">Civil</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='creative' id="divisions_creative">
        <label for="divisions_creative">Creative</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='environmental' id="divisions_environmental">
        <label for="divisions_environmental">Environmental</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='landscape-architecture' id="divisions_landscape-architecture">
        <label for="divisions_landscape-architecture">Landscape Architecture</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='planning' id="divisions_planning">
        <label for="divisions_planning">Planning</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='roadway' id="divisions_roadway">
        <label for="divisions_roadway">Roadway</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='structures' id="divisions_structures">
        <label for="divisions_structures">Structures</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='sue' id="divisions_sue">
        <label for="divisions_sue">SUE</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='survey' id="divisions_survey">
        <label for="divisions_survey">Survey</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='transportation-planning' id="divisions_transportation-planning">
        <label for="divisions_transportation-planning">Transportation Planning</label>
      </p>
      <p>
        <input type='radio' name='filters' onclick='filterDivisions();' value='utilities' id="divisions_utilities">
        <label for="divisions_utilities">Utilities</label>
      </p>
    </form><!-- #divisions -->

    <script>
      /* Enter the access token */
      L.mapbox.accessToken = 'pk.eyJ1Ijoid2FudG1hbmdyb3VwIiwiYSI6IjA1MTdmNjJkMDc0ZWI4Yzg5OWJhNmZhZjI3ZTVhNGJiIn0.Sl42UTfQRFpsIv2Bc6As8g';

      /* Intialize the map with a "pencil" background style */
      var map = L.mapbox.map('map')
        .addLayer(L.mapbox.tileLayer('mapbox.pencil'));
      var overlays = L.layerGroup().addTo(map);
      var layers;

      /* Load data from the geojson file in the theme /data folder */
      var featureLayer = L.mapbox.featureLayer()
        .loadURL('<?php echo get_stylesheet_directory_uri() . "/data/wgi.geojson"; ?>');

      /* When the map is ready, auto fit it to the window bounds */
      featureLayer.on('ready', function(e) {
        map.fitBounds(featureLayer.getBounds());
        layers = e.target;
        filterDivisions();
      });

      /* Get radio button filters */
      var filters = document.getElementById('divisions').filters;

      /* Loop through the filter values and show marked only with the checked division value */
      function filterDivisions() {
        var list;
        for (var i = 0; i < filters.length; i++) {
          if (filters[i].checked) {
            list = filters[i].value
            break;
          }
        }
        overlays.clearLayers();

        /* Turn on clustering for locations near to each other */
        var clusterGroup = new L.MarkerClusterGroup().addTo(overlays);
        layers.eachLayer(function(layer) {
          if (list === 'all') {
            clusterGroup.addLayer(layer);
          }
          else {
            var divisions = layer.feature.properties.divisions;
            if (divisions.indexOf(list) !== -1) {
              clusterGroup.addLayer(layer);
            }
          }
        });
      }
    </script>
  </div><!-- #offices -->
</div><!-- .wrapper.wrapper-offices -->

<?php
require "config.php";

$city = $_REQUEST['city'] ?? 'edinburgh';


// prepare for javascript
$placesJson = json_encode($cities[$city]['places']);
$coordJson = json_encode($cities[$city]['coord']);

// Current Weather
$url = $cities[$city]['current_weather'];
$array = convertDataToArray($url, 'xml');
$name = $array['city']['@attributes']['name'];
$condition = $array['clouds']['@attributes']['name'];
$temperature = $array['temperature']['@attributes']['value'];
$windSpeed = $array['wind']['speed']['@attributes']['value'];
$windDisc = $array['wind']['speed']['@attributes']['name'];
$windDirec = $array['wind']['direction']['@attributes']['name'];
$humidity = $array['humidity']['@attributes']['value'];
$pressure = $array['pressure']['@attributes']['value'];
$sunrise = (new DateTime($array['city']['sun']['@attributes']['rise']))->format('H:i:s');
$sunset = (new DateTime($array['city']['sun']['@attributes']['set']))->format('H:i:s');

// Forecast
$url = $cities[$city]['forecast'];
$forecastArray = convertDataToArray($url, 'xml');
$forecasts = $forecastArray['forecast']['time'];

$i = 1;
foreach ($forecasts as $forecast) {
    $cloudType = $forecast['clouds']['@attributes']['value'];
    $forecastData[$i] = [
        'windspeed' => $forecast['windSpeed']['@attributes']['mps'],
        'temperature' => $forecast['temperature']['@attributes']['value'],
        'description' => $cloudType,
        'icon' => generateWeatherIcon($cloudType)
    ];
    $i++;
}
// good to know formatting for date:(new DateTime($date))->format('d/m/Y')

//rename images to not have spaces
function generateWeatherIcon($cloudType = null)
{
    switch ($cloudType) {
        case 'broken clouds':
            $result = 'fa-cloud';
            break;
        case 'overcast clouds':
            $result = 'fa-cloud';
            break;
        case 'light rain':
            $result = 'fa-cloud-rain';
            break;
        case 'scattered clouds':
            $result = 'fa-cloud';
            break;
        case 'light snow':
            $result = 'fa-snowflake';
            break;
        case 'clear sky':
            $result = 'fa-sun';
            break;
        case 'few clouds':
            $result = 'fa-cloud';
            break;
        case 'snow':
            $result = 'fa-snowflake';
            break;
        case 'heavy rain':
            $result = 'fa-cloud-showers-heavy';
            break;
        default:
            $result = 'fa-ban';
    }
    return $result;
}
?>

<div class="row">
    <div class="col-md-12">
        <h1><?php echo ucfirst($city); ?></h1>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Map</div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Weather Conditions</div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Condition:</td>
                            <td>
                                <?= $condition ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Temperature:</td>
                            <td>
                                <?php echo $temperature ?> °C
                            </td>
                        </tr>
                        <tr>
                            <td>Wind:</td>
                            <td>
                                <?php echo $windSpeed . " m/s (" . $windDisc . ") from a " . $windDirec . " direction" ?>
                                <!--different way of doing this^ <?= $windSpeed ?> m/s (<?= $windDisc ?>) from a <?= $windDirec ?> direction -->
                            </td>
                        </tr>
                        <tr>
                            <td>Humidity:</td>
                            <td>
                                <?php echo $humidity ?>%
                            </td>
                        </tr>
                        <tr>
                            <td>Pressure:</td>
                            <td>
                                <?php echo $pressure ?> hPa
                            </td>
                        </tr>
                        <tr>
                            <td>Sunrise:</td>
                            <td>
                                <?php echo $sunrise ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sunset:</td>
                            <td>
                                <?php echo $sunset ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <tr>
                        <?php
                        foreach ($forecastData as $day => $forecast) {
                            echo '<td>';

                            echo '<i class="fa-3x fa-solid ' . $forecast['icon'] . '"></i><br />';
                            echo $forecast['windspeed'] . "m/s" . '<br />';
                            echo $forecast['temperature'] . "°C" . '<br />';
                            echo '</td>';
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    const GoogAPI = "<?php echo G_MAPS_API ?>";
    function initMap() {
        // Map Options
        let options = {
            zoom: 13,
            center: <?php echo $coordJson; ?>,
            mapTypeControlOptions: {
                mapTypeIds: 'roadmap'
            }
        }
        // New Map instance
        var map = new google.maps.Map(document.getElementById('map'), options);
        var places = <?php echo $placesJson; ?>;
        // Loop through markers - ables to amend array of POI
        for (var i = 0; i < places.length; i++) {
            // Adding a marker
            addMarker(places[i]);
        };

        // Add Marker Function
        function addMarker(place) {
            var myLatLng = new google.maps.LatLng(place[1], place[2]);
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: place[0],
                url: place[4]
                // (Change Icon instead of red pin if desired) icon:''
            });
            //Check content (ensuring no undefined variable)
            if (place[3]) {
                var infoWindow = new google.maps.InfoWindow({
                    content: place[3],
                    width: 1000,
                });
                marker.addListener('mouseover', () => infoWindow.open(map, marker))
                marker.addListener('mouseout', () => infoWindow.close())
                marker.addListener('click', function() {
                    window.location.href = this.url;
                });
            }
        }
    }
</script>
<!-- <script src="js/googleMap.js"> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpUaGxwCjLH3xVvnv1OoDX_qtDbKjDQ8c&callback=initMap&v=weekly" defer></script>
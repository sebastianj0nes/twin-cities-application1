<?php
//hi
// Declare Namespace 
namespace TwinCitiesApplication;
// Declare timezone (set)
@date_default_timezone_set("GMT");

// Define API keys
    // OpenWeather API 
define("OW_API","e690348f0ace576d480ab186b2be68aa");
    // Google Maps API
define("G_MAPS_API","AIzaSyBpUaGxwCjLH3xVvnv1OoDX_qtDbKjDQ8c");

// Cities constant to hold relevant info on Edinburgh and Munich
$cities = [
    // Edinburgh Array
    'edinburgh' => [
        // Co-ordinates 
        'coord' => ['lat' => 55.954251, 'lng' => -3.19267],
        // Current weather url for API key
        'current_weather' => 'http://api.openweathermap.org/data/2.5/weather?lat=55.953251&lon=-3.188267&mode=xml&units=metric&appid=' . OW_API ,
        // Forecast weather url for API key
        'forecast' => 'http://api.openweathermap.org/data/2.5/forecast?lat=55.953251&lon=-3.188267&mode=xml&units=metric&appid=' . OW_API . '&cnt=7',
        // Places array to hold markers for the map
        'places' => [
            ['Edinburgh Castle', 55.948612, -3.200833, '<center><h3>Edinburgh Castle</h3><body>Edinburgh Castle is a historic castle in Edinburgh, Scotland. It stands on Castle Rock, which has been occupied by humans since at least the Iron Age, although the nature of the early settlement is unclear.</center>', 'index.php?p=places&poi=1'],
            ['National Museum of Scotland', 55.947519, -3.190422, '<center><h3>National Museum of Scotland</h3>The National Museum of Scotland in Edinburgh, Scotland, was formed in 2006 with the merger of the new Museum of Scotland, with collections relating to Scottish antiquities, culture and history.</center>', 'index.php?p=places&poi=2'],
            ['Royal Botanic Garden Edinburgh', 55.965286, -3.209155, '<center><h3>Royal Botanic Garden Edinburgh</h3>The Royal Botanic Garden Edinburgh is a scientific centre for the study of plants, their diversity and conservation, as well as a popular tourist attraction.</center>', 'index.php?p=places&poi=3'],
            ['Palace of Holyroodhouse', 55.953905, -3.171916, '<center><h3>Palace of Holyroodhouse</h3>The Palace of Holyroodhouse, commonly referred to as Holyrood Palace or Holyroodhouse, is the official residence of the British monarch in Scotland.</center>', 'index.php?p=places&poi=4'],
            ['Scottish National Gallery of Modern Art', 55.951983, -3.228049, '<center><h3>Scottish National Gallery of Modern Art</h3>The Scottish National Gallery is the national art gallery of Scotland. It is located on The Mound in central Edinburgh, close to Princes Street. The building was designed in a neoclassical style by William Henry Playfair, and first opened to the public in 1859.</center>', 'index.php?p=places&poi=5']
        ]
    ],
    // Munich Array
    'munich' => [
        'coord' => ['lat' => 48.158132, 'lng' => 11.560550],
        'current_weather' => 'http://api.openweathermap.org/data/2.5/weather?lat=48.135124&lon=11.581981&mode=xml&units=metric&appid=' . OW_API ,
        'forecast' => 'http://api.openweathermap.org/data/2.5/forecast?lat=48.135124&lon=11.581981&mode=xml&appid=' . OW_API .'&cnt=7',
        'places' => [
            ['Marienplatz', 48.13744, 11.57545, '<center><h3>Marienplatz</h3><body>Edinburgh Castle is a historic castle in Edinburgh, Scotland. It stands on Castle Rock, which has been occupied by humans since at least the Iron Age, although the nature of the early settlement is unclear.</center>', 'index.php?p=places&poi=6'],
            ['English Garden Munich', 48.16428, 11.60552, '<center><h3>English Garden Munich</h3>The National Museum of Scotland in Edinburgh, Scotland, was formed in 2006 with the merger of the new Museum of Scotland, with collections relating to Scottish antiquities, culture and history.</center>', 'index.php?p=places&poi=7'],
            ['Nymphenburg Palace', 48.15833, 11.50372, '<center><h3>Nymphenburg Palace</h3>The Royal Botanic Garden Edinburgh is a scientific centre for the study of plants, their diversity and conservation, as well as a popular tourist attraction.</center>', 'index.php?p=places&poi=8'],
            ['Asamkirche', 48.13526, 11.56968, '<center><h3>Asamkirche</h3>The Palace of Holyroodhouse, commonly referred to as Holyrood Palace or Holyroodhouse, is the official residence of the British monarch in Scotland.</center>', 'index.php?p=places&poi=9'],
            ['Olympiapark', 48.17554, 11.55179, '<center><h3>Olympiapark</h3>The Scottish National Gallery is the national art gallery of Scotland. It is located on The Mound in central Edinburgh, close to Princes Street. The building was designed in a neoclassical style by William Henry Playfair, and first opened to the public in 1859.</center>', 'index.php?p=places&poi=10']
        ]
    ],
];

// Error handler
function twinErrorHandler(int $errNo, string $errMsg, string $file, int $line){
    echo "Twin Cities Application error handler got #[$errNo] occurred in [$file] at line [$line]: [$errMsg]";
};

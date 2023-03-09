<?php
// Declare Namespace 
namespace TwinCitiesApplication;
// Declare timezone (set)
@date_default_timezone_set("GMT");

// Define API keys
    // OpenWeather API 
define("OW_API","e690348f0ace576d480ab186b2be68aa");
    // Google Maps API
define("G_MAPS_API","AIzaSyBpUaGxwCjLH3xVvnv1OoDX_qtDbKjDQ8c");

// Define database constants to make a connection
define ('DBMS', [
    'HOST' => 'localhost',
    'DB' => 'twin_cities',
    'UN' => 'root',
    'PW' => ''
]);

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
            ['Scottish National Gallery of Modern Art', 55.951983, -3.228049, '<center><h3>Scottish National Gallery of Modern Art</h3>The Scottish National Gallery is the national art gallery of Scotland. It is located on The Mound in central Edinburgh, close to Princes Street. The building was designed in a neoclassical style by William Henry Playfair, and first opened to the public in 1859.</center>', 'index.php?p=places&poi=5'],
            ['The Scotch Whiskey Experience', 55.94875, -3.195815, '<center><h3>The Scotch Whisky Experience</h3>The Scotch Whiskey Experience is a whisky visitor attraction located on Castlehill in the Old Town of Edinburgh, immediately adjacent to the esplanade of Edinburgh Castle. The centre offers tours and whisky tutoring sessions, alongside a shop, corporate spaces and Amber Restaurant & Whisky Bar.</center>', 'index.php?p=places&poi=5']
        ]
    ],
    // Munich Array
    'munich' => [
        'coord' => ['lat' => 48.158132, 'lng' => 11.560550],
        'current_weather' => 'http://api.openweathermap.org/data/2.5/weather?lat=48.135124&lon=11.581981&mode=xml&units=metric&appid=' . OW_API ,
        'forecast' => 'http://api.openweathermap.org/data/2.5/forecast?lat=48.135124&lon=11.581981&mode=xml&units=metric&appid=' . OW_API .'&cnt=7',
        'places' => [
            ['Marienplatz', 48.13744, 11.57545, '<center><h3>Marienplatz</h3><body>Marienplatz (English: Marys Square, i.e. St. Mary, Our Ladys Square) is a central square in the city centre of Munich, Germany. It has been the citys main square since 1158.</center>', 'index.php?p=places&poi=7'],
            ['English Garden Munich', 48.16428, 11.60552, '<center><h3>English Garden Munich</h3>The Englischer Garten (English Garden) is a large public park in the centre of Munich, Bavaria, stretching from the city centre to the northeastern city limits. It was created in 1789 by Sir Benjamin Thompson (1753-1814), later Count Rumford (Reichsgraf von Rumford), for Prince Charles Theodore, Elector of Bavaria. Thompsons successors, Reinhard von Werneck (1757-1842) and Friedrich Ludwig von Sckell (1750-1823), advisers on the project from its beginning, both extended and improved the park. With an area of 3.7 km2 (1.4 sq mi) (370 ha or 910 acres), the Englischer Garten is one of the worlds largest urban public parks. The name refers to its English garden form of informal landscape, a style popular in England from the mid-18th century to the early 19th century and particularly associated with Capability Brown.</center>', 'index.php?p=places&poi=8'],
            ['Nymphenburg Palace', 48.15833, 11.50372, '<center><h3>Nymphenburg Palace</h3>The Nymphenburg Palace is a Baroque palace situated in Munichs western district Neuhausen-Nymphenburg, in Bavaria, southern Germany. Combined with the adjacent Nymphenburg Palace Park it constitutes one of the premier royal palaces of Europe. Its frontal width of 632 m (2,073 ft) (north-south axis) even surpasses Versailles Palace. The Nymphenburg served as the main summer residence for the former rulers of Bavaria of the House of Wittelsbach.</center>', 'index.php?p=places&poi=9'],
            ['Asamkirche', 48.13526, 11.56968, '<center><h3>Asamkirche</h3>St. Johann Nepomuk, better known as the Asam Church, is a Baroque church in Munich, southern Germany. It was built from 1733 to 1746 by a pair of brothers, sculptor Egid Quirin Asam and painter Cosmas Damian Asam, as their private church. It is considered to be one of the most important buildings of the southern German Late Baroque.</center>', 'index.php?p=places&poi=10'],
            ['Olympiapark', 48.17554, 11.55179, '<center><h3>Olympiapark</h3>The Olympiapark in Munich, Germany, is an Olympic Park which was constructed for the 1972 Summer Olympics. Located in the Oberwiesenfeld neighborhood of Munich, the Park continues to serve as a venue for cultural, social, and religious events, such as events of worship. It includes a contemporary carillon.</center>', 'index.php?p=places&poi=11'],
            ['BMW Museum', 48.176907, 11.559360, '<center><h3>The BMW Museum</h3>The BMW Museum is an automobile museum of BMW history located near the Olympiapark in Munich, Germany. The museum was established in 1973, shortly after the Summer Olympics opened. From 2004 to 2008, it was renovated in connection with the construction of the BMW Welt, directly opposite. The museum reopened on 21 June 2008. At the moment the exhibition space is 5,000 square metres for the presentation of about 120 exhibits.</center>', 'index.php?p=places&poi=12']
        ]
    ],
];

// Error handler
function twinErrorHandler(int $errNo, string $errMsg, string $file, int $line){
    echo "Twin Cities Application error handler got #[$errNo] occurred in [$file] at line [$line]: [$errMsg]";
};
?>
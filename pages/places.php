<?php
echo '<pre>';
echo get_photo('edinburgh', 10);
echo '</pre>';


$place_id = $_GET['poi'];

//maybe combine this with the nested arrays in the cities.php so all the information is together rather than 2 half arrays
$database = [
    1 => [
        'id' => '1',
        'name' => 'Edinburgh Castle',
        'address1' => 'Castlehill',
        'address2' => 'Edinburgh',
        'postcode' => 'EH1 2NG',
        'lat' => '55.948612',
        'long' => '-3.200833',
        'date_established' => '1103',
        'description' => "Edinburgh Castle is a historic castle in Edinburgh, Scotland. It stands on Castle Rock, which has been occupied by humans since at least the Iron Age, although the nature of the early settlement is unclear. There has been a royal castle on the rock since at least the reign of David I in the 12th century, and the site continued to be a royal residence until 1633. From the 15th century, the castle's residential role declined, and by the 17th century it was principally used as military barracks with a large garrison. Its importance as a part of Scotland's national heritage was recognised increasingly from the early 19th century onwards, and various restoration programmes have been carried out over the past century and a half.",
        'capacity' => '1000',
        'website' => 'https://www.edinburghcastle.scot',
        'wiki_page' => 'https://en.wikipedia.org/wiki/Edinburgh_Castle',
        'icon' => 'bi bi-building',
    ],
    2 => [
        'id' => '2',
        'name' => 'National Museum of Scotland',
    ],
    3 => [
        'id' => '3',
        'name' => 'Royal Botanic Garden Edinburgh',
    ],
    4 => [
        'id' => '4',
        'name' => 'Palace of Holyroodhouse',
    ],
    5 => [
        'id' => '5',
        'name' => 'Scottish National Gallery of Modern Art',
    ],
    6 => [
        'id' => '6',
        'name' => 'Marienplatz',
    ],
    7 => [
        'id' => '7',
        'name' => 'English Garden Munich',
    ],
    8 => [
        'id' => '8',
        'name' => 'Nymphenburg Palace',
    ],
    9 => [
        'id' => '9',
        'name' => 'Asamkirche',
    ],
    10 => [
        'id' => '10',
        'name' => 'Olympiapark',
    ],


];


if (array_key_exists($place_id, $database)) {
    $place = $database[$place_id];
} else {
    echo 'This place does not exist in our database';
    die();
}

var_dump($place);
?>
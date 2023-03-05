<?php

// Import config file
require "config.php";

// // Set up connection to database
$pdo = new PDO('mysql:host='.DBMS['HOST'].';dbname='.DBMS['DB'], DBMS['UN'], DBMS['PW'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


// MUNICH
// Formulate the SQL for city and run it
$munCitySQL = 'SELECT * FROM `city` WHERE id="2"';
$munCityQuery = $pdo->prepare($munCitySQL);
$munCityQuery->execute();
# store all the results in an array
$mun_city_rss = $munCityQuery->fetchAll();

// Formulate the SQL for poi and run it
$mun_poi_SQL = 'SELECT * FROM `place_of_interest` WHERE city_id="2"';
$mun_poi_query = $pdo->prepare($mun_poi_SQL);
$mun_poi_query->execute();
$mun_poi_rss = $mun_poi_query->fetchAll();

// Formulate the SQL for location type and run it
$loc_typeSQL = 'SELECT * FROM `location_type`';
$loc_typeQuery = $pdo->prepare($loc_typeSQL);
$loc_typeQuery->execute();
$l_type_rss = $loc_typeQuery->fetchAll();


// Initiate writer for xml format
$writer = new XMLWriter();

# output directly to browser
$writer->openURI('php://output');

# start the document
$writer->startDocument('1.0');
$writer->setIndent(4);

// Start RSS Feed with elements
$writer->startElement('rss');  						
$writer->writeAttribute('version', '2.0');
$writer->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
$writer->startElement("channel");					
$writer->writeElement('title', 'Quotes from our database about our twin-cities, Edinburgh & Munich');
$writer->writeElement('description', 'This pulls the most up to date information from our database.');

// Loop through all rss feed
foreach ($mun_city_rss as $item) {
	#----------------------------------------------------
 
	$writer->startElement("city");					
	$writer->writeElement('title','ID:'. $item['id'] . PHP_EOL . '  City: ' . $item['name']);
	$writer->writeElement("coordinates", 'Lat: ' . $item['lat'] . PHP_EOL . ' & Lon: ' . $item['lon']);
	$writer->writeElement("description", 'Population: ' . $item['population'] . PHP_EOL . ' Country: ' . $item['country']);
	$writer->writeElement("wiki", 'Wiki link: ' . $item['wiki']);
	$writer->writeElement("events", 'Famous events: ' . $item['events']);
	
	// 
   #----------------------------------------------------
}

// Edinburgh POI RSS Items
$writer->startElement("POIs");						
foreach ($mun_poi_rss as $item){
	$writer->startElement("place_of_interest");		
	$writer->writeElement("name", "ID: ". $item['id'] ." Name: " . $item['name']);
	$writer->writeElement("coordinates", 'Lat: ' . $item['lat'] . " Lon: " . $item['lon']);
	$writer->writeElement("established", "Established in: " . $item['established']);
	// $writer->writeElement("description", "Description: " . $item['description']);
	$writer->writeElement("capacity", "Capacity: " . $item['capacity']);
	$writer->writeElement("websites", "Wiki: " . $item['wiki'] . " Website: " . $item['website']);
	$writer->writeElement("address", "Line 1: " . $item['address_line1'] . " Line 2: " . $item['address_line2'] . " Postcode: " . $item['postcode']);
	$writer->writeElement("ids", "City id: " . $item['city_id'] . " Location Type ID: " . $item['l_type_id']);
	$writer->endElement();		 // End place_of_interest individual element					
}
$writer->endElement();			// End POIs group element		

$writer->endElement();

// Location type RSS Items
$writer->startElement("location_type");
foreach ($l_type_rss as $item) {
	$writer->writeElement("id", "ID:" . $item['id'] . " matches with " . $item['l_type']);
}	
$writer->endElement();


$writer->endElement();
$writer->endElement();


$writer->endDocument();

header('Content-Type: text/xml'); 

# send the output to the browser
$writer->flush();
?>
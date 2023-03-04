<?php

// Require config file
require "config.php";

// Create php data object using DBMS variables from config.php
$pdo = new PDO('mysql:host='.DBMS['HOST'].';dbname='.DBMS['DB'], DBMS['UN'], DBMS['PW'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

// Formulate the SQL for city and run it
$citySql = 'SELECT * FROM `city` WHERE id="1" ';
$cityQuery = $pdo->prepare($citySql);
$cityQuery->execute();
# store all the results in an array
$city_rss = $cityQuery->fetchAll();

// Formulate the SQL for poi and run it
$poiSQL = 'SELECT * FROM `place_of_interest` WHERE city_id="1"';
$poiQuery = $pdo->prepare($poiSQL);
$poiQuery->execute();
$poi_rss = $poiQuery->fetchAll();

// Formulate the SQL for location type and run it
$loc_typeSQL = 'SELECT * FROM `location_type`';
$loc_typeQuery = $pdo->prepare($loc_typeSQL);
$loc_typeQuery->execute();
$l_type_rss = $loc_typeQuery->fetchAll();

# crete a new writer object
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

// City RSS Items
foreach ($city_rss as $item) {
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

$writer->startElement("POIs");						
// POI RSS Items
foreach ($poi_rss as $item){
	$writer->startElement("place_of_interest");		
	$writer->writeElement("name", "ID: ". $item['id'] ." Name: " . $item['name']);
	$writer->writeElement("coordinates", 'Lat: ' . $item['lat'] . " Lon: " . $item['lon']);
	$writer->writeElement("established", "Established in: " . $item['established']);
	// $writer->writeElement("description", "Description: " . $item['description']);
	$writer->writeElement("capacity", "Capacity: " . $item['capacity']);
	$writer->writeElement("websites", "Wiki: " . $item['wiki'] . " Website: " . $item['website']);
	$writer->writeElement("address", "Line 1: " . $item['address_line1'] . " Line 2: " . $item['address_line2'] . " Postcode: " . $item['postcode']);
	$writer->writeElement("ids", "City id: " . $item['city_id'] . " Location Type ID: " . $item['l_type_id']);
	$writer->endElement();		 // End POI Element					
}

$writer->endElement();								


$writer->startElement("location_type");
foreach ($l_type_rss as $item) {
	$writer->writeElement("id", "ID:" . $item['id'] . " matches with " . $item['l_type']);
}	
$writer->endElement();

// Set up images for when image data is found
$writer->startElement("images");
$writer->endElement();

// 
$writer->endElement();

# end channel
$writer->endElement();

# end rss
$writer->endElement();

$writer->endDocument();

header('Content-Type: text/xml'); 

# send the output to the browser
$writer->flush();
?>
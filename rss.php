<?php

// Require config file
require "config.php";

// Create php data object using DBMS variables from config.php
$pdo = new PDO('mysql:host='.DBMS['HOST'].';dbname='.DBMS['DB'], DBMS['UN'], DBMS['PW'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

// EDINBURGH
// Formulate the SQL for city and run it
$edinCitySQL = 'SELECT * FROM `city` WHERE id="1" ';
$edinCityQuery = $pdo->prepare($edinCitySQL);
$edinCityQuery->execute();
# store all the results in an array
$edin_city_rss = $edinCityQuery->fetchAll();

// Formulate the SQL for poi and run it
$edin_poi_sql = 'SELECT * FROM `place_of_interest` WHERE city_id="1"';
$edin_poi_query = $pdo->prepare($edin_poi_sql);
$edin_poi_query->execute();
$edin_poi_rss = $edin_poi_query->fetchAll();

// Formulate the SQL for location type and run it
$loc_typeSQL = 'SELECT * FROM `location_type`';
$loc_typeQuery = $pdo->prepare($loc_typeSQL);
$loc_typeQuery->execute();
$l_type_rss = $loc_typeQuery->fetchAll();

// Formulate the SQL for image and run it
$imgSQL = 'SELECT * FROM `image` WHERE city_id="1"';
$imgQuery = $pdo->prepare($imgSQL);
$imgQuery->execute();
$imgRSS = $imgQuery->fetchAll();


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
$writer->writeElement('title', 'Quotes from our database about our twin-cities, Edinburgh and Munich');
$writer->writeElement('description', 'This pulls the most up to date information from our database.');
$writer->writeElement('link', 'http://localhost/quotes/?qid=new');
// EDINBURGH
// Edinburgh City RSS Items
foreach ($edin_city_rss as $item) {
	#----------------------------------------------------
 
	$writer->startElement("item");					
	$writer->writeElement('title','ID:'. $item['id'] . PHP_EOL . '  City: ' . $item['name']);
	$writer->writeElement("description", 'Lat: ' . $item['lat'] . PHP_EOL . ' and Lon: ' . $item['lon'] . ', Population:' . $item['population'] . PHP_EOL . ', Country: ' . $item['country'] .', Famous events: ' . $item['events']);
	$writer->writeElement('link', 'http://localhost/quotes/?qid=' . 1);
	$writer->endElement();
	
	// 
   #----------------------------------------------------
}

// Edinburgh POI RSS Items
foreach ($edin_poi_rss as $item){
	$writer->startElement("item");						
	$writer->writeElement("title", "Place Of Interest " . $item['id']);		
	$writer->writeElement("description", " Name: " . $item['name'] . 'Lat: ' . $item['lat'] . " Lon: " . $item['lon'] . "Established in: " . $item['established'] . "Capacity: " . $item['capacity'] . "Line 1: " . $item['address_line1'] . " Line 2: " . $item['address_line2'] . " Postcode: " . $item['postcode']);
	$writer->writeElement("link", ''.$item['wiki'].'');
	// $writer->writeElement("link", ''.$item['website'].'');
	$writer->writeElement("category", "City id: " . $item['city_id'] . " Location Type ID: " . $item['l_type_id']);
	$writer->endElement();		 // End place_of_interest individual element					
}

// // Location type RSS Items
// foreach ($l_type_rss as $item) {
// 	$writer->startElement("category");
// 	$writer->writeElement("title", "Location id");
// 	$writer->writeElement("description", "ID:" . $item['id'] . " matches with " . $item['l_type']);
// 	$writer->writeElement('link', 'http://localhost/quotes/?qid=' . 3);
// 	$writer->endElement();
// }	


// Set up images for when image data is found
// $writer->startElement("images");
// foreach ($imgRSS as $item){
// 	$writer->writeElement("description", "");
// }
// $writer->endElement();

// End Channel Element
$writer->endElement();


# end channel
$writer->endElement();


$writer->endDocument();

header('Content-Type: text/xml'); 

# send the output to the browser
$writer->flush();
?>
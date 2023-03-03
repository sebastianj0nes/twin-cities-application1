<?php

require "config.php";

@date_default_timezone_set("GMT");

$pdo = new PDO('mysql:host='.DBMS['HOST'].';dbname='.DBMS['DB'], DBMS['UN'], DBMS['PW'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

# formulate the SQL and run it
$sql = 'SELECT `id`, `name`, `lat`, `lon` 
		FROM `city`';

$query = $pdo->prepare($sql);
$query->execute();

# store all the results in an array
$rss_items = $query->fetchAll();

# crete a new writer object
$writer = new XMLWriter();

# output directly to browser
$writer->openURI('php://output');

# start the document
$writer->startDocument('1.0');

$writer->setIndent(4);

# declare it as an rss document
$writer->startElement('rss');
$writer->writeAttribute('version', '2.0');
$writer->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');

$writer->startElement("channel");

$writer->writeElement('title', 'Quotes from our database.');
$writer->writeElement('description', 'These are some quotes from our database.');
$writer->writeElement('link', 'http://localhost/quotes/?qid=new');
$writer->writeElement('pubDate', date("D, d M Y H:i:s e"));

foreach ($rss_items as $item) {
	#----------------------------------------------------
	$writer->startElement("item");
	$writer->writeElement('title','ID: '. $item['id'] . PHP_EOL . ' - City: ' . $item['name']);
	$writer->writeElement("description", 'Lat: ' . $item['lat'] . PHP_EOL . ' & Lon: ' . $item['lon']);
	$writer->endElement();
    $writer->endElement();
	
   #----------------------------------------------------
}

# end channel
$writer->endElement();

# end rss
$writer->endElement();

$writer->endDocument();


header('Content-Type: text/xml'); 

# send the output to the browser
$writer->flush();
?>
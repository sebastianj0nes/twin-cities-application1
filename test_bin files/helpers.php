<?php

//converts the given data into an array
function convertDataToArray($url, $type)
{
    //depending on the language given process differently.
    switch ($type) {
        case 'xml':
            $xml = simplexml_load_file($url) or die("Error: FAILURE");
            $result = json_encode($xml);
            break;
        case 'csv':
            // create file handle to read CSV file
            $csvToRead = fopen($url, 'r');

            // read CSV file using comma as delimiter
            while (!feof($csvToRead)) {
                $csvArray[] = fgetcsv($csvToRead, 1000, ',');
            }

            fclose($csvToRead);
            $result = $csvArray;
            break;
        default:
            echo 'something went wrong';
    }
    return json_decode($result, true);
}


function call_flickr($method, $params)
{
    $key = '301176ad6a15d192d9da6d453182752c';
    $uri = "https://api.flickr.com/services/rest/?method=" . $method . "&api_key=" . $key . "&" . implode("&", $params);
    return simplexml_load_file($uri);
}

function get_flickr_photos($flickr, int $number): string
{
    $h = "";
    for ($i = 0; $i < $number; $i++) {
        $photo = $flickr->photos->photo[$i];
        $pa = $photo->attributes();
        $imguri = "http://farm{$pa->farm}.static.flickr.com/{$pa->server}/{$pa->id}_{$pa->secret}_m.jpg";
        $photouri = "http://www.flickr.com/photos/{$pa->owner}/{$pa->id}";
        $h .= "<a href='{$photouri}'> <img src='{$imguri}'/> </a>";
    }
    return $h;
}

function get_photo(string $name, int $max_photo): string
{
    $flickrXML = call_flickr(
        "flickr.photos.search",
        ["text=" . rawurlencode($name), "sort=relevance"]
    );

    return (get_flickr_photos($flickrXML, $max_photo));
}

function userFriendlyErrorHandler(int $errNo, string $errMsg, string $file, int $line)
{
    return "This is a more user friendly error message, feel free to use the above variables to write a better one.";
}

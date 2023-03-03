
<?php
function get_photo(string $name, int $max_photo)
{
    //setting the variables for the url to request the image set
    $count = 0;
    $method = "flickr.photos.search";
    $params = ["text=" . rawurlencode($name), "sort=relevance"];
    $uri = "https://api.flickr.com/services/rest/?method=" . $method . "&api_key=301176ad6a15d192d9da6d453182752c&" . implode("&", $params);

    //sets the data given from the url to an array for easier handling
    $array = convertDataToArray($uri, 'xml');

    //checks the images directory for all the currently cached images
    $allFiles = scandir('./images/flickr/');

    //loops through the data given by the api and if the image is not in the cached images then it will download it, else it will load it from disk
    foreach ($array['photos']['photo'] as $photo) {
        if ($count < $max_photo)
            //setting the parameters to point to the specific photo
            $imageId = $photo['@attributes']['id'];
        $filename = $imageId . '.jpg';
        $filepath = './images/flickr/' . $filename;
        if (!in_array($filename, $allFiles)) {
            //downloads the file if not in the cache
            echo 'downloading file ... <br />';
            $flickrImageUrl =  'http://farm' . $photo['@attributes']['farm'] . '.static.flickr.com/' . $photo['@attributes']['server'] . '/' . $photo['@attributes']['id'] . '_' . $photo['@attributes']['secret'] . '_m.jpg';
            file_put_contents($filepath, file_get_contents($flickrImageUrl));
        } else {
            //just outputs the image if image is in the cache
            echo 'already downloaded ... <br />';
        }
        $count++;
        echo '<img src="' . $filepath . '" />';
        echo '<hr>';
    }
}
?>

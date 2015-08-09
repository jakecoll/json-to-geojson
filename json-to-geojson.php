<?php
$json = file_get_contents(YOUR_JSON_RESULTS);

function geoJson ($json) 
    {
        $original_data = json_decode($json, true);
        $features = array();

        foreach($original_data as $key => $value) { 
            $features[] = array(
                    'type' => 'Feature',
                    'geometry' => array('type' => 'Point', 'coordinates' => array($value['lng'],$value['lat'])),
                    //change properties to corresponding json objects
                    'properties' => array(
                        'id' => $value['id'], 
                        'source' => $value['source'],
                        'title' => $value['title'],
                        'address' => $value['address'], 

                   );
            };   

        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);
        return json_encode($allfeatures, JSON_PRETTY_PRINT);

    }

//uncomment writer to save json file locally

/*$fp = fopen('data.json', 'w');
fwrite($fp, geoJson($json));
fclose($fp);*/

header('Content-type: application/json');
echo geoJson($json);

?>
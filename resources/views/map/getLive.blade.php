<?php

    $random_x = 53.195+(mt_rand() / mt_getrandmax())/15;
    $random_y = 6.53+(mt_rand() / mt_getrandmax())/15;

    echo json_encode(json_decode('{"geometry": {"type": "Point", "coordinates": ['.$random_y.', '.$random_x.']}, "type": "Feature", "properties": {}}'),true);
    /**
    echo '<br/><br/><br/>';
    print_r(json_decode('{"geometry": {"type": "Point", "coordinates": [52.692837785077067, 37.659843760691352]}, "type": "Feature", "properties": {}}',true));

    echo '<br/><br/><br/>';
    print_r(json_decode('{"geometry": {"type": "Point", "coordinates": ['.$random_x.', '.$random_y.']}, "type": "Feature", "properties": {}}',true));
     * */
?>
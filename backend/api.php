<?php

use Api\DistanceApi;

require_once "Api/DistanceApi.php";
require_once "Db.php";


try {
    $result = (new DistanceApi(new Db()))->run();
    echo $result;
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>
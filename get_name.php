<?php
require_once __DIR__ . "/vendor/autoload.php";
function getName($userId){

    $collection = (new MongoDB\Client)->YJUniversityDB->profiles;
    $user = $collection->findOne(['UserId'=>$UserId]);
    return $user['Name'];
}

?>
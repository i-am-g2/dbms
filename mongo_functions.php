<?php
require_once __DIR__ . "/vendor/autoload.php";
function getName($userId){

    $collection = (new MongoDB\Client)->YJUniversityDB->profiles;
    $user = $collection->findOne(['UserId'=>$userId]);
    return $user['Name'];
}

function addUser($userId){
    $collection = (new MongoDB\Client)->YJUniversityDB->profiles;
    $collection->insertOne(['UserId'=>$userId]);
}

function deleteUser($userId){
    $collection = (new MongoDB\Client)->YJUniversityDB->profiles;
    $collection->deleteOne(['UserId'=>$userId]);
}

?>
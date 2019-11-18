<?php
require_once __DIR__ . "/vendor/autoload.php";
function getName($userId)
{
    try {
        $collection = (new MongoDB\Client)->YJUniversityDB->profiles;
        $user = $collection->findOne(['UserId' => $userId]);
        return $user['Name'];
    } catch (\Exception $e) {
        return NULL;
    }
}

function addUser($userId)
{
    try {
        $collection = (new MongoDB\Client)->YJUniversityDB->profiles;
        $collection->insertOne(['UserId' => $userId]);
        return "Success";
    } catch (\Exception $e) {
        return NULL;
    }
}

function deleteUser($userId)
{
    try {
        $collection = (new MongoDB\Client)->YJUniversityDB->profiles;
        $collection->deleteOne(['UserId' => $userId]);
        return "Success";
    } catch (\Exception $e) {
        return NULL;
    }
}

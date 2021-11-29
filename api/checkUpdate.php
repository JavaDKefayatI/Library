<?php
include "../includes/Config_inc.php";
include "../includes/Version.php";

$db= new Config_inc("library2");



$version = new Version();
$version->setLastVersionFromDatabase($db, "version", "numberVersion");

//get current max version
$maxVersion = $version->getLastVersionInDatabase();

//create url for connecting server
$url = Config_inc::getServer() . "/server/api/CheckUpdate.php?version=" . $maxVersion;
// get information from server
$information = $version->informationFromServer($url);
// check update
if ($information["status"] == 1) {

    //set new information for version in database
    $version->setInformationInDatabase($db, $information);
    $version->DownloadFileAndSet();
    echo json_encode(["status" => 1]);
} else
    echo json_encode(["status" => 0]);


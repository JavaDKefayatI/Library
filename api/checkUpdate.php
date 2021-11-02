<?php
include "../includes/Config_inc.php";
include "../includes/Version.php";

$connect = new Config_inc("library");
$version = new Version();

$version->setLastVersionFromDatabase($connect, "version", "numberVersion");

//get current max version
$maxVersion = $version->getLastVersionInDatabase();
//create url for connecting server
$url = Config_inc::getServer() . "/server/api/CheckUpdate.php?version=".$maxVersion;
// get information from server
var_dump( $version->informationFromServer($url));
// check update

//var_dump( $information[0]);
die();
if ($information[0][""])

//var_dump($information);
die();

if ($is_update) {
    //set new information for version in database
    $version->setInformationInDatabase($connect, $array_versions);
    echo "JAVAD";
    //download file from server
    exec("wget ".Config_inc::getServer()."/server/uploads/".$version->getLastNewNameVersion());

}


?>

<?php

// From URL to get webpage contents.
include "../includes/Config_inc.php";
include "../includes/Version.php";

$connect = new Config_inc('library');
$version = new Version();

//get current max version
$current_v = $version->lastVersion($connect, "version", "numberVersion");
//create url for connecting server
$url = Config_inc::getServer() . "/server/api.php";
// get information from server
$result = $version::getSite($url);

echo $result;





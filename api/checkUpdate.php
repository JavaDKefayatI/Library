<pre>
<?php
include "../includes/Config_inc.php";
include "../includes/Version.php";

$connect = new Config_inc("library");
$version = new Version();
$version->setLastVersionFromDatabase($connect, "version", "numberVersion");
//create url for connecting server
$url = Config_inc::getServer() . "/server/api.php";
//get current max version
$current_v = $version->getLastVersionInDatabase();

// get information from server
$array_versions = $version->versions($url);
// check update
$is_update = $version->checkVersion($current_v, $array_versions);

if ($is_update) {
    //set new information for version in database
    $version->setInformationInDatabase($connect, $array_versions);
    echo "JAVAD";
    //download file from server
    exec("wget ".Config_inc::getServer()."/server/uploads/".$version->getLastNewNameVersion());

}


?>
</pre>

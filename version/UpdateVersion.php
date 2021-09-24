<?php
include "../includes/Config_inc.php";
include "../includes/Users.php";

$db = new Config_inc("library");
$last_version = 3;

// If is not set data base
if ($db->checkEmpty("version")) {
    include "../version/BaseVersion.php";
    $last_version = 2;

} // If is data base
else {
  echo $last_version=  $Last_version = $db->lastVersion("version", "numberVersion");
    echo $last_version;
    $Last_version =5;
    echo $last_version;
}
//switch ($Last_version) {
//
//    case 2:
//        $db->insert("version", ["numberVersion"], [2]);
//
//}
//header("../Setting.php");
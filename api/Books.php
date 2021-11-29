<?php
include "../includes/Config_inc.php";
include "../includes/Users.php";

$db = new Config_inc("library2");
$user = new Users();

try {
    if ($user->isLogIn($db) == 0)
        header('Location:Sign/SignIn.php');

} catch (Exception $e) {

}

$books = $db->selectOrSearch("books", ['*']);
echo(json_encode($books));


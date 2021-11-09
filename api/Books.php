<?php
include "../includes/Config_inc.php";
include "../includes/Users.php";

$connect = new Config_inc("library2");
$user = new Users();

try {
    if ($user->isLogIn($connect))
        header('Location:Sign/SignIn.php');

} catch (Exception $e) {

}

$books = $connect->selectOrSearch("books", ['*']);
echo(json_encode($books));


<?php
include 'Config_inc.php';
include 'Users.php';
include 'Version.php';

$db = new Config_inc("library2");
$user = new Users();
$version = new Version();
try {
    if ($user->isLogIn($db))
        header('Location:sign/SignIn.php');

} catch (Exception $e) {

}

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    switch ($index) {

        case 1:
            //information that we need
            $requestBook = $db->selectOrSearch("requestbook", ["*"]);
            $books = $db->selectOrSearch("books", ["*"]);
            echo(json_encode(["requestBook" => $requestBook, "book" => $books]));
            break;

        case 2:
            $books = $db->selectOrSearch("books", ['*']);
            echo(json_encode($books));
            break;
//information site and versions
        case 3:

            $versions = $db->selectOrSearch("version", ["*"]);
            echo json_decode( include "api/package.json");
//            echo(json_encode(["informationSite" => include "api/", "versions" => $versions]));
            break;
        case 4:

    }
}




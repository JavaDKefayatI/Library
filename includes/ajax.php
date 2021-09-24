<?php
include 'Config_inc.php';
include 'Users.php';

$db = new Config_inc("library");
$user = new Users();
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
            $requestBook = $db->selectOrSearch("requestbook", ["*"], "state=1");
            $books = $db->selectOrSearch("books", ["*"]);
            echo(json_encode(["requestBook" => $requestBook, "book" => $books]));
            break;

        case 2:
            $books = $db->selectOrSearch("books", ['*']);
            echo(json_encode($books));
            break;

        case 3:

    }
}




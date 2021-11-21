<?php

include "../includes/RequestBook.php";
include "../includes/Config_inc.php";
include "../includes/Users.php";
include "../includes/Books.php";
include "../includes/Admin.php";

$db = new Config_inc("library2");
$user = new Users();
$books = new Books();

try {
    if ($user->isLogIn($db))
        header('Location:Sign/SignIn.php');

} catch (Exception $e) {

}

$req = new RequestBook();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($req->checkReturn($db, $id)) {
        $req->setReturned($db, $id);
        echo json_encode(["status" => "1"]);
    } else
        echo json_encode(["status" => "0"]);
}

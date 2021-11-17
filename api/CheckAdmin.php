<?php
include "../includes/RequestBook.php";
include "../includes/Config_inc.php";
include "../includes/Users.php";
include "../includes/Books.php";
include "../includes/Admin.php";

$db = new Config_inc("library2");
$user = new Users();
$books = new Books();
$admin = new Admin();

try {
    if ($user->isLogIn($db))
        header('Location:Sign/SignIn.php');

} catch (Exception $e) {

}
$error = "";

if (isset($_GET['accept'])) {
    $id_req = $_GET['accept'];

    if ($admin->checkRequest($db, $id_req)) {
        $admin->setAccept($db, $id_req);
        echo json_encode(["status" => "1"]);
    }
    else
        echo json_encode(["status" => "0"]);

}

if (isset($_GET['reject'])) {
    $id_req = $_GET['reject'];

    if ($admin->checkRequest($db, $id_req)) {
        $admin->reject($db, $id_req);
        echo json_encode(["status" => "1"]);
    }
    else
        echo json_encode(["status" => "0"]);
}

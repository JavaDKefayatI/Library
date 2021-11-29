<?php
include "../../includes/Config_inc.php";
include "../../includes/Users.php";
include "../../includes/Admin.php";
include "../../includes/Books.php";
$db = new Config_inc("library2");
$user = new Users();
$admin = new Admin();
$books = new Books();

try {
    $check = $user->isLogIn($db);
    if ($check == 0)
        header('Location:../Sign/SignIn.php');
    elseif ($check == 1)
        header('Location:../user/AllBook.php');

} catch (Exception $e) {

}

$name = "";
$author = "";
$year = "";
$error = "";
$checkIsId = isset($_GET['id']);


if ($checkIsId) {
    $id = $_GET['id'];

    try {
        if ($books->setInformationBook($db, $id)) {

            $name = $books->getNameBook();
            $author = $books->getAuthor();
            $year = $books->getYear();
            echo json_encode(["status" => "1", "nameBook" => $name, "author" => $author, "year" => $year]);
        } else
            echo json_encode(["status" => "0"]);
    } catch (Exception $e) {
    }


}
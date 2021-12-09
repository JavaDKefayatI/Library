<?php
include "../../includes/Config_inc.php";
include "../../includes/Users.php";
include "../../includes/Admin.php";
include "../../includes/Books.php";
include "../../includes/Functions_inc.php";
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


$checkPost = !empty($_POST);

if ($checkPost) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $id = $_POST['id'];

    $status = $db->selectOrSearch("books", ["status"], "Id=" . $id);
    if ($status[0]["status"] == 0) {

        if (!empty($id)) {

            if ($books->editBook($db, $name, $author, $year, $id))
                echo json_encode(["status" => "1"]);
            else
                echo json_encode(["status" => "0"]);

        } // this part is for create row of book
        else {

            if ($books->createBook($db, new Functions_inc(), $name, $author, $year)) {
                echo json_encode(["status" => "1"]);
            } else
                echo json_encode(["status" => "0"]);

        }
    } else
        echo json_encode(["status" => "2"]);

}
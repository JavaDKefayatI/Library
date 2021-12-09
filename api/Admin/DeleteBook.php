<?php

include "../../includes/Config_inc.php";
include "../../includes/Users.php";
include "../../includes/Admin.php";
$db = new Config_inc("library2");
$user = new Users();
$admin = new Admin();


try {
    $check = $user->isLogIn($db);
    if ($check == 0)
        header('Location:../Sign/SignIn.php');
    elseif ($check == 1)
        header('Location:../user/AllBook.php');

} catch (Exception $e) {

}
if (isset($_GET["id"])){

    $id = $_GET["id"];

    $book =$db->selectOrSearch("books",["status"],"id=".$id);
   if( $book[0]["status"] ==0 ) {
       if ($db->delete("books", "Id = " . $id))
           echo json_encode(["status" => "1"]);
       else
           echo json_encode(["status" => "0"]);
   }else
        echo json_encode(["status" => "2"]);

}
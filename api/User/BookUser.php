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
    elseif ($check == 2)
        header('Location:../admin/LibraryAdmin.php');

} catch (Exception $e) {

}
if (isset($_GET["id_user"])) {
    $id_user = $_GET["id_user"];
    $req = $admin->createApi($db, "id_user =" . $id_user." and books.status=1");
    echo(json_encode($req));
}


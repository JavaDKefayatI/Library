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
        header('Location:../admin/LibraryAdmin.php');

} catch (Exception $e) {

}
$req = $admin->createApi($db);

echo(json_encode($req));



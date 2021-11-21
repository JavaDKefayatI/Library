<?php
include "../includes/Config_inc.php";
include "../includes/Users.php";
include "../includes/Admin.php";
$db = new Config_inc("library2");
$user = new Users();
$admin = new Admin();

try {
    if ($user->isLogIn($db))
        header('Location:Sign/SignIn.php');

} catch (Exception $e) {

}
if (isset($_GET["id_user"])) {
    $id_user = $_GET["id_user"];
    $req =$admin->createApi($db , "id_user =" .$id_user);
    echo(json_encode($req));
}
?>

<?php
include "../includes/Config_inc.php";
include "../includes/Users.php";
$db = new Config_inc("library2");
$user = new Users();

try {
    if ($user->isLogIn($db))
        header('Location:Sign/SignIn.php');

} catch (Exception $e) {

}
if (isset($_GET["id_user"])) {
    $id_user = $_GET["id_user"];
    $req = $db->selectOrSearch("requestbook", ['*'], "id_user = " . $id_user);

    $user = $db->selectOrSearch("users", ["username"], "id = " . $id_user);

    for ($i = 0; $i < count($req); $i++) {
        $id_user = $req[$i]["id_user"];
        $id_book = $req[$i]["id_book"];

        $name_book = $db->selectOrSearch("books", ["Name", "Author"], "Id = " . $id_book);

        $req[$i] = $req[$i] + $name_book[0];
    }

    echo(json_encode(["username" => $user[0]["username"], "information" => $req]));
}
?>

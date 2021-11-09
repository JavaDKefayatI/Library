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
$req = $db->selectOrSearch("requestbook", ['*']);
//echo $req[0]["id"];
//var_dump($req);
for ($i = 0; $i < count($req); $i++) {
    $id_user = $req[$i]["id_user"];
    $id_book = $req[$i]["id_book"];
    $user = $db->selectOrSearch("users", ["username"], "id = " . $id_user);
    $name_book = $db->selectOrSearch("books", ["Name","Author"], "Id = " . $id_book);

    $req[$i] = $req[$i] + $user[0]+$name_book[0];
}

echo(json_encode($req));

?>

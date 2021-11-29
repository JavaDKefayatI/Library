<?php
include "HeaderSign.php";
include "../includes/Config_inc.php";
include "../includes/Functions_inc.php";
include "../includes/Users.php";

$func = new Functions_inc();
$db = new Config_inc("library2");
$user = new Users();
try {
    if ($user->isLogIn($db)==1)
        header("Location:../user/AllBook.php");
    elseif ($user->isLogIn($db)==2)
        header("Location:../Admin/LibraryAdmin.php");
} catch (Exception $e) {
}


$error = "";
$isPost = !empty($_POST);

if ($isPost) {
    if (Users::checkUser($db, $_POST['user'], $_POST['pass'])==1) {
        header('Location:/firstProj/user/AllBook.php');
        exit();
    } elseif (Users::checkUser($db, $_POST['user'], $_POST['pass'])==2){
        header('Location:/firstProj/admin/LibraryAdmin.php');
        exit();
    }else
        $error = "Username or password is not correct";
}

?>

<body>

<div class="container ">
    <div class="d-flex justify-content-center h-100">
        <div class="card w-50 m-auto">

            <div class="card-header bg-danger ">
                <h1 class="text-white ">Sign in</h1>
            </div>

            <div class="card-body ">
                <form action="" method="post" name="login" id="form" class="w-100">

                    <div class="input-group form-group ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-user-circle  text-white pl-2  fa-lg" id="circle"></i></span>
                        </div>
                        <input type="text" class="form-control border border-left-0" name="user"
                               placeholder="Username " required>
                    </div>

                    <div class="input-group form-group position-relative">
                        <div class="input-group-prepend ">

                            <span class="input-group-text bg-warning w-100 pr-4"><i
                                        class="fa fa-lock fa-lg text-white pl-2 "></i></span>
                        </div>

                        <input type="password" class="form-control  border border-left-0 border-right-0" name="pass"
                               id="pass"
                               placeholder="Password" required>
                        <div class="input-group-prepend ">

                            <button type="button" class=" bi bi-eye-slash border border-right-0 w-100"
                                    id="togglePassword" onclick="setTogglePass('pass','togglePassword')">
                        </div>

                        <div class=" input-group mt-2">
                            <input type="submit" value="Sign in" class="btn float-left btn-danger  w-100 ">
                        </div>

                        <div class="input-group mt-3">
                            <a href="SignUp.php"><input type="button" class="btn btn-warning  w-100" name="create"
                                                        id="signU" value="Create new account">
                            </a>
                        </div>

                        <div class="form-group mt-2 ">
                            <p class="text-white mb-1 ">
                                <?= $error ?>
                            </p>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>

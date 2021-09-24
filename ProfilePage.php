<?php
include "includes/Config_inc.php";
include "includes/Functions_inc.php";
include "includes/Users.php";

$user = new Users();
$db = new Config_inc("library");

try {
    if ($user->isLogIn($db))
        header('Location:sign/SignIn.php');

} catch (Exception $e) {

}


$checkPost = !empty($_POST);
$alert = "";

if ($checkPost) {
    $name = $_POST['name'];
    $family = $_POST['family'];
    $phone = $_POST['phone'];

    $alert = $user->checkProfile($db, $name, $family, $phone);

} else {
    $name = $user->getName();
    $family = $user->getFamily();
    $phone = $user->getPhone();
}

include "Header.php";
?>
    <div class="container mt-5 mb-5">
        <div class="d-flex justifly-content-center h-100 ">
            <div class=" w-50 mt-auto mb-auto border p-3  ">
                <div>
                    <h1>
                        Profile
                    </h1>
                </div>

                <form action="" method="post" name="login" id="form" class="w-100">

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success text-white pr-4 ">Name :</span>
                        </div>
                        <input type="text" class="form-control " value="<?= $name ?>" name="name">
                    </div>

                    <div class="input-group form-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success text-white pr-3 ">Family : </i></span>
                        </div>
                        <input type="text" class="form-control " value="<?= $family ?>" name="family">
                    </div>

                    <div class="input-group form-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success text-white w-100 pr-4      ">Phone : </i></span>
                        </div>
                        <input type="text" class="form-control " value="<?= $phone ?>" name="phone">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-dark w-25 mr-2" name="create"
                               value="Edit profile"
                               id="signU">

                        <a href=" Library.php"><input type="button" class="btn btn-dark w-25 mr-2" name="create"
                                                      value="Home"
                                                      id="signU"></a>
                    </div>

                </form>
                <p><?= $alert ?></p>

            </div>
        </div>
    </div>

    </body>
<?php
include "Footer.php";
?>
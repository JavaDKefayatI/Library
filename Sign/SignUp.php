<?php
include "HeaderSign.php";
include "../includes/Config_inc.php";
include "../includes/Functions_inc.php";
include "../includes/Users.php";

$func = new Functions_inc();
$connect = new Config_inc("library");
$alert = "";


try {
    if (Users::isLogOut())
        header("Location:../Library.php");
} catch (Exception $e) {
}

$checkPost = !empty($_POST);

if ($checkPost) {
    $alert = Users::SignUp($connect, $_POST['name'], $_POST['family'], $_POST['user'],
        $_POST['pass'], $_POST['pass-r'], $_POST['email'], $_POST['phone']);

    if ($alert == "") {
        header('Location:SignIn.php');
        exit();
    }
}

?>

</head>
<div class="text-white">

</div>
<body class="mb-1 h">
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card w-50 m-auto">

            <div class="card-header bg-danger">
                <h1 class="text-white">Sign up</h1>
            </div>

            <div class="card-body mb-4 ">
                <!--   start form          -->
                <form method="post" name="form" id="form">

                    <div class="input-group form-group mb-2 ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-user text-white pl-2  fa-lg "></i></span>
                        </div>
                        <input type="text" class="form-control border border-left-0"
                               name="name" placeholder="Name" id="name" required>
                    </div>

                    <div class="input-group form-group mb-2">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-user text-white pl-2  fa-lg "></i></span>
                        </div>

                        <input type="text" class="form-control border border-left-0"
                               name="family" placeholder="Family" id="family" required>
                    </div>

                    <div class="input-group form-group mb-2">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-user-circle text-white pl-2  fa-lg "></i></span>
                        </div>
                        <input type="text" class="form-control border border-left-0" name="user" placeholder="Username"
                               id="user" maxlength="18" oninput="removeSpace('user')" required>
                    </div>

                    <div class="input-group form-group mb-2">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-lock text-white pl-2  fa-lg "></i></span>
                        </div>

                        <input type="password" class="form-control border border-left-0" name="pass"
                               placeholder="Password" id="pass" " required>
                    </div>

                    <div class="input-group form-group mb-2 ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-lock text-white pl-2  fa-lg "></i></span>
                        </div>
                        <input type="password" class="form-control border border-left-0" name="pass-r"
                               placeholder="Confirm password" id="pass-r"
                               onkeyup="checkTwoPassword('pass', 'pass-r', 'alert-pass')" required>
                    </div>


                    <p class="  bg-warning  w-50 p-1 text-center =  pl-2 mb-1 " hidden>
                        Two password is not same</p>


                    <div class="input-group form-group mb-2">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-at text-white pl-2  fa-lg "></i></span>
                        </div>
                        <input type="text" class="form-control border border-left-0" name="email" placeholder="Email"
                               id="email" onfocusout="validEmail('email','alert-email') "
                               required>
                    </div>

                    <div class="input-group form-group mb-2">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-warning w-100 pr-3"><i
                                        class="fa fa-phone text-white pl-2  fa-lg "></i></span>
                        </div>
                        <input type="text" class="form-control border border-left-0" name="phone" placeholder="Phone"
                               id="phone" oninput="checkJustNumber('phone')"
                               onfocusout="checkCountPhone('phone','phone-alert')" maxlength="11" required>
                    </div>

                    <div class="form-group ">
                        <input type="submit" class="btn float-left btn-danger w-100 mb-3"
                               name="submit" id="submit"
                               value="summit">
                    </div>

                    <div class="form-group">
                        <a href="SignIn.php"><input type="button" class="btn btn-warning w-50 mr-2" name="return"
                                                    value="Return to sign in"
                                                    id="signU"></a>
                    </div>

                </form>
                <!--     end form          -->
                <div class="container">
                    <p id="alert-email" class="text-white mb-1"></p>
                    <p id="alert-pass" class="text-white mb-1"></p>
                    <p id="alert-pass-format" class="text-white mb-1"></p>
                    <p id="phone-alert" class="text-white mb-1"></p>
                    <p class="text-white mb-1">
                        <?=
                        $alert;
                        ?>
                    </p>

                </div>

            </div>

        </div>
    </div>
</div>

<h1 id="h" class="text-white"></h1>
<script>
    onSub("#form", "pass", "pass-r", "email", "phone");

</script>

</body>


</html>

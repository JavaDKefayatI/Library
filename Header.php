<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <script src="https://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="front/img/768px-Closed_Book_Icon.svg.ico"/>
    <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css"/>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!--    <script src="//maxcdn.bootstrapcdn.com/boot strap/4.1.1/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="front/css/Library.css">
    <?php
    include "includes/Config_inc.php";
    include "includes/Functions_inc.php";
    include "includes/Users.php";
    include "includes/Books.php";
    include "includes/Version.php";

    $func = new Functions_inc();
    $user = new Users();
    $db = new Config_inc("library2");
    $books = new Books();
    $version = new Version();

    try {
        if ($user->isLogIn($db))
            header('Location:sign/SignIn.php');

    } catch (Exception $e) {

    }


    ?>


</head>
<body dir="ltr" id="" class="">

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left bg-secondary w3-border " style="display:none"
     id="mySidebar">
    <br>
    <br>
    <br>
    <button class="w3-bar-item w3-button w3-large bg-success w-100"
            onclick="w3_close()">Close &times;
    </button>
    <a href="AllBook.php" class="w3-bar-item w3-button">Home</a>
    <a href="AllBook.php" class="w3-bar-item w3-button">Books</a>
    <a href="RequestPage.php" class="w3-bar-item w3-button">Requests book</a>
    <a href="LibraryAdmin.php" class="w3-bar-item w3-button">Edit and create book</a>
    <a href="#" class="w3-bar-item w3-button">About this site</a>
    <a href="Setting.php" class="w3-bar-item w3-button">Setting</a>
</div>


<div id="main">

    <nav class="navbar navbar-expand-lg align-self-xl-center navbar-light bg-secondary">
        <button id="openNav" class=" navbar-brand btn-secondary btn bg-secondary text-white  w3-xlarge py-0 "
                onclick="w3_open()">&#9776;
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">


                <a href="ProfilePage.php">

                    <button class="bg-transparent btn  mt-2 " style="">
                        <i class="fa fa-user-circle fa-5x text-white  "></i>
                    </button>
                </a>

                <a href="includes/LogOut.php">
                    <button class="  btn bg-transparent text-white  mt-4 text-center"
                            onclick="">Log out
                    </button>
                </a>

            </ul>
            <form class=" my-2 my-lg-0">
                <h1 class=" bg-secondary text-white pb-4 display-4  pr-5 ml-auto ">Library</h1>
            </form>
        </div>
    </nav>

    <script>

        function w3_open() {
            document.getElementById("main").style.marginLeft = "14%";
            document.getElementById("mySidebar").style.width = "14%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
        }

        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
        }
    </script>

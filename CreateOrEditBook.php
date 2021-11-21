<?php
include "Header.php";

$state = "Create";
$name = "";
$author = "";
$year = "";
$error = "";
$checkIsId = isset($_GET['id']);


if ($checkIsId) {
    $id = $_GET['id'];
    echo $id;
    try {
        $books->setInformationBook($db, $id);
    } catch (Exception $e) {
    }

    $name = $books->getNameBook();
    $author = $books->getAuthor();
    $year = $books->getYear();
    $state = "Edit";

}


$checkPost = !empty($_POST);

if ($checkPost) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $year = $_POST['year'];


    if ($checkIsId) {

        $error = $books->editBook($db, $name, $author, $year, $id);

        if ($eroro == "")
            header('Location:/firstProj/Library.php');
    } // this part is for create row of book
    else {

        if ($books->createBook($db, $name, $author, $year)) {
            header('Location:/firstProj/Library.php');
        } else
            $error = "Your information was not successfully registered <br>";

    }
}

?>
    <script>
        setTitle("#title", "Create or edit book");
    </script>


    <main>

        <div class="container">
            <div class="d-flex justify-content-center h-100 ">
                <div class="card w-50 mt-auto mb-auto rounded border border-danger    ">
                    <div class="card-header bg-warning">
                        <h1 class="text-dark"><?= $state ?> book</h1>
                    </div>

                    <div class="card-body">
                        <form action=""
                              method="post"
                              name="login" id="form" class="w-100">


                            <div class="input-group-prepend">
                                <label class="input-group-text bg-warning ">Name :</label>
                            </div>
                            <input type="text" value="<?= $name; ?>" class="form-control mb-3 " placeholder="Name "
                                   name="name"
                                   required>


                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning ">Author :</i></span>
                            </div>
                            <input type="text" class="form-control  mb-3" value="<?= $author ?>" placeholder="Author"
                                   name="author" required>

                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning">Print year :</i></span>
                            </div>
                            <input type="date" class="form-control  mb-3" value="<?= $year ?>" placeholder="Print year"
                                   name="year" required>


                            <div class="form-group ">
                                <input type="submit" value="<?= $state ?>"
                                       class="btn float-left btn-dark w-25 mr-3 text-warning">

                                <a href="LibraryAdmin.php"><input type="button" class="btn btn-dark text-warning w-25 "
                                                             name="create"
                                                             value="Home"
                                    ></a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

<?php

include "Footer.php";

?>
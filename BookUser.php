<?php
include "Header.php";
include "includes/RequestBook.php";
$req = new RequestBook();
$error = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if ($req->checkReturn($db, $id)) {
        $req->setReturned($db, $id);
    } else
        $error = "this book already returned or not exist in your request ";


}


?>
<script src="front/js/user/Book_client.js"></script>

<script>
    // setTitle("title", "Library")

    table_for_return(<?= $user->getId() ?>)
</script>
<h3 class="text-danger"><?= $error ?></h3>

<main id="bodyTable " class="mb-4" style="">

    <div class=" mb-4  container mt-4" id="body">

        <table id="example" class=" w-75 cell-border mb-4 ">

            <thead class="  text-center">

            <tr class="text-center">
                <th class="">Username</th>
                <th>Name</th>
                <th>Author</th>
                <th></th>

            </tr>

            </thead>

            <tbody class="text-center" id="tb">

            </tbody>

            <tfoot>
            <tr class="text-center">
                <th class="">Username</th>
                <th>Name</th>
                <th>Author</th>
                <th></th>
            </tr>
            </tfoot>

        </table>
    </div>

</main>

<?php
include "Footer.php";
?>

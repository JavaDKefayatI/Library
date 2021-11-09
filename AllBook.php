<?php
include "Header.php";
include "includes/RequestBook.php";

$error = "";

if (isset($_POST['request'])) {
    $id_book = $_POST['request'];
    $status = $books->getStatus($db, $id_book);

    if ($status != 2) {

        $request = new RequestBook();

        if (!$request->isRequest($db, $user->getId(), $id_book))
            $request->setRequest($db, $user->getId(), $id_book);
        else
            $error = "this request already was";

    } else
        $error = "this book isn't available";
}


?>
<script src="front/js/user/AllBook.js"></script>

<script>
    // setTitle("title", "Library")
    AllBook()
</script>

<main id="bodyTable " class="mb-4" style="">

    <div class=" mb-4  container mt-4" id="body">
        <p class="text-danger"><?=$error ?></p>
        <table id="example" class=" w-75 cell-border mb-4 ">

            <thead class="  text-center">

            <tr class="text-center">
                <th class="">Id</th>
                <th>Name</th>
                <th>Author</th>
                <th>Print year</th>
                <th>Status</th>
                <th class=" "></th>
            </tr>

            </thead>

            <tbody class="text-center" id="tb">

            </tbody>

            <tfoot>
            <tr class="text-center">
                <th>Id</th>
                <th>Name</th>
                <th>Author</th>
                <th>Print year</th>
                <th>Status</th>
                <th></th>
            </tr>
            </tfoot>

        </table>
    </div>

</main>

<?php
include "Footer.php";
?>

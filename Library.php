<?php
include "Header.php";
?>

<script>
    setTitle("title", "Library")
    setTable()

</script>

<main id="bodyTable " class="mb-4" style="">

    <div class=" mb-4  container mt-4" id="body">


        <table id="example" class=" w-75 cell-border" mb-4 ">

            <thead class="  text-center">

            <tr class="text-center">
                <th class="">Id</th>
                <th>Name</th>
                <th>Author</th>
                <th>Print year</th>
                <th class=" ">Edit or delete</th>
            </tr>

            </thead>

            <tbody class="text-center" id="tb">

            </tbody>

            <tfoot>
            <tr class="text-center   ">
                <th>Id</th>
                <th>Name</th>
                <th>Author</th>
                <th>Print year</th>
                <th>Edit or delete</th>
            </tr>
            </tfoot>

        </table>
    </div>
    <div style="margin-right:21%" class=" container d-flex justify-content-end ">
        <a href="CreateOrEditBook.php ">
            <button class='btn  btn-danger w-100 p-3'>
                Create a book
            </button>
        </a>
    </div>

</main>


<?php
include "Footer.php";
?>

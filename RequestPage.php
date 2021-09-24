<?php
include "Header.php";
include "includes/Functions_inc.php";
$func = new Functions_inc();

if (isset($_POST['accept']))
    $func->changeStateRequest($_POST['accept'], 2);

?>
<script>
    $(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: 'ajax.php?index=1',
        data: 'id=testdata',
        cache: false,
        success: function (result) {
            const myObj = JSON.parse(result)['requestBook'];
            let td = document.getElementById("j");

            td.innerHTML = printTd(myObj,
                ['id', 'id_book', 'name', 'family', 'username', 'email', 'nameBook', 'author']);
        },

    });


    })



</script>
<main class="container ">
    <h1 class="mt-4 container mb-5">Request book page</h1>

    <table id="example" class="     " style="">
        <thead>
        <tr class="bg text-center">
            <th>Id</th>
            <th>Id book</th>
            <th>Name user</th>
            <th>Family user</th>
            <th>Username</th>
            <th>Email user</th>
            <th>Name Book</th>
            <th>Author</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody id="j" class="text-center">

        </tbody>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Id book</th>
            <th>Name user</th>
            <th>Family user</th>
            <th>Username</th>
            <th>Email user</th>
            <th>Name Book</th>
            <th>Author</th>
            <th></th>

        </tr>
        </tfoot>


    </table>


</main>
<h1 class="text-dark ">
    <?php


    var_dump($_POST);


    ?>
</h1>


<?php
include "Footer.php";
?>

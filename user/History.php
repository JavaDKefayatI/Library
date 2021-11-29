<?php

include "Header.php";
include "../includes/RequestBook.php";




?>
<script src="../front/js/user/History.js"></script>

<script>
    // setTitle("title", "Library")
    user(<?= $user->getId() ?> , 'tb')



</script>

<main id="bodyTable " class="" style="">


    <div class="container">

        <table class="table table-bordered mt-4">
            <thead class="table-primary">
            <tr>
                <th>Username</th>
                <th>Name book</th>
                <th>Name Author</th>
                <th>Status</th>
                <th>Time requested</th>
                <th>Time checked</th>
            </tr>
            </thead>
            <tbody class="" id="tb">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            </tbody>
            <tfoot class="table-primary">
            <tr>
                <th>Username</th>
                <th>Name book</th>
                <th>Name Author</th>
                <th>Status</th>
                <th>Time requested</th>
                <th>Time checked</th>
            </tr>
            </tfoot>
        </table>
    </div>
</main>

<?php
include "Footer.php";
?>

<?php

include "Header.php";
include "includes/RequestBook.php";




?>
<script src="front/js/History.js"></script>

<script>
    // setTitle("title", "Library")

</script>

<main id="bodyTable " class="" style="">


    <div class="container">
        <div class="container mt-6 mb-4 " style="display: inline">
            <h2 style="display: inline"> Choose history :</h2>
            <button class="mr-5 btn btn-info w-25 ml-5" onclick="admin('tb')">Admin</button>
            <button class="mr-5 btn btn-info w-25" onclick="user(<?= $user->getId() ?> , 'tb')">User</button>
        </div>
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
            <tbody id="tb">

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

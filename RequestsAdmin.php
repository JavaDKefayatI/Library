<?php
include "Header.php";
?>
<script src="front/js/admin/ARequest.js"></script>

<script>
    AllReq();
</script>

<main id="bodyTable " class="mb-4" style="">

    <div class=" mb-4  container mt-4" id="body">


        <table id="example" class=" w-75 cell-border mb-4 ">

            <thead class="  text-center">

            <tr class="text-center">
                <th>#</th>
                <th>Username</th>
                <th>Name book</th>
                <th>Author</th>
                <th>time request</th>
                <th></th>
            </tr>

            </thead>

            <tbody class="text-center" id="tb">

            </tbody>

            <tfoot>
            <tr class="text-center   ">
                <th>#</th>
                <th>Username</th>
                <th>Name book</th>
                <th>Author</th>
                <th>time request</th>
                <th></th>
            </tr>
            </tfoot>

        </table>
    </div>


</main>


<?php
include "Footer.php";
?>

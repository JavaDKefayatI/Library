<?php
include "Header.php";
?>

<script src="../front/js/admin/InfoForEdit.js"></script>
    <script>
        // setTitle("#title", "Create or edit book");
        $(document).ready(function () {
            let state = "Create";
            let id = "<?php isset($_GET['id']) ? print $_GET['id']  : print ''; ?>"
            if (id!=="") {
                state = "Edit";

                getData(id)
            }
          document.getElementById("title").innerHTML=state+" book";
          document.getElementById("btnTitle").value=state;
        })


    </script>


    <main>

        <div class="container">
            <div class="d-flex justify-content-center h-100 ">
                <div class="card w-50 mt-auto mb-auto rounded border border-danger ">
                    <div class="card-header bg-warning">
                    <h1 class="text-dark" id="title">

                    </h1>
                </div>

                <div class="card-body">
                    <form action=""
                          method="post"
                          name="login" id="form" class="w-100">


                        <div class="input-group-prepend">
                            <label class="input-group-text bg-warning ">Name :</label>
                        </div>
                        <input type="text" id="name"  class="form-control mb-3 " placeholder="Name "
                               name="name"
                               required>


                        <div class="input-group-prepend">
                            <span class="input-group-text bg-warning ">Author :</i></span>
                        </div>
                        <input type="text" id="author" class="form-control  mb-3"  placeholder="Author"
                               name="author" required>

                        <div class="input-group-prepend">
                            <span class="input-group-text bg-warning">Print year :</i></span>
                        </div>
                        <input type="date" class="form-control  mb-3"  id="year" placeholder="Print year"
                               name="year" required>


                        <div class="form-group ">
                            <input type="button"  id="btnTitle"
                                   class="btn float-left btn-dark w-25 mr-3 text-warning"
                                   onclick="setData('name','author','year','<?php isset($_GET['id']) ? print $_GET['id'] : print ""; ?>')">

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
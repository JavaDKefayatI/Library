<?php

include "Header.php";

?>
    <main class="my-4 ">

        <div class="w3-container">
            <h2 id="ver">Current version :
            </h2>

            <button onclick="checkVersion()" class="btn btn-success btn-lg  ">
                Update
            </button>


        </div>

    </main>
    <p id="j"></p>
    <script>

        function checkVersion() {
            $.ajax({
                type: 'GET',
                url: '../api/checkUpdate.php',
                cache: false,
                success: function (result) {
                    const status = JSON.parse(result)["status"];
                    if (status === 1)
                        alert("downloaded")
                    else
                        alert("you have last version")
                },

            });
        }


    </script>

<?php
include "Footer.php";
?>
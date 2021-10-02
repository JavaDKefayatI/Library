<?php

include "Header.php";
$lastVersion = $version->lastVersion($db, "version", "numberVersion");

?>


<main class="my-4 ">

    <div class="w3-container">
        <h2 id="ver">Current version :
        </h2>

        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success btn-lg  ">
            Update
        </button>

        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id01').style.display='none'"
                          class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                </div>

                <div id="update"></div>
                <div class="w3-container w3-border-top py-2 w3-light-grey">
                    <button onclick="document.getElementById('id01').style.display='none'" type="button"
                            class="btn btn-danger">Cancel
                    </button>

                </div>

            </div>
        </div>
    </div>

</main>
<p id="j"></p>
<script>

    $(document).ready(function (e) {
        let last_version = <?= $lastVersion ?>;
        document.getElementById("ver").innerHTML += last_version;
        updateVersion('update', last_version)

    })
</script>


<?php
include "Footer.php";
?>

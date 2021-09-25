<?php

?>

<style>
    body,html {
        ,html {
         height: 100%;
     }
</style>
    <p>
        this tage was changed.
    </p>

    <body class="container-fluid h-100">
    <h1>javad</h1>
<h1 class="text-danger display-4" style="font-size: 800%">
    I'm javad kefayati
</h1>
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">


                <form action="">
                    <div class="form-group">
                        <input _ngcontent-c0="" class="form-control form-control-lg" placeholder="User email" type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" placeholder="Password" type="password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info btn-lg btn-block">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    <h1>
        hello world
    </h1>
    </body>
    <h1><?php
//        use Config_inc  as connect ;
         
        $people_json = file_get_contents('api/tsconfig.json');

        $decoded_json = json_decode($people_json, false);

        var_dump($decoded_json);
?>
    </h1>
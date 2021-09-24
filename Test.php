
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<style>
    body,html {
        height: 100%;
    }body,html {
         height: 100%;
     }
</style>

    <body class="container-fluid h-100">
    <h1>javad</h1>

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
    </body>
    <h1><?php
        use Config_inc  as connect ;
         
        $people_json = file_get_contents('api/tsconfig.json');

        $decoded_json = json_decode($people_json, false);

        var_dump($decoded_json);
?>
    </h1>
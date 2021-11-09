function AllReq(){
    $(document).ready(function () {
        $('#example').DataTable();

        $.ajax({
            type: 'POST',
            url: 'api/AllRequest.php',
            data: 'id=testdata',
            cache: false,
            success: function (result) {
                const req = JSON.parse(result);
                let t = $('#example').DataTable();

                for (let k in req) {
                    if (req[k]["is_accept"] !=="0")continue;

                    t.row.add([
                        req[k]["id"],
                        req[k]["username"],
                        req[k]["Name"],
                        req[k]["Author"],
                        req[k]["time_request"],
                        `<form method='post'><button class='btn btn-success w-75 mb-2' name='accept' value='${req[k]["id"]}'>accept</button>`+
                        `<button class='btn btn-danger w-75 ' name='reject' value='${req[k]["id"]} '>reject</button></form>`
                    ]).draw(false);
                }
            },

        });
    })

}

function table_for_return(id_user) {
    $(document).ready(function () {
        $('#example').DataTable();

        $.ajax({
            type: 'GET',
            url: 'api/RequestUser.php?id_user=' + id_user,
            data: 'id=testdata',
            cache: false,
            success: function (result) {
                const req = JSON.parse(result);
                let t = $('#example').DataTable();
                let username = req["username"]

                for (let i = 0; i < req["information"].length; i++) {

                    if (req["information"][i]["is_accept"] === "0" ||
                        req["information"][i]["is_accept"] === "-1" ||
                        req["information"][i]["is_return"] === "1"
                    )
                        continue;

                        t.row.add([
                            username,
                            req["information"][i]["Name"],
                            req["information"][i]["Author"],
                            `<form method="post"><button name="id" class="btn btn-danger " 
                                value="${req["information"][i]["id"]}">Return</button></form>`
                        ]).draw(false);

                }
            },


        });
    })

}
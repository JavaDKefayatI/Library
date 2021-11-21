function user(id_user, id_tbody) {
    $(document).ready(function () {
        let tbody = document.getElementById(id_tbody);
        if (tbody.innerHTML !== "")
            tbody.innerHTML = "";
        $.ajax({
            type: 'GET',
            url: 'api/RequestUser.php?id_user=' + id_user,
            data: 'id=testdata',
            cache: false,
            success: function (result) {
                const req = JSON.parse(result);
                let t = $('#example').DataTable();
                let username = req["username"]

                let status = "accepted";

                for (let i = 0; i < req.length; i++) {

                    status = "accepted";

                    if (req[i]["is_accept"] === "-1")
                        status = "rejected"

                    if (req[i]["is_accept"] === "0")
                        continue
                    tbody.innerHTML += `<tr>
                        <td>${req[i]["username"]}</td>
                        <td>${req[i]["Name"]}</t        d>
                        <td>${req[i]["Author"]}</td>
                        <td>${status}</td>
                        <td>${req[i]["time_request"]}</td>
                        <td>${req[i]["time_check"]}</td>
                    </tr>`;
                alert(req[i]["time_check"])
                }
            },


        });
    })

}

function admin(id_tbody) {
    $(document).ready(function () {
            let tbody = document.getElementById(id_tbody);
            if (tbody.innerHTML !== "")
                tbody.innerHTML = "";

            $.ajax({
                type: 'GET',
                url: 'api/AllRequest.php',
                data: 'id=testdata',
                cache: false,
                success: function (result) {
                    const req = JSON.parse(result);
                    let t = $('#example').DataTable();

                    let status = "accepted";
                    for (let i in req) {

                        status = "accepted";
                        if (req[i]["is_accept"] === "-1")
                            status = "rejected"

                        if (req[i]["is_accept"] === "0")
                            continue


                        tbody.innerHTML += `<tr>
                        <td>${req[i]["username"]}</td>
                        <td>${req[i]["Name"]}</td>
                        <td>${req[i]["Author"]}</td>
                        <td>${status}</td>
                        <td>${req[i]["time_check"]}</td>
                    </tr>`;

                    }
                },


            });
        }
    )

}

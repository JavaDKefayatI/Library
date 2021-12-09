

function admin(id_tbody) {
    $(document).ready(function () {
            let tbody = document.getElementById(id_tbody);
            if (tbody.innerHTML !== "")
                tbody.innerHTML = "";

            $.ajax({
                type: 'GET',
                url: '../api/Admin/AllRequest.php',
                data: 'id=testdata',
                cache: false,
                success: function (result) {
                    const req = JSON.parse(result);
                    let t = $('#example').DataTable();

                    let status = "accepted";
                    for (let i in req) {

                        status = "accepted";
                        if (req[i]["status"] === "-1")
                            status = "rejected"

                        if (req[i]["status"] === "0")
                            continue


                        tbody.innerHTML += `<tr>
                        <td>${req[i]["username"]}</td>
                        <td>${req[i]["Name"]}</td>
                        <td>${req[i]["Author"]}</td>
                        <td>${status}</td>
                        <td>${req[i]["time_request"]}</td>
                        <td>${req[i]["time_check"]}</td>
                    </tr>`;

                    }
                },


            });
        }
    )

}

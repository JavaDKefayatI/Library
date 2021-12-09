function AllReq(){
    $(document).ready(function () {
        $('#example').DataTable();

        $.ajax({
            type: 'POST',
            url: '../api/Admin/AllRequest.php',
            data: 'id=testdata',
            cache: false,
            success: function (result) {
                const req = JSON.parse(result);
                let t = $('#example').DataTable();

                for (let k in req) {
                    if (req[k]["status"] !=="0")continue;

                    t.row.add([
                        req[k]["id"],
                        req[k]["username"],
                        req[k]["Name"],
                        req[k]["Author"],
                        req[k]["time_request"],
                        `<button class='btn btn-success w-75 mb-2' onclick="ruleAdmin(true,${req[k]['id']})" name='accept' >accept</button>`+
                        `<button class='btn btn-danger w-75 ' name='reject' onclick="ruleAdmin(false,${req[k]['id']})">reject</button>`
                    ]).draw(false);
                }
            },

        });
    })

}
function ruleAdmin(is_accept , id){
    $(document).ready(function () {
        let state="accept";
    if (!is_accept)
        state ="reject";

        $.ajax({
            type: 'GET',
            url: '../api/Admin/CheckAdmin.php?'+state+"="+id,
            data: 'id=testdata',
            cache: false,
            success: function (result) {
                const status = JSON.parse(result)["status"];
                if (status==="0")alert("error")
                if (status === "1") {
                    alert("okay")
                    location.reload();
                }

            },

        });
    })

}

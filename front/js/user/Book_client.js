function table_for_return(id_user) {
    $(document).ready(function () {
        $('#example').DataTable();

        $.ajax({
            type: 'GET',
            url: '../api/User/BookUser.php?id_user=' + id_user,
            data: '',
            cache: false,
            success: function (result) {
                const req = JSON.parse(result);
                let t = $('#example').DataTable();


                for (let i = 0; i < req.length; i++) {

                    if (req[i]["status"] === "0" ||
                        req[i]["status"] === "-1" ||
                        req[i]["status"] === "2"
                    )
                        continue;

                        t.row.add([
                            req[i]["username"],
                            req[i]["Name"],
                            req[i]["Author"],
                            `<button name="id" class="btn btn-danger " onclick="setReturn(${req[i]["id"]})">Return</button>`
                        ]).draw(false);

                }
            },


        });
    })

}
function setReturn( id_requet){
    $(document).ready(function () {


        $.ajax({
            type: 'POST',
            url: '../api/User/SetReturn.php?id='+id_requet,
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

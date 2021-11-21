function AllBook(){
        $(document).ready(function () {
            $('#example').DataTable();

            $.ajax({
                type: 'POST',
                url: 'api/Books.php',
                data: 'id=testdata',
                cache: false,
                success: function (result) {
                    const books = JSON.parse(result);
                    let t = $('#example').DataTable();

                    for (let k in books) {
                        let status="Available";

                        let request = `
                                <button type="submit" onclick="setRequest(${books[k]['Id']})"   class="btn btn-success" name="request">request</button></form>
                        `;

                        if (books[k]["status"]==="1") {status="Unavailable";
                            request="";
                        }


                        t.row.add([
                            books[k]["Id"],
                            books[k]["Name"],
                            books[k]["Author"],
                            books[k]["Year"],
                            status,
                           request
                        ]).draw(false);

                    }
                },

            });
        })

    }
    function setRequest( id_book){
        $(document).ready(function () {


            $.ajax({
                type: 'POST',
                url: 'api/SetRequest.php?id_book='+id_book,
                data: 'id=testdata',
                cache: false,
                success: function (result) {
                    const status = JSON.parse(result)["status"];
                    if (status==="0")alert("this request already exists.")
                    if (status === "1") alert("okay")

                },

            });
        })

    }



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
                        if (books[k]["status"]==="1") status="wait";
                        let request = `
                                <form method="post"><button type="submit" value="${books[k]['Id']}"  class="btn btn-success" name="request">request</button></form>
                        `;

                        if (books[k]["status"]==="2") {status="Unavailable";
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



function table(id) {

    $(document).ready(function () {

        $('#example').DataTable();
        let rows ="";
        $(document).ready(function() {
            $('#example').DataTable( {
                "": "api/information/arrays.txt"
            } );
        } );

        $.ajax({
            type: 'POST',
            url: 'includes/ajax.php?index=1',
            data: 'id=testdata',
            cache: false,
            success: function (result) {
                const books = JSON.parse(result)["book"];
                const requests = JSON.parse(result)["requestBook"];
                let t = $('#example').DataTable();
                let request;
                for (let k in books) {

                    status = parseInt(books[k]["state"]);
                    let statement = "";
                    let request = "";
                    let classInput = "";

                    if (status === "0") {
                        statement = "available";
                        request = `<form method="post">  <div>  <label>request</label>
                <input type="checkbox" name="request" value="${books[k]['Id']}""></div></form>   `;
                        classInput = "class=''";
                    }
                    if (status === "1") {
                        statement = "waiting";
                        classInput = "class='bg-warning'";
                    }
                    if (status === "2") {
                        statement = "unavailable";
                        classInput = "class='bg-danger'";
                    }


                    t.row.add([
                        books[k]["Id"],
                        books[k]["Name"],
                        books[k]["Author"],
                        books[k]["Year"],
                        statement,
                        request
                    ]).draw(false);
                }
            },

        });
    })

}
function selectRow(){
    $(document).ready(function() {
        var table = $('#example').DataTable();

        $('#example tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                $(this).css("font-size","70%")

            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $(this).css("font-size","140%")
                // data =table.row(this).data();
                // alert(data[2])
            }
        } );

        $('#button').click( function () {
            table.row('.selected').remove().draw( false );
        } );
    } );
}
function checkState(status) {
    if (status === 0) return "available";
    if (status === 1) return "waiting"; if (status === 2) return "avunavailable";

}
function description() {
    $(document).ready(function() {
        var table = $('#example').DataTable();

        $('#example tbody').on('click', 'tr', function () {
            let data = table.row(this).data();

            return `<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
        <img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

<p>NAME :${data[1]}</p>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>

    </div>
  </div>`

        });

    })
}

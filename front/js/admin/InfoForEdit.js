function getData(id) {
    $(document).ready(function () {

        $('#example').DataTable();

        $.ajax({
            type: 'GET',
            url: '../api/Admin/InformationBookForEdit.php',
            data: 'id=' + id,
            cache: false,
            success: function (result) {
                const info = JSON.parse(result);

                if (info["status"] === "1") {
                    document.getElementById("name").value = info["nameBook"];
                    document.getElementById("author").value = info["author"];
                    document.getElementById("year").value = info["year"];
                } else
                    alert("error")
            },

        });
    })

}

function setData(id_name, id_author, id_year,id ){

    $(document).ready(function () {
        let name = document.getElementById(id_name).value;
        let author = document.getElementById(id_author).value;
        let year = document.getElementById(id_year).value;

        $.ajax({
            type: 'POST',
            url: '../api/Admin/CreateOrEditBook.php',
            data: 'name=' + name + '&' + 'author=' + author + '&year=' + year+'&id='+id,
            cache: false,
            success: function (result) {
                const status = JSON.parse(result)["status"];
                if (status === "1") {   
                    alert("successfully")
                    window.location.replace("LibraryAdmin.php");
                }
                if (status === "2") {
                    alert("this book already accepted for one user")
                    window.location.replace("LibraryAdmin.php");
                }

                else
                    alert("Error");


            },

        });
    })
}
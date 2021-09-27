function setTogglePass(idPassInput, idButtonToggle) {

    const togglePassword = document.getElementById(idButtonToggle)
    const password = document.getElementById(idPassInput)

    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    password.style.borderLeft = "1px solid white";
    password.style.border = "1px solid #50acc7";
    togglePassword.classList.toggle('bi-eye');

}

function checkTwoPassword(id_pass1, id_pass2, id_place_for_alert) {
    insertError(compareTwoPass(id_pass1, id_pass2), "two password is not same", id_place_for_alert)
}


function validEmail(id_email, id_place_for_alert) {

    insertError(checkFormatEmail(id_email), "format email is ---@--- .com", id_place_for_alert)
}

function compareTwoPass(id_pass1, id_pass2) {
    const pass1 = document.getElementById(id_pass1).value;
    const pass2 = document.getElementById(id_pass2).value;

    return pass1 !== pass2
}


function checkFormatEmail(id_email) {
    let regex = /\S+@\S+\.com+/g;

    return !regex.test(document.getElementById(id_email).value);
}

function checkFormatField(text, message, id_place_for_alert) {
    let str = "javad!"
    let re = /^[\w!@#$%^&]+$/;

    insertError(!re.test(str), message, id_place_for_alert)
}

function checkJustNumber(id) {
    const field = document.getElementById(id);
    field.value = field.value.replace(/[^0-9]/g, '');
}

function checkCountPhone(id, id_place_for_alert) {

    insertError(!checkPhone(id), "The phone is less than 11", id_place_for_alert)

}

function insertError(condition, message, id_place_for_alert) {
    let show_error = document.getElementById(id_place_for_alert);

    if (condition) {

        show_error.innerHTML = message;
    } else {
        show_error.innerHTML = "";
    }

}

function checkPhone(id) {
    let str = document.getElementById(id).value;
    return str.length === 11;
}

function getCookie(cname) {
    $(document).ready(function () {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    });


}

function printTd(json, array, otherTd = true) {
    let str = "";
    for (let k in json) {
        str += "<tr>";
        for (let i = 0; i < array.length; i++) {
            str += `<td>${json[k][array[i]]}</td>`
        }
        if (otherTd)
            str += addAcceptOrReject(json[k][array[1]]) + "</tr>";
        else
            str += "</tr>";
    }


    return str;

}

function addAcceptOrReject(id_book) {

    return `<td><form class='pt-2' method = 'post' >
 <button type = "submit" class="bg-danger" name="reject" value="${id_book}">
  <i class="fa fa-times fa-lg  text-white "></i></button>
</form></td>
<td><form method = 'post'>
<button type="submit" name="accept" class="bg-success mt-2" value="${id_book}">
 <i class="fa fa-check text-white "></i>
  </button>
</form>
   </td> `;


}


function onSub(id_form, id_pass1, id_pass2, id_email, id_phone) {
    // let form =document.getElementById("myFForm").submit();
// document.getElementById("po").innerHTML = document.getElementById("submit").type = "submit";
    if (getCookie("-jk-"))
        $(document).ready(function () {
            $(id_form).submit(function (event) {
                if ((compareTwoPass(id_pass1, id_pass2) || checkFormatEmail(id_email) || !checkPhone(id_phone))) {
                    event.preventDefault();
                }
            });
        });
}

function removeSpace(id_field) {
    $(document).ready(function (e) {
        let field = document.getElementById(id_field);
        field.value = field.value.replace(/[^\w!#$%^&@]/g, '');
    });
}


function setTitle(id_title, title) {
    $(document).ready(function () {
        $(id_title).innerHTML = title;
    })

}


function setTable() {

    $(document).ready(function () {

        $('#example').DataTable();

        $.ajax({
            type: 'POST',
            url: 'includes/ajax.php?index=2',
            data: 'id=testdata',
            cache: false,
            success: function (result) {
                const books = JSON.parse(result);
                let t = $('#example').DataTable();

                for (let k in books) {
                    t.row.add([
                        books[k]["Id"],
                        books[k]["Name"],
                        books[k]["Author"],
                        books[k]["Year"],
                        ` <a href='CreateOrEditBook.php?id={$id}' class='mr-1'>
                        <button  class='fa fa-pencil btn bg-transparent  p-1 '>
                        </button>
                        </a>
                        <a href='login/DeleteBook.php?id ={$id}'><button  class='fa fa-trash btn bg-transparent p-1' >
                        </button>
                        </a>`
                    ]).draw(false);

                }
            },

        });
    })

}








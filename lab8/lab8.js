function getDataFromForm() {
    const firstName = document.querySelector('input[name="fname"]').value;
    const lastName = document.querySelector('input[name="lname"]').value;
    runAjax(firstName, lastName);
}

function runAjax(fname, lname) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        if (typeof this.responseText === 'string') {
            document.getElementById('responseString').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", `ajax.php?fname=${fname}&lname=${lname}`, true);
    xhttp.send();
}
function getDataFromForm() {
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    runAjax(firstName, lastName);
}

function runAjax(fname, lname) {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", "./ajax.php?fname=" + fname + "&lname=" + lname, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            if (typeof xhr.responseText === 'string') {
                document.getElementById('responseString').textContent = xhr.responseText;
            }
        }
    };

    xhr.send();
}

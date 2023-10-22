function getDataFromForm() {
    const firstName = document.querySelector('input[name="fname"]').value;
    const lastName = document.querySelector('input[name="lname"]').value;
    runAjax(firstName, lastName);
}

function runAjax(fname, lname) {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", `./ajax.php?fname=${fname}&lname=${lname}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const responseText = xhr.responseText;
            if (typeof responseText === 'string') {
                const responseParagraph = document.getElementById("responseString");
                responseParagraph.textContent = responseText;
            }
        }
    };

    xhr.send();
}
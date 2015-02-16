function hideDiv(divToHide) {
    document.getElementById(divToHide).style.display = "none";
}

function showDiv(divToShow) {
    document.getElementById(divToShow).style.display = "block";
}

function arrayHide(array) {
    // javascript arrays example ["xyz","123"]
    for(i = 0; i < array.length; ++i) {
        hideDiv(array[i]);
    }
}

function arrayShow(array) {
    for(i = 0; i < array.length; ++i) {
        showDiv(array[i]);
    }
}

function hideErrors(array) {
    arrayHide(array);
}

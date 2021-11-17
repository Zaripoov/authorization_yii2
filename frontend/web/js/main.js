//show the confirmation div
function resetDatabase() {
    document.getElementById("confirm").hidden=false
    return false
}

//redirect to the delete profile script
function confirmYes() {
    location.href = '/user/delete';
    return true
}

//hide the confirmation div
function confirmNo() {
    document.getElementById("confirm").hidden=true
    return false
}
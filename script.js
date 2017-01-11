
function validateForm() {
    var x = document.forms["myForm"]["title"].value;
    var y = document.forms["myForm"]["name"].value;
	var filled = x || y;
    if (filled == null || filled == "") {
        alert("Name must be filled out");
        return false;
    }
}

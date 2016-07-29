//Validation options:
// Define valid extension of loaded files
var valid_file_extensions = ["jpg", "jpeg", "bmp", "gif", "png", "pdf", "doc", "docx", "txt"];

//checking whether the form is valid
function is_valid_form() {

    var file_to_upload = document.getElementById("upload_file");
    var file_name = file_to_upload.value;

    if (!is_file_selected(file_name)){
        alert("Please select a file to upload.");
        return false;
    }else
    if (!is_valid_file_ext(file_to_upload)){
        alert("Sorry, file is invalid, allowed extensions are: " + valid_file_extensions.join(", "));
        return false;
    }else
    console.log("File is valid.");
    return true;
}

function is_valid_file_ext(file){
    var file_name = file.value;
    console.log(file_name);
    var valid = false;

    for (var i = 0; i < valid_file_extensions.length; i++) {
        var current_extension = valid_file_extensions[i];
        if (file_name.split(".").pop().toLowerCase() == current_extension.toLowerCase()){
            valid = true;
            break
        }
    }
    return valid;
}

function is_file_selected(name){
    return (name.length > 0);
}
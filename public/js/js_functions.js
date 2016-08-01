//Validation options:
// Define valid extension of loaded files
var valid_file_extensions = ["jpg", "jpeg", "bmp", "gif", "png", "pdf", "doc", "docx", "xls", "ppt", "txt"];




// Get element by ID  (shorter)
function element(id){
    return document.getElementById(id);
}

//Main function for file upload
function uploadFile() {
    if(is_valid_form()){
        var file = element("upload_file");
        var form = element("upload_form");
        var form_data = new FormData();
        form_data.append("upload_file", file);
        var xml = new XMLHttpRequest();
        xml.upload.addEventListener("progress", progressHandler, false);
        xml.addEventListener("load", completeHandler, false);
        xml.addEventListener("error", errorHandler, false);
        xml.addEventListener("abort", abortHandler, false);
        xml.open(form.method, form.action);
        xml.send(form_data);
        return true;
    }
    return false;
}

//checking whether the form is valid
function is_valid_form() {

    var file_to_upload = element("upload_file");
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
    var valid = false;
    var i = 0;
    while(i < valid_file_extensions.length){
        var current_extension = valid_file_extensions[i];
        if (file_name.split(".").pop().toLowerCase() == current_extension.toLowerCase()){
            valid = true;
            break
        }
        i++;
    }
    return valid;
}

function is_file_selected(name){
    return (name.length > 0);
}

// ----EventListener functions -----

//Changes value of Progress bar
function progressHandler(event){
    var percent = (event.loaded/event.total)*100;
    element("progress_bar").value = Math.round(percent);
}

//Sets the value of Progress bar to "0" when file is uploaded
function completeHandler(event){
    element("progress_bar").value = 0;
}

//Show error in console
function errorHandler(event){
    console.log("Upload Failed");
}
function abortHandler(event){
    console.log("Upload Aborted");
}
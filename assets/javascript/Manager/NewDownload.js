//If the editor is close then trigger reset.


var passwordProtected = false;

// When triggered will open download page and allow entering of download infomation.
function newDownload() {

    document.getElementById("downloadEditor").style.display = "flex";
    switchWindow(6);
}


// if the editor has changed form default values then return true
function editorChanges() {

    if (document.getElementById("editorName").value !== "") {
        return true;
    }
}


// Reset the editor to default valus.
function resetEditor() {

    EnabledDisabled(1);
    document.getElementById("editorName").value = "";
}


// Gets the data from the form and then compiles into a json.
// Submits the fform with json data.
function compile() {
    var data = {"Manifest":{}};
    
    data.Manifest.DownloadName = document.getElementById("editorName").value;
    data.Manifest.Enabled = downloadEnabled;
    data.Manifest.Version = document.getElementById("editorVersion").value;
    data.Manifest.Description = document.getElementById("editorDescription").value;
    data.Manifest.CreatorSource = document.getElementById("editorSource").value;
    data.Manifest.Link = document.getElementById("editorLink").value;
    data.Manifest.PasswordProtected = passwordState;
    data.Manifest.Password = document.getElementById("editorPassword").value;

    data.Manifest.VersionGorupName = document.getElementById("editorVGN").value;
    data.Manifest.Branch = document.getElementById("editorBranch").value;
    data.Manifest.VGIDversion = document.getElementById("editorVGIDversion").value;

    document.getElementById("jsonDATA").value = JSON.stringify(data);
    document.getElementById("editorSubmit").submit();
}
//If the editor is close then trigger reset.

// If the editor download is enabled or disabled
var downloadEnabled = true;

// When triggered will open download page and allow entering of download infomation.
function newDownload() {

    document.getElementById("downloadEditor").style.display = "flex";
    switchWindow(6);
}

// Toggle between enabled and dissabled. 
function EnabledDisabled(state) {

    downloadEnabled = state;

    switch (state) {
        case 0:
            document.getElementById("Enabled").style.background = "#323232";
            document.getElementById("Disabled").style.background = "red";
            break;
        case 1:
            document.getElementById("Enabled").style.background = "green";
            document.getElementById("Disabled").style.background = "#323232";
            break;
    }
}

// if the editor has changed form default values then return true
function editorChanges() {

    if(document.getElementById("editorName").value !== "") {
        return true;
    }
}


// Reset the editor to default valus.
function resetEditor() {

    EnabledDisabled(1);
    document.getElementById("editorName").value = "";
}


//
function compile() {
    var data = {"Manifest":{}};
    
    data.Manifest.DownloadName = document.getElementById("editorName").value;
    data.Manifest.Enabled = downloadEnabled;
    data.Manifest.Version = document.getElementById("editorVersion").value;
    
    document.getElementById("jsonDATA").value = JSON.stringify(data);
    document.getElementById("editorSubmit").submit();
}
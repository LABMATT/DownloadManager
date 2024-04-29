// If the editor download is enabled or disabled
var downloadEnabled = true;
var passwordState = false;

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


// When enabled then bring up the password boxes
function passwordProtected(state) {

    passwordState = state;

    switch (state) {
        case 0:
            document.getElementById("passwordStateTrue").style.background = "#323232";
            document.getElementById("passwordStateFalse").style.background = "red";
            document.getElementById("editorPasswordForm").style.display = "none";
            break;
        case 1:
            document.getElementById("passwordStateTrue").style.background = "green";
            document.getElementById("passwordStateFalse").style.background = "#323232";
            document.getElementById("editorPasswordForm").style.display = "block";
            break;
    }
}
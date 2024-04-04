var errorMenuToggleValue = false;
var errorCount = 0;

function errorMenuToggle() {
    
    registerError();
    
    if (errorMenuToggleValue === false) {
        errorMenuToggleValue = true;
        
        document.getElementById("errorMenu").style.display = "flex";
        document.getElementById("downloadEditor").style.display = "none";
        document.getElementById("currentDownloads").style.display = "none";
        document.getElementById("versionDiv").style.display = "none";
    } else {
        errorMenuToggleValue = false;
        
        document.getElementById("errorMenu").style.display = "none";
        document.getElementById("downloadEditor").style.display = "flex";
        document.getElementById("currentDownloads").style.display = "flex";
        document.getElementById("versionDiv").style.display = "flex";
    }
}

function registerError() {
    
    errorCount++;
    document.getElementById("errorMenuButton").innerText = "View Errors (" + errorCount + ")";
}
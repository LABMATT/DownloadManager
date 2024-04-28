// Switches what content on the page is activly been displayed. 
function switchWindow(window) {

    switch (window) {

        // Downloads
        case 1:
            setAllNone();
            document.getElementById("NAVdownload").style.backgroundColor = "red";
            document.getElementById("currentDownloads").style.display = "flex";
            break;

        // versions
        case 2:
            setAllNone();
            document.getElementById("NAVversion").style.backgroundColor = "red";
            document.getElementById("versionDiv").style.display = "flex";
            break;

        // Deleted
        case 3:
            setAllNone();
            document.getElementById("NAVdeleted").style.backgroundColor = "red";
            document.getElementById("DeletedDownlaods").style.display = "flex";
            break;

        // Error
        case 4:
            setAllNone();
            document.getElementById("NAVerror").style.backgroundColor = "red";
            document.getElementById("errorMenu").style.display = "flex";
            break;

        case 5:
            setAllNone();
            document.getElementById("NAVhistory").style.backgroundColor = "red";
            document.getElementById("SignInHistory").style.display = "flex";
            break;

        // Editor window
        case 6:
            setAllNone();
            document.getElementById("NAVdownload").style.backgroundColor = "red";
            document.getElementById("downloadEditor").style.display = "flex";
            break;
    }
}


function setAllNone() {
    document.getElementById("NAVdownload").style.backgroundColor = "black";
    document.getElementById("NAVversion").style.backgroundColor = "black";
    document.getElementById("NAVdeleted").style.backgroundColor = "black";
    document.getElementById("NAVerror").style.backgroundColor = "black";
    document.getElementById("NAVhistory").style.backgroundColor = "black";

    document.getElementById("errorMenu").style.display = "none";
    document.getElementById("downloadEditor").style.display = "none";
    document.getElementById("currentDownloads").style.display = "none";
    document.getElementById("versionDiv").style.display = "none";
    document.getElementById("DeletedDownlaods").style.display = "none";
    document.getElementById("SignInHistory").style.display = "none";
}
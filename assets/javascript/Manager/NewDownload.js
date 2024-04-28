var downloadEnabled = true;

// When triggered will open download page and allow entering of download infomation.
function newDownload() {

    document.getElementById("downloadEditor").style.display = "flex";
    switchWindow(6);
}

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
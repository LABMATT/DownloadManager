// This function updates the console with a wget link. Then depending on what value auto had it either auto downloads or sets up the page for manual download.
var copyCount = 0;

function updateWGET(hostName, dlid, fileName, auto) {

    var fileLocationOnServer = hostName + '/' + 'Downloads/' + dlid + '/' + fileName;
    var fileOnServer = 'Downloads/' + dlid + '/' + fileName;

    // Update the wget.
    document.getElementById('wget').innerHTML = "sudo wget --content-disposition \"" + fileLocationOnServer + "\"";

    // Update the button herf.
    document.getElementById('dwll').href = fileOnServer;

// Clicks the button if its an auto download.
    if (auto == 1) {
        document.getElementById("action").innerText = "Your download should start automatically. If not click the button below.";
        document.getElementById("dwll").style.display = "block";
        document.getElementById('dwlb').click();
    } else if (auto == 0) {
        document.getElementById('action').innerHTML = "Click To Start Download.";
        document.getElementById("dwll").style.display = "block";
    } else {
        document.getElementById('msg').style.color = "red";
        document.getElementById('msg').innerHTML = "Your download auto option was invlaid: <br> - 0 = Start Download Manualy. <br> - 1 = Start Download Automaticly. <br> - 2 = DIRECT REDIRECT. (You should not be seeing this page)";
    }
}

// When clicked copy the wget text to clipboard
function copy() {

    var wgetBox = document.getElementById("wget");
    var wgettitle = document.getElementById("wgettitle");

    navigator.clipboard.writeText(document.getElementById("wget").textContent);

    if (!wgetBox.classList.contains("wgetHighlight")) {
        wgetBox.classList.add("wgetHighlight");
        setTimeout(function () {
            wgetBox.classList.remove("wgetHighlight");
        }, 700)

        copyCount++;

        if (copyCount == 1) {
            wgettitle.innerText = "WGET for linux terminals Copied!:"
        } else {
            wgettitle.innerText = "WGET for linux terminals Copied! x" + copyCount + ":"
        }
    }

}

// Use Json data to fill the webpage.
function updatePage(fileJson, dlid, auto, hostName) {
    console.log(fileJson);

    document.getElementById("pname").innerHTML = fileJson.downloadName;
    document.getElementById("pversion").innerHTML = fileJson.version;
    document.getElementById("pdatec").innerHTML = fileJson.dateCreated;
    document.getElementById("pdatem").innerHTML = fileJson.dateLastModifed;
    document.getElementById("ptype").innerHTML = fileJson.type;
    document.getElementById("pdescription").innerHTML = fileJson.description;
    document.getElementById("pcreatorSource").innerHTML = fileJson.creatorSource;
    document.getElementById("plink").innerHTML = fileJson.link;
    document.getElementById("pnumberOfDownloads").innerHTML = fileJson.numberOfDownloads;
    document.getElementById("psize").innerHTML = fileJson.fileSize;
    
    // Change the tab name to file name downlaod
    var ntitle =  fileJson.downloadName.charAt(0).toUpperCase() +  fileJson.downloadName.slice(1);
    document.title = ntitle + " Download";

    updateWGET(hostName, dlid, fileJson.fileName, auto);
}

// If download has been removed from server then display this.
function downloadRemoved(reason, downloadName) {
    console.log(reason);
    
    document.getElementById("MainContent").remove();
    document.getElementById("action").innerText = " DOWNLOAD NO LONGER AVAIBLE: " + reason;
    document.getElementById("action").style.fontWeight = "bold";
    document.getElementById("action").style.color = "red";
}

function cleanup() {
    
    downloadRemoved("", "");
}
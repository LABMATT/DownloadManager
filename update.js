// This function updates the console with a wget link. Then depending on what value auto had it either auto downloads or sets up the page for manual download.
function updateWGET(hostName, dlid, fileName, auto) {
    
    var fileLocationOnServer = hostName + '/' + 'Downloads/' + dlid + '/' + fileName;
    var fileOnServer = 'Downloads/' + dlid + '/' + fileName;
    
    // Update the wget.
    document.getElementById('wget').innerHTML = "sudo wget --content-disposition \"" + fileLocationOnServer + "\"";

    // Update the button herf.
    document.getElementById('dwll').href = fileOnServer;

// Clicks the button if its an auto download.
    if (auto == 1) {
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


// Changes the title of the page to the new download name. Auto caps and all.
function titlepd(ntitle) {
    ntitle = ntitle.charAt(0).toUpperCase() + ntitle.slice(1);
    document.title = ntitle + " Download";
}


// When clicked copy the wget text to clipboard
function copy() {
    console.log("copied!");
    navigator.clipboard.writeText(document.getElementById("wget").textContent);
    document.getElementById("copyed").style.display = "block";
}

// If an error occures then hide the blank stuff. Still gonna keep the table because it ads structure however the wget windows gotta go.
function cleanup() {
    document.getElementById("wgettitle").style.display = "none";
    document.getElementById("wget").style.display = "none";
}

// Use Json data to fill the webpage.
function updatePage(fileJson, dlid, auto, hostName) {
    console.log(fileJson);

    document.getElementById("pname").innerHTML = fileJson.downloadName;
    document.getElementById("pdatec").innerHTML = fileJson.dateCreated;
    document.getElementById("pdatem").innerHTML = fileJson.dateLastModifed;
    document.getElementById("ptype").innerHTML = fileJson.type;
    document.getElementById("psize").innerHTML = fileJson.fileSize;
    
    updateWGET(hostName, dlid, fileJson.fileName, auto);
}
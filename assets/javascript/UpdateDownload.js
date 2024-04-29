// Receives a json file from the php script. Then process it onto the page as the downlaod page.

function updatePage(rawJSON, hostData) {

    console.log(rawJSON);

    //var json = JSON.parse(rawJSON);

    document.getElementById("pname").innerHTML = rawJSON.Manifest.DownloadName;
    /*
    document.getElementById("pversion").innerHTML = fileJson.version;
    document.getElementById("pdatec").innerHTML = fileJson.dateCreated;
    document.getElementById("pdatem").innerHTML = fileJson.dateLastModifed;
    document.getElementById("ptype").innerHTML = fileJson.type;
    document.getElementById("pdescription").innerHTML = fileJson.description;
    document.getElementById("pcreatorSource").innerHTML = fileJson.creatorSource;
    document.getElementById("plink").innerHTML = fileJson.link;
    document.getElementById("pnumberOfDownloads").innerHTML = fileJson.numberOfDownloads;
    document.getElementById("psize").innerHTML = fileJson.fileSize;
    */
}
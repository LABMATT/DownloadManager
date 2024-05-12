var downloadID = null;

// Initialsies anything that needs to be setup
function init() {
    
    document.getElementById("wget").addEventListener("click", copy);
    document.getElementById("dwll").addEventListener("click", downloadClicked);
}

function setDLID(indlid) {
    
    downloadID = indlid;
}

function downloadClicked() {

    console.log("DOWNLAOD INCRMENT");

    //document.getElementById("iframe").style.display = "none";
    //document.getElementById("iframe").src = "DownloadIncCall.php?dlid=" . downloadID;

    document.getElementById("iframe").src = "DownloadIncCall.php?dlid=".downloadID;

}
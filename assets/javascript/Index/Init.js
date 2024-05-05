var downloadID = null;

// Initialsies anything that needs to be setup
function init() {
    
    document.getElementById("wget").addEventListener("click", copy);
    document.getElementById("dwll").addEventListener("click", downloadClicked);
}

function setDLID(indlid) {
    
    downloadID = indlid;
}


function downloadClicked() {
    
    const xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("GET", "DownloadIncCall.php?dlid=" . downloadID);
    xmlhttp.send();
    
    
}

// If there is no downloads to display then hide the entry land display the words no downloads.
function hideDownloads() {

    document.getElementById("downloadMessage").innerText = "NO DOWNLOADS TO DISPLAY";
    document.getElementById("downloadListNoDisplay").style.display = "flex";
    document.getElementById("downloadList").style.display = "none";
}

// if there were entrys to display then remove the message and shopw the download list.
function displayDownloads() {

    document.getElementById("downloadListNoDisplay").style.display = "none";
    document.getElementById("downloadList").style.display = "block";

}
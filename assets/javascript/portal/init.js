
// Runs when main page body loads.
function init() {

    document.getElementById("downloadListNoDisplay").style.display = "flex";
    document.getElementById("downloadList").style.display = "none";

    hideDownloads();
    setInterval(displayDownloads,500);
    setInterval(createEntry, 1000);
}
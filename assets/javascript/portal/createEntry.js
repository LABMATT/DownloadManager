
// Credates a entry for a download on the portal page.
function createEntry() {

// Main list div that all our entrys get added to.
const downloadList = document.getElementById("downloadList");

// New entry to be added in.
var newEntry = document.createElement("div");
newEntry.classList.add("downloadListEntry");


// All the info part of the download entry.
var downloadListEntryInfo = document.createElement("div");
downloadListEntryInfo.classList.add("downloadListEntryInfo");

newKeyValue(downloadListEntryInfo, "TITLE&#x2022;&nbsp;", "Test Title");
newKeyValue(downloadListEntryInfo, "ID&#x2022;&nbsp;", "Test ID");
newKeyValue(downloadListEntryInfo, "UPLOADED&#x2022;&nbsp;", "Test date");
newKeyValue(downloadListEntryInfo, "CREATED&#x2022;&nbsp;", "Test date2");
newKeyValue(downloadListEntryInfo, "Size&#x2022;&nbsp;", "Test size");
newKeyValue(downloadListEntryInfo, "version&#x2022;&nbsp;", "Test version");
newEntry.append(downloadListEntryInfo);


// Button controlls for the entry.
var downloadListButtons = document.createElement("div");
downloadListButtons.classList.add("downloadListButtons");

newButton(downloadListButtons, "VIEW", "");
newButton(downloadListButtons, "DOWNLOAD", "");
newButton(downloadListButtons, "SHARE", "");
newButton(downloadListButtons, "WGET", "");
newEntry.append(downloadListButtons);


// Add our newly made download entry to the list div.
downloadList.append(newEntry);
}


// Crates a p tag with the key and value for the downloads info. Appends this to the main.
function newKeyValue(element, key, value) {

    var downloadListEntryInfoKey = document.createElement("p");
    downloadListEntryInfoKey.classList.add("downloadListEntryInfoKEY");
    downloadListEntryInfoKey.innerHTML = key;
    element.append(downloadListEntryInfoKey);

    var downloadListEntryInfoValue = document.createElement("p");
    downloadListEntryInfoValue.innerText = value;
    element.append(downloadListEntryInfoValue);
}


// Creates a button on the rightside of the entery for download or action.
function newButton(element, buttonText, buttonlink) {

    var downloadButton = document.createElement("p");
    downloadButton.classList.add("downloadListButton");
    downloadButton.innerText = buttonText;
    element.append(downloadButton);
}
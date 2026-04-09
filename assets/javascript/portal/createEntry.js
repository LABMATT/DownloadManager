
// Credates a entry for a download on the portal page.
function createEntry(appendElement) {

// If the method within createEntry is blank then assume were apending to the downlaodlist Else we can also create the mangment protal box
const downloadList = document.getElementById("downloadList");

// New entry to be added in.
var newEntry = document.createElement("div");
newEntry.classList.add("downloadListEntry");


// All the info part of the download entry.
var downloadListEntryInfo = document.createElement("div");
downloadListEntryInfo.classList.add("downloadListEntryInfo");

newKeyValue(downloadListEntryInfo, "TITLE&#x2022;&nbsp;", "Test Title");
newKeyValue(downloadListEntryInfo, "ID&#x2022;&nbsp;", "Test ID");
newKeyValue(downloadListEntryInfo, "Created&#x2022;&nbsp;", "Test date2");
newKeyValue(downloadListEntryInfo, "Size&#x2022;&nbsp;", "Test size");
newKeyValue(downloadListEntryInfo, "Version&#x2022;&nbsp;", "Test version");
newKeyValue(downloadListEntryInfo, "Tags&#x2022;&nbsp;", "Test version");

// Extra info
newKeyValue(downloadListEntryInfo, "Tags&#x2022;&nbsp;", "Test version", "idtemp", "#008000");
newEntry.append(downloadListEntryInfo);


// Button controlls for the entry.
var downloadListButtons = document.createElement("div");
downloadListButtons.classList.add("downloadListButtons");

newButton(downloadListButtons, "VIEW", "");
newButton(downloadListButtons, "DOWNLOAD", "");
newButton(downloadListButtons, "SHARE", "");
newButton(downloadListButtons, "META", "");
newEntry.append(downloadListButtons);


// Add our newly made download entry to the list div.
downloadList.append(newEntry);
}


// Crates a new keypair and value. Appends this to the main.
function newKeyValue(element, key, value, elementID, keyColour) {

    if (!keyColour) {
        keyColour = "#969696";
    }

    var downloadListEntryInfoKey = document.createElement("p");
    downloadListEntryInfoKey.classList.add("downloadListEntryInfoKEY");
    downloadListEntryInfoKey.style.color = keyColour;
    downloadListEntryInfoKey.innerHTML = key;
    element.append(downloadListEntryInfoKey);

    var downloadListEntryInfoValue = document.createElement("p");
    downloadListEntryInfoValue.id = elementID;
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
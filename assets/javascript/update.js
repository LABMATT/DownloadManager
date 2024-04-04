// This function updates the console with a wget link. Then depending on what value auto had it either auto downloads or sets up the page for manual download.
function updateinfo(url, auto, dyn)
{
    console.log("Relative wget link(Location of this file may change): download.labmatt.space/" + url);
    console.log("Dynamic wget link(Location of this file is pointed to by php): ");
    console.log(dyn);
    console.log("Or copy this into terminal: ");
    console.log("sudo wget --content-disposition \"" + dyn + "\"");
    document.getElementById('wget').innerHTML = "sudo wget --content-disposition \"" + dyn + "\"";


document.getElementById('dwll').href = url;

// Clicks the button if its an auto download.
if(auto == 1)
{
    document.getElementById("dwll").style.display = "block";
    document.getElementById('dwlb').click();
} else if (auto == 0)
{
    document.getElementById('action').innerHTML = "Click To Start Download.";
    document.getElementById("dwll").style.display = "block";
} else{
    document.getElementById('msg').style.color = "red";
    document.getElementById('msg').innerHTML = "Your download auto option was invlaid: <br> - 0 = Start Download Manualy. <br> - 1 = Start Download Automaticly. <br> - 2 = DIRECT REDIRECT. (You should not be seeing this page)";
}
}


// Changes the title of the page to the new download name. Auto caps and all.
function titlepd(ntitle)
{
    ntitle = ntitle.charAt(0).toUpperCase() + ntitle.slice(1);
    document.title = ntitle + " Download";
}


// Update the propiteys info of the webpage
function updateProp(name, created, modfied, filetype ,size)
{
    document.getElementById("pname").innerHTML = name;
    document.getElementById("pdatec").innerHTML = created;
    document.getElementById("pdatem").innerHTML = modfied;
    document.getElementById("ptype").innerHTML = filetype;
    document.getElementById("psize").innerHTML = size;
}


// When clicked copy the wget text to clipboard
function copy()
{
    console.log("copied!");
    navigator.clipboard.writeText(document.getElementById("wget").textContent);copyed
    document.getElementById("copyed").style.display = "block";
}

// If an error occures then hide the blank stuff. Still gonna keep the table because it ads structure however the wget windows gotta go.
function cleanup()
{
    document.getElementById("wgettitle").style.display = "none";
    document.getElementById("wget").style.display = "none";
}
<<<<<<< Updated upstream:update.js
=======

// If download has been removed from server then display this.
function downloadRemoved(reason, downloadName) {
    console.log(reason);
    
    document.getElementById("MainContent").remove();
    document.getElementById("action").innerText = " DOWNLOAD NO LONGER AVAILABLE: " + reason;
    document.getElementById("action").style.fontWeight = "bold";
    document.getElementById("action").style.color = "red";
}

function cleanup() {
    
    downloadRemoved("", "");
}
>>>>>>> Stashed changes:assets/javascript/update.js

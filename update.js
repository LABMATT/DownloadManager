console.log("found");

function updateinfo(url, auto)
{
    console.log("Relative wget link(Location of this file may change): download.labmatt.space/" + url);
    console.log("Dynamic wget link(Location of this file is pointed to by php): download.labmatt.space/");

document.getElementById('dwll').href = url;

// Clicks the button if its an auto download.
if(auto == 1)
{
    document.getElementById("dwll").style.display = "block";
    document.getElementById('dwlb').click();
} else if (auto == 0)
{
    document.getElementById('action').innerHTML = "Click Download To Start Download.";
} else{
    document.getElementById('msg').style.color = "red";
    document.getElementById('msg').innerHTML = "Your download starting option was invlaid. Auto: <br> - 1 = Start Download Automaticly. <br> - 0 = Start Download Manualy.";
}
}

// Changes the title of the page to the new download name. Auto caps and all.
function titlepd(ntitle)
{
    ntitle = ntitle.charAt(0).toUpperCase() + ntitle.slice(1);
    document.title = ntitle + " Download";
}
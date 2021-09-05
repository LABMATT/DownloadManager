console.log("found");

function updateinfo(url, auto)
{
    console.log("ready!");
console.log("The url: " + url);
console.log("The auto: " + auto);

document.getEkenentById('dwll').href = url;

// Clicks the button if its an auto download.
if(auto == 1)
{
    document.getElementById('dwlb').click();
}
}
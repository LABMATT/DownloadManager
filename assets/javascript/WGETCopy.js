var copyCount = 0;

// When clicked copy the wget text to clipboard
function copy() {

    var wgetBox = document.getElementById("wget");
    var wgettitle = document.getElementById("wgettitle");

    navigator.clipboard.writeText(document.getElementById("wget").textContent);

    if (!wgetBox.classList.contains("wgetHighlight")) {
        
        wgetBox.classList.add("wgetHighlight");
        setTimeout(function () {
            
            wgetBox.classList.remove("wgetHighlight");
        }, 700)

        copyCount++;

        if (copyCount == 1) {
            wgettitle.innerText = "WGET for linux terminals Copied!:"
        } else {
            wgettitle.innerText = "WGET for linux terminals Copied! x" + copyCount + ":"
        }
    }

}
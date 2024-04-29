var copyCount = 0;

// When clicked copy the wget text to clipboard
function copy() {

    var wgetBox = document.getElementById("wget");
    var wgettitle = document.getElementById("wgettitle");


    try {

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
    } catch (e) {

        console.log("Failed To Copy To Clipboard! Make Sure Its A HTTPS Site.");
        wgettitle.innerText = "WGET: Failed To Copy (You might have to copy manualy)...";
        wgettitle.style.backgroundColor = "red";
        wgettitle.style.color = "white";
    }

}


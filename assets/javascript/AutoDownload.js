// Checks what status auto is and actions based on status.
function autoAction(auto) {

    // Clicks the button if its an auto download.
    if (auto == 1) {
        
        document.getElementById("action").innerText = "Your download should start automatically. If not click the button below.";
        document.getElementById('dwll').click();
    } else if (auto == 0) {
        
        document.getElementById('action').innerHTML = "Click To Start Download.";
    }
}
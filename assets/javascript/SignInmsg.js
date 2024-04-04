function failedLogin(timeout, msg) {
    document.getElementById("submit").style.display = "none";
    document.getElementById("msg").style.display = "block";
    document.getElementById("msg").innerText = msg;
    
    setTimeout(() => {location.reload()}, timeout)
}
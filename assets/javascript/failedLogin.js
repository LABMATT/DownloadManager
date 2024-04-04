// On failed login then replace submit with the message. then set a timer for page reload
function failedLogin(msg, timer) {
    document.getElementById("submit").style.display = "none";
    document.getElementById("msg").style.display = "block";
    document.getElementById("msg").innerText = msg;
    
    setTimeout(()=>{location.reload()}, timer);
}
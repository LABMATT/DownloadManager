<?php
// Sends a message back to the bottom of the login form, has colour and the message. 
function msg($color, $message)
{
    echo "<script>document.getElementById('msg').style.color = '" . $color . "'; </script>";
    echo "<script>document.getElementById('msg').innerHTML = '" . $message . "'; </script>";

    if ($color == "red") {
        echo "<script>cleanup();</script>";
    }
}
?>
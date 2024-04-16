<?php

// On a login failed event then provid an error message.
// msg is the displaed message.
// reload timer is the time till page reload or "0" for no reload. This is milliseconds
function failedLogin($msg, $reloadTimer)
{
    echo "<script>failedLogin(\"" . $msg ."\", " . $reloadTimer . ");</script>";
}

?>
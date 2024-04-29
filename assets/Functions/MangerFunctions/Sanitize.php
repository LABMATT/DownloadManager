<?php

// Makes sure its only digits
function sanitize($inDLID)
{

    $patten = "/\D/";
    $result = preg_match($patten, $inDLID);

    if ($result == 0) {

        return true;
    } else {
        
        return false;
    }
}

?>
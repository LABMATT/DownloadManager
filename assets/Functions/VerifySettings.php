<?php

// Verifys that the Downloads Manifest is readable. 
function VerifySettings($inJSON)
{

    // Makes sure the dlid exists in the database. Then verify the intergity of the manifest.
    try {
        if (!isset($inJSON->Settings)) {
            throw new Exception("Settings Format Error(Line 2).");
        }
        if (!isset($inJSON->Settings->HostName)) {
            throw new Exception("Settings Format Error(Line 3).");
        }
        if (!isset($inJSON->Settings->AutoDetectDarkTheme)) {
            throw new Exception("Settings Format Error(Line 4).");
        }

        return true;

    } catch (Exception $exception) {

        echo $exception;
        // MSG eception
        return false;
    }
}

?>
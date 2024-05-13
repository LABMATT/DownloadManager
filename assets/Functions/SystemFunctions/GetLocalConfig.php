<?php

// Gets the config file from the websites location. 
// This Local Config allows you to set where the settings and file info will be stored. 
// If not found then throw and critical error to webpage.
function GetLocalConfig() {

    $localConfigPath = "LocalConfig.json";
    $configContents = null;
    $errorFlag = false;

    if(file_exists($localConfigPath) && is_readable($localConfigPath)) {

        $configContents = file_get_contents($localConfigPath);
    } else {

        $errorFlag = true;
    }


    if($configContents == false || $configContents == null) {

        $errorFlag = true;
    }


    // Throw error to page.
    if($errorFlag) {

        spawnError("GetLocalConfig", "The server is unable to access required files \"LocalConfig.json\" and thus not able to create settings, manifests and system variables.");
    }

    return $configContents;
}

?>
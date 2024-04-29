<?php

// Gets the contents of the settings file.
function getSettings()
{
    $projectPath = GetSystemPath("DownloadManager");
    $projectPath = $projectPath . DIRECTORY_SEPARATOR . "Config";
    
    $manifest = null;
    
    // Check if the Manifest folder exists
    if(!is_dir($projectPath)) {
        
        mkdir($projectPath);
    }
    
    // IF they folder exist then make sure that we get the contents of the manifest
    $validDLID = false;
    if(is_file($projectPath . DIRECTORY_SEPARATOR . "Settings.json")) {
        
        $validDLID = true;
    } else {
        
        copy("assets\Templates\SETTINGS_TEMPLATE.json", $projectPath . DIRECTORY_SEPARATOR . "Settings.json");
    }
    
    if($validDLID) {
        
        $manifest = file_get_contents($projectPath . DIRECTORY_SEPARATOR . "Settings.json");
    }
    
    return $manifest;
}
?>
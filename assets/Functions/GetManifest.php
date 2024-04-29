<?php

require("assets\Functions\LoginFunctions\ProgramFiles.php");

// Gets a Manifest based on the DLID.
function getManifest($dlid)
{
    $projectPath = GetSystemPath("DownloadManager");
    $projectPath = $projectPath . DIRECTORY_SEPARATOR . "Manifests";
    
    $manifest = null;
    
    // Check if the Manifest folder exists
    if(!is_dir($projectPath)) {
        
        mkdir($projectPath);
    }
    
    // IF they folder exist then make sure that we get the contents of the manifest
    $validDLID = false;
    if(is_file($projectPath . DIRECTORY_SEPARATOR . "dlid_" . $dlid . ".json")) {
        
        $validDLID = true;
    }
    echo "op";
    
    if($validDLID) {
        
        $manifest = file_get_contents($projectPath . DIRECTORY_SEPARATOR . "dlid_" . $dlid . ".json");
    }
    
    // Decode into json format.
    /*
    if ($manifest != null) {
        
        $manifest = json_decode($manifest);
        echo "JSON decoded";
    }
    */
    
    return $manifest;
}
?>
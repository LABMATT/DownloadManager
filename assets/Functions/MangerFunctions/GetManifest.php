<?php



// Gets a Manifest based on the DLID.
function getManifest($dlid)
{
    $projectPath = GetSystemPath("DownloadManager");
    $projectPath = $projectPath . DIRECTORY_SEPARATOR . "Manifests";
    
    $manifest = null;
    $validDLID = false;
    
    // Check if the Manifest folder exists
    if(!is_dir($projectPath)) {
        
        mkdir($projectPath);
    }
    
    // IF they folder exist then make sure that we get the contents of the manifest
    if(is_file($projectPath . DIRECTORY_SEPARATOR . "dlid_" . $dlid . ".json")) {
        
        $validDLID = true;
    }
    
    if($validDLID) {
        
        $manifest = file_get_contents($projectPath . DIRECTORY_SEPARATOR . "dlid_" . $dlid . ".json");
    }
    
    return $manifest;
}
?>
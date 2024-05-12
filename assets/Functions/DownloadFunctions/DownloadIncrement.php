<?php
// Gets the manifest and adds one to the download count. At this stage we have already checked if everything is valid.
function addDownload($dlid) {
    
    $projectPath = GetSystemPath("DownloadManager");
    $projectPath = $projectPath . "Manifests" . DIRECTORY_SEPARATOR . "dlid_" . $dlid . ".json";
    
    $dlidFile = getManifest($dlid);
    $wrfile = false;
    
    $json = json_decode($dlidFile);
    
    if($json != null) {
            
            $json->Manifest->Downloads = (int) $json->Manifest->Downloads + 1;
        
        
        $json = json_encode($json, JSON_PRETTY_PRINT);
        
        $wrfile = file_put_contents($projectPath, $json);
        
    }
    
    if(!$wrfile || $json == null) {
        
        logError("addDownload", "Failed to increment downloads on dlid_" . $dlid . " With Write: " . $wrfile . " With ValidJSON: " . $json);
    }
}
?>
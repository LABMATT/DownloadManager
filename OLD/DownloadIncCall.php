<?php

require "assets\Functions\ErrorLog.php";
require "assets\Functions\SystemFunctions\ProgramFiles.php";
require "assets\Functions\MangerFunctions\VerifyManifest.php";
require "assets\Functions\MangerFunctions\GetManifest.php";
require "assets\Functions\DownloadFunctions\DownloadIncrement.php";
require "assets\Functions\MangerFunctions\Sanitize.php";

$inDLID = htmlspecialchars($_GET["dlid"] ?? null);
$inDLIDFlag = sanitize($inDLID);

if($inDLIDFlag && $inDLID != null) {
    
    $manifest = getManifest($inDLID);
    $verifyJson = false;
    
    if($manifest != null) {
        
        $mjson = json_decode($manifest);
        
        $verifyJson = VerifyJSONManifest($mjson, $inDLID);
    }
    
    
    if($verifyJson == true) {
        
        addDownload($inDLID);
        echo "Download Added: " . $inDLID;
    }
}
?>
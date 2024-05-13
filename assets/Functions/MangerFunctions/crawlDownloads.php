<?php

require "assets/Functions/SystemFunctions/ProgramFiles.php";
require "assets/Functions/MangerFunctions/VerifyManifest.php";

$path = GetSystemPath("DownloadManager") . DIRECTORY_SEPARATOR . "Manifests";

// Grab the folders that are located in the downloads folder.
$scanedDIR = scandir($path);

// Loop to each folder.
// Check if is in the main manifest.
// Check that all its content still matches up.
// Check that local manifest exits.
// Echo the html strings into the downlaods list aswell as info required from local manifest.
foreach ($scanedDIR as $file) {
    if($file != "." && $file != "..") {
        
        $dlid = str_replace("dlid_", "", $file);
        $dlid = str_replace(".json", "", $dlid);
    
        $file = file_get_contents($path . DIRECTORY_SEPARATOR .$file);
        
        if($file != false && strlen($file) > 0) {
            
            $json = json_decode($file);
            
            VerifyJSONManifest($json, $dlid);
            
            echo "<div class=\"existingDownload\">";
            echo "<p class=\"txtContent\">" . $json->Manifest->DownloadName ."</p>";
            echo "<a class=\"txtContent\" href=\"http://localhost/DownloadManager/?dlid=1&auto=0\" target=\"_blank\">DLID: " . $dlid . "</a>";
            echo "<p class=\"txtContent\">VGID: " . $json->Manifest->VersionGroupID ."</p>";
            echo "<p class=\"txtContent\">Version: " . $json->Manifest->Version ."</p>";
            echo "<p class=\"txtContent\">Filetype: " . $json->Manifest->FileType . "</p>";
            echo "<p class=\"txtContent\">Size: " . $json->Manifest->FileSize ."</p>";
            echo "<p class=\"txtContent\">Enabled: " . $json->Manifest->Enabled . "</p>";
            echo "<button class=\"modiferButtons\">View Data</button>";
            echo "<button class=\"modiferButtons\">Delete</button>";
            echo "<button class=\"modiferButtons\">Edit</button>";
            echo "</div>";
            
            echo "<script>dlidAdd(" . $dlid . ", " . $file .");</script>";
        } 
    }
}
?>
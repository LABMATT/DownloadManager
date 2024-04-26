<?php
require("verifyLocalManifest.php");
require("verifyManifest.php");

// Grab the folders that are located in the downloads folder.
$scanedDIR = scandir("Downloads");

try {
    //print_r(verifyManifest($folder));
} catch (Exception $e) {
    
}


// Loop to each folder.
// Check if is in the main manifest.
// Check that all its content still matches up.
// Check that local manifest exits.
// Echo the html strings into the downlaods list aswell as info required from local manifest.
foreach ($scanedDIR as $folder) {
    if($folder != "." && $folder != "..") {
        try {
            
            echo "<br><br>";
            print_r(verifyLocalManifest($folder));
        }catch (Exception $e) {
            
        }
    }
}
?>
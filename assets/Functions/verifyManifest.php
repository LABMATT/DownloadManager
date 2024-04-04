<?php
// Checks MANIFEST exists and verifys content.

function verifyManifest($indlid)
{
    // $mainManifestJsonData->downloads->dlid_1->downloadName;
    $dlidStr = "dlid_" . $indlid;

    $mainManifestJsonData = 0;

    try {
        
        $manifestFileLocation = "assets\json\Manifest.json";

        // This block checks if the manifest: exists -> is readable -> has some content : ultmatly meaning that we can try read contents.
        if (file_exists($manifestFileLocation)) {
            if (is_readable($manifestFileLocation)) {
                if (filesize($manifestFileLocation) == 0) {
                    throw new Exception("Server Manifest File Is Empty.");
                }
            } else {
                throw new Exception("Server Does Not Have Permission To Access Manifest File.");
            }

        } else {
            throw new Exception("No Server Manifest File Found.");
        }


        // Now we have covered most common errors, we can get the contents of the manifest.json then cast it to a object.
        $mainManifestFile = file_get_contents("$manifestFileLocation");
        $mainManifestJsonData = json_decode($mainManifestFile);


        // Makes sure the dlid exists in the database. Then verify the intergity of the manifest.
        if (isset($mainManifestJsonData->downloads->$dlidStr)) {
            if (!isset($mainManifestJsonData->downloads->$dlidStr->downloadName)) {
                throw new Exception("Server Manifest Format Error(1) in DLID: " . $indlid);
            }
            if (!isset($mainManifestJsonData->downloads->$dlidStr->status)) {
                throw new Exception("Server Manifest Format Error(2) in DLID: " . $indlid);
            }
            if (!isset($mainManifestJsonData->downloads->$dlidStr->reason)) {
                throw new Exception("Server Manifest Format Error(3) in DLID: " . $indlid);
            }
            if (!isset($mainManifestJsonData->downloads->$dlidStr->passwordProtected)) {
                throw new Exception("Server Manifest Format Error(4) in DLID: " . $indlid);
            }
        } else {
            throw new Exception("Error: No Download Found OR Server Manifest Is Formatted Incorrectly. ");
        }
        
        
         // Then verify the intergity of the settings in the main manifest.
        if (isset($mainManifestJsonData->settings)) {
            if (!isset($mainManifestJsonData->settings->hostName)) {
                throw new Exception("Server Manifest Settings Format Error(1).");
            }
            if (!isset($mainManifestJsonData->settings->displayGithub)) {
                throw new Exception("Server Manifest Settings Format Error(2).");
            }
            if (!isset($mainManifestJsonData->settings->forceDisplayWGET)) {
                throw new Exception("Server Manifest Settings Format Error(3).");
            }
            if (!isset($mainManifestJsonData->settings->autoDetectDarkTheme)) {
                throw new Exception("Server Manifest Settings Format Error(4).");
            }
        } else {
            throw new Exception("Server Manifest Is Formatted Incorrectly. Unable To Find Settings.");
        }
        

    } catch (Exception $e) {

        msg("red", $e->getMessage());
        return 0;
    }

    return $mainManifestJsonData;
}

?>
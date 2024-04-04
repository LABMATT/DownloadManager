<?php
// Checks the download folder exists and that the LocalManifest exist in it. Then checks and grabs data from that manafest.

function verifyLocalManifest($dlid)
{

    $dlidStr = "dlid_" . $dlid;

    try {

        // Make sure the downloads directory exists.
        if (!is_dir("Downloads")) {
            throw new Exception("Download Directory not found.");
        }

        // Make sure the download id exits in the downloads folder.
        if (!is_dir("Downloads" . DIRECTORY_SEPARATOR . $dlid)) {
            throw new Exception("Download Not Found in Directory.");
        }


        $localManifestLocation = "Downloads" . DIRECTORY_SEPARATOR . $dlid . DIRECTORY_SEPARATOR . "LocalManifest.json";

        // This block checks if the Localmanifest: exists -> is readable -> has some content : ultmatly meaning that we can try read contents.
        if (file_exists($localManifestLocation)) {
            if (is_readable($localManifestLocation)) {
                if (filesize($localManifestLocation) == 0) {
                    throw new Exception("Local Download Manifest File Is Empty.");
                }
            } else {
                throw new Exception("Server Does Not Have Permission To Access Downloads Local Manifest File.");
            }

        } else {
            throw new Exception("No Local Manifest File Found In Download Folder.");
        }


        // Now we have covered most common errors, we can get the contents of the LocalManifest.json then cast it to a object.
        $localManifestFile = file_get_contents($localManifestLocation);
        $localManifestJsonData = json_decode($localManifestFile);


        // Verify the intergity of the LocalManifest.
        if (isset($localManifestJsonData->$dlidStr)) {
            if (!isset($localManifestJsonData->$dlidStr->downloadName)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 3) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->fileName)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 4) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->version)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 5) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->dateCreated)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 6) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->dateLastModifed)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 7) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->type)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 8) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->description)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 9) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->creatorSource)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 10) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->link)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 11) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->numberOfDownloads)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 12) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->fileSize)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 13) in DLID: " . $dlid);
            }
            if (!isset($localManifestJsonData->$dlidStr->strictParameters)) {
                throw new Exception("Downloads LocalManifest Format Error(Line 14) in DLID: " . $dlid);
            }
            
        } else {
            throw new Exception("Download Local Manifest Format Error (Line 2).");
        }
        
        // If all was verifyed OK then return the LocalManifest Object for inteprtation and use in the download.
        return $localManifestJsonData->$dlidStr;


    } catch (Exception $e) {
        msg("red", $e->getMessage());
        
        return 0;
    }
}

?>
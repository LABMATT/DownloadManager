<?php

// Verifys that the Downloads Manifest is readable. 
function VerifyJSONManifest($inJSON, $dlid)
{

    // Makes sure the dlid exists in the database. Then verify the intergity of the manifest.
    try {
        if (!isset($inJSON->Manifest)) {
            throw new Exception("Download Manifest Format Error(Line 2) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->DownloadName)) {
            throw new Exception("Download Manifest Format Error(Line 3) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Enabled)) {
            throw new Exception("Download Manifest Format Error(Line 4) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Deleted)) {
            throw new Exception("Download Manifest Format Error(Line 5) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Reason)) {
            throw new Exception("Download Manifest Format Error(Line 6) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->PasswordProtected)) {
            throw new Exception("Download Manifest Format Error(Line 7) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Password)) {
            throw new Exception("Download Manifest Format Error(Line 8) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->VersionGroupID)) {
            throw new Exception("Download Manifest Format Error(Line 9) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->FileName)) {
            throw new Exception("Download Manifest Format Error(Line 11) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Version)) {
            throw new Exception("Download Manifest Format Error(Line 12) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->DateCreated)) {
            throw new Exception("Download Manifest Format Error(Line 13) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->DateModifed)) {
            throw new Exception("Download Manifest Format Error(Line 14) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->FileType)) {
            throw new Exception("Download Manifest Format Error(Line 15) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Description)) {
            throw new Exception("Download Manifest Format Error(Line 16) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->CreatorSource)) {
            throw new Exception("Download Manifest Format Error(Line 17) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Link)) {
            throw new Exception("Download Manifest Format Error(Line 18) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->Downloads)) {
            throw new Exception("Download Manifest Format Error(Line 19) in DLID: " . $dlid);
        }
        if (!isset($inJSON->Manifest->FileSize)) {
            throw new Exception("Download Manifest Format Error(Line 20) in DLID: " . $dlid);
        }
        
        return true;
        
    } catch (Exception $exception) {
        
        echo $exception;
        // MSG eception
        return false;
    }
}

?>
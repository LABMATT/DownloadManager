<?php

// Verifys the format is JSON and then checks to make sure all vars are there.
function verifyJSON($jsonData)
{

        // Verify if its json
    $jsonData = json_decode($jsonData);


    if ($jsonData == null) {
        
        return false;
    }
    
    // Make sure all required feilds are met.
    try {
        if (!isset($jsonData->Manifest)) {
            throw new Exception("Data Failure. No Manifest Tag.");
        }
        if (!isset($jsonData->Manifest->DownloadName)) {
            throw new Exception("Data Failure. No DownloadName Tag.");
        }
        if (!isset($jsonData->Manifest->Enabled)) {
            throw new Exception("Data Failure. No Enabled Tag.");
        }
        if (!isset($jsonData->Manifest->Version)) {
            throw new Exception("Data Failure. No Version Tag.");
        }
        if (!isset($jsonData->Manifest->Description)) {
            throw new Exception("Data Failure. No Description Tag.");
        }
        if (!isset($jsonData->Manifest->CreatorSource)) {
            throw new Exception("Data Failure. No CreatorSource Tag.");
        }
        if (!isset($jsonData->Manifest->Link)) {
            throw new Exception("Data Failure. No Link Tag.");
        }
        if (!isset($jsonData->Manifest->Password)) {
            throw new Exception("Data Failure. No Password Tag.");
        }
        if (!isset($jsonData->Manifest->VersionGorupName)) {
            throw new Exception("Data Failure. No VersionGorupName Tag.");
        }
        if (!isset($jsonData->Manifest->Branch)) {
            throw new Exception("Data Failure. No Branch Tag.");
        }
        if (!isset($jsonData->Manifest->VGIDversion)) {
            throw new Exception("Data Failure. No Branch Tag.");
        }
        
        return true;

    } catch (Exception $exception) {
        
        echo $exception;
    }
    
    return false;
}

?>
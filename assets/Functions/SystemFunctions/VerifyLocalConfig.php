<?php

// Verifys the local config to make sure the correct settings are in there.
function VerifyLocalConfig($fileContents)
{

    $jsonData = json_decode($fileContents);

    if ($jsonData != null) {
        try {
            if (!isset($jsonData->SettingAndResourceLocation)) {
                throw new Exception("Local Config Error. Missing \"SettingAndResourceLocation\".");
            }
            if (!isset($jsonData->SettingAndResourceLocation->Windows)) {
                throw new Exception("Local Config Error. Missing \"Windows\" setting.");
            }
            if (!isset($jsonData->SettingAndResourceLocation->Linux)) {
                throw new Exception("Local Config Error. Missing \"Linux\" setting.");
            }
            if (!isset($jsonData->SettingAndResourceLocation->Mac)) {
                throw new Exception("Local Config Error. Missing \"Mac\" setting.");
            }

        } catch (Exception $exception) {

            spawnError("VerifyLocalConfig", $exception);
            return false;
        }
    } else {

        return false;
    }

    return $jsonData;
}

?>
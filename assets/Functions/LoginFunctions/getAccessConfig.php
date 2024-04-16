<?php

// Verifys the config is ok. if so then returns it.
function getAccessConfig($path)
{

    try {

        $configFileLocation = $path . "Config" . DIRECTORY_SEPARATOR . "login.config";


        if (file_exists($configFileLocation)) {
            if (is_readable($configFileLocation)) {
                if (filesize($configFileLocation) == 0) {
                    throw new Exception("Server login.config File Is Empty.");
                }
            } else {
                throw new Exception("Server Does Not Have Permission To Access login.config File.");
            }

        } else {
            throw new Exception("No login.config File Found.");
        }


        // Now we have covered most common errors, we can get the contents of the manifest.json then cast it to a object.
        $mainLoginFile = file_get_contents($configFileLocation);
        $loginJsonData = json_decode($mainLoginFile);


        // Makes sure the dlid exists in the database. Then verify the intergity of the manifest.
        if (isset($loginJsonData->login)) {
            if (!isset($loginJsonData->login->NewUsername)) {
                throw new Exception("No NewUsername Key Found.");
            }
            if (!isset($loginJsonData->login->NewPassword)) {
            throw new Exception("No AESu Key Found.");
            }
            if (!isset($loginJsonData->login->AESu)) {
            throw new Exception("No AESu Key Found.");
            }
            if (!isset($loginJsonData->login->AESp)) {
            throw new Exception("No AESp Key Found.");
            }
            if (!isset($loginJsonData->login->CooldownBetweenAttempts)) {
            throw new Exception("No CooldownBetweenAttempts Key Found.");
            }
            if (!isset($loginJsonData->login->CooldownAfterMaxAttempts)) {
            throw new Exception("No CooldownAfterMaxAttempts Key Found.");
            }
            if (!isset($loginJsonData->login->MaxAttemptsAllowed)) {
            throw new Exception("No MaxAttemptsAllowed Key Found.");
            }
            if (!isset($loginJsonData->login->MaxAttemptsAllowedInPeriodOfTime)) {
            throw new Exception("No MaxAttemptsAllowedInPeriodOfTime Key Found.");
            }
            if (!isset($loginJsonData->login->StrictMode)) {
            throw new Exception("No StrictMode Key Found.");
            }
            if (!isset($loginJsonData->login->Lockedout)) {
            throw new Exception("No Lockedout Key Found.");
            }
        } else {
            throw new Exception("Error: No Login.config OR Server login.config Is Formatted Incorrectly. ");
        }


    } catch (Exception $e) {
        
        return null;
    }

    return $loginJsonData;
}


// Checks for config file. if not then makes one.
function configDir($path)
{
    if (!is_dir($path . "Config" . DIRECTORY_SEPARATOR)) {
        mkdir($path . "Config");
    }

    if (!file_exists($path . "Config" . DIRECTORY_SEPARATOR . "login.config")) {
        copy(__DIR__ . DIRECTORY_SEPARATOR . "Templatelogin.config", $path . "Config" . DIRECTORY_SEPARATOR . "login.config");
        copy(__DIR__ . DIRECTORY_SEPARATOR . "Readme.help", $path . "Config" . DIRECTORY_SEPARATOR . "Readme.help");
    }
}

?>
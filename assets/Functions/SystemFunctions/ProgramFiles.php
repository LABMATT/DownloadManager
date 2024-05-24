<?php

// Gets the type of operating system and decides where files should be stored.
// If windows then appdata.
// If linux then opt.
// If mac then opt as well.
// If unknown then do nothing.
function GetSystemPath($projectName)
{

    // Require the functions only this class will use realted to reading the local config.
    require_once "assets/Functions/SystemFunctions/GetLocalConfig.php";
    require_once "assets/Functions/SystemFunctions/VerifyLocalConfig.php";

    $osFamily = PHP_OS_FAMILY;
    $filePath = null;

    // Check and get contents of local confing
    $localConfig = null;
    $localConfig = GetLocalConfig();
    $verifyLocal = false;

    if ($localConfig == null) {

        return false;
    }

    $verifyLocal = VerifyLocalConfig($localConfig);

    if (!$verifyLocal) {

        return false;
    }


    // Using this OS family get the file path.
    // Check the file for this path.
    switch ($osFamily) {
        case "Windows":
            $filePath = windowsMode($verifyLocal);
            break;

        case "Mac":
            $filePath = macMode($verifyLocal);
            break;
            
        case "Linux":
            $filePath = linuxMode($verifyLocal);
            break;

        case "Unknown":
            break;
    }


    if (!is_dir($filePath . DIRECTORY_SEPARATOR . $projectName)) {
        $mkdirSucess = mkdir($filePath . DIRECTORY_SEPARATOR . $projectName);

        if (!$mkdirSucess) {
            return false;
        }
    } else {

        return $filePath . DIRECTORY_SEPARATOR . $projectName . DIRECTORY_SEPARATOR;
    }

    return false;
}


// These below functions get and check paths spersifcic to the OS.
function windowsMode($jsonIN)
{
    if ($jsonIN->SettingAndResourceLocation->Windows == "%appdata%") {

        return getenv("APPDATA");
    }

    return $jsonIN->SettingAndResourceLocation->Windows;
}


function linuxMode($jsonIN)
{
    if ($jsonIN->SettingAndResourceLocation->Linux == "/home/<user>") {

        spawnError("ProgramFiles", "Please change the default file/settings path in the \"LocalConfig.json\" located in your DownloadManager site directory. FEX: \"/home/<user>\" --> \"/home/matthew\"");
        return null;
    }

    return $jsonIN->SettingAndResourceLocation->Linux;

}


function macMode($jsonIN)
{
    return $jsonIN->SettingAndResourceLocation->Mac;
}

?>
<?php

// Gets the type of operating system and decides where files should be stored.
// If windows then appdata.
// If linux then opt.
// If mac then opt as well.
// If unknown then do nothing.
function GetSystemPath($projectName)
{

    // Require the functions only this class will use realted to reading the local config.
    require "assets/Functions/SystemFunctions/GetLocalConfig.php";
    require "assets/Functions/SystemFunctions/VerifyLocalConfig.php";

    $osFamily = PHP_OS_FAMILY;
    $filePath = null;

    // Check and get contents of local confing
    $localConfig = null;
    $localConfig = GetLocalConfig();
    $verifyLocal = false;

    if($localConfig == null) {

        return false;
    }

    $verifyLocal = VerifyLocalConfig($localConfig);

    if(!$verifyLocal) {

        return false;
    }


    // Using this OS family get the file path.
    switch ($osFamily) {
        case "Windows":
            $filePath = getenv("APPDATA");
            break;

        case "Mac":
        case "Linux":
            $filePath = DIRECTORY_SEPARATOR . "opt";
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
?>
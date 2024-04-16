<?php

// Gets the type of operating system and decides where files should be stored.
// If windows then appdata.
// If linux then opt.
// If mac then opt as well.
// If unknown then do nothing.
function GetSystemPath()
{

    $osFamily = PHP_OS_FAMILY;
    $filePath = null;
    $projectName = "DownloadManger";


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


    if (!is_dir($filePath)) {
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
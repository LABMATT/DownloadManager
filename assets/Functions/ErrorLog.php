<?php

// If an error occures then save it to the systems file system in a log file.
function logError($source, $error)
{

    $projectPath = GetSystemPath("DownloadManager");
    $projectPathLogs = $projectPath . "Logs";

    // Check if the Manifest folder exists
    if (!is_dir($projectPath)) {

        mkdir($projectPath);
    }


    if (!is_dir($projectPathLogs)) {

        mkdir($projectPathLogs);
    }


    // Check if the entery has already been made by another function checking a manifest and encountering the same error.
    // If the error has not been loged already then add it to the file.
    $fileContent = file_get_contents($projectPathLogs . DIRECTORY_SEPARATOR . "Errors.log");
    $logEntry = "- Log:" . time() . ":" . date("d/m/Y") . ":" . $source . ":" . $error . "\r\n";

    if (!str_contains($fileContent, $logEntry)) {

        $file = fopen($projectPathLogs . DIRECTORY_SEPARATOR . "Errors.log", "a+");
        fwrite($file, $logEntry);
        fclose($file);
    }
}

?>
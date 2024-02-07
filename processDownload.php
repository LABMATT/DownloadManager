<?php
// Checks the download file exits, if so preforms the download and sends the data  over to the sever.

function processDownload($dlid, $localManifestJson, $mainManifestJson)
{
    try {

        // Location the file should be in.
        $downloadLocation = "Downloads" . DIRECTORY_SEPARATOR . $dlid . DIRECTORY_SEPARATOR . $localManifestJson->fileName;

        if (!file_exists($downloadLocation)) {
            throw new Exception("File does not exist on server.");
        }

        $fileSize = filesize($downloadLocation);
        $fileDateCreated = filectime($downloadLocation);
        $fileDateModifed = filemtime($downloadLocation);
        $fileType = filetype($downloadLocation);
        

        // Make sure the manifest file size matches real file size if strictPramters is enabled.
        if ($localManifestJson->strictParameters == true) {
            
            if (($fileSize != $localManifestJson->fileSize)) {
                throw new Exception("Error: File Size In Local Manifest (" . $localManifestJson->fileSize . ") bytes Does Not Match The Real File Size Of (" . $fileSize . ") bytes.");
            }
            if (($fileDateCreated != $localManifestJson->dateCreated)) {
                throw new Exception("Error: Date Created In Local Manifest (" . $localManifestJson->dateCreated . ") Does Not Match The Real File Date Of (" . $fileDateCreated . ").");
            }
            if (($fileDateModifed != $localManifestJson->dateLastModifed)) {
                throw new Exception("Error: Date Modifed In Local Manifest (" . $localManifestJson->dateLastModifed . ") Does Not Match The Real File Date Modifed Of (" . $fileDateModifed . ").");
            }
        }

    } catch (Exception $e) {

        msg("red", $e->getMessage());
    }
}

?>
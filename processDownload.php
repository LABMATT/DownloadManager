<?php
// Checks the download file exits, if so preforms the download and sends the data  over to the sever.

function processDownload($dlid, $localManifestJson) {
    try {
        
        // Location the file should be in.
        $downloadLocation = "Downloads" . DIRECTORY_SEPARATOR . $dlid . DIRECTORY_SEPARATOR . $localManifestJson->fileName;
        
        if(!file_exists($downloadLocation)) {
            throw new Exception("File does not exist on server.");
        }
        
        $fileSize = filesize($downloadLocation);
        
        // Make sure the manifest file size matches real file size if strictPramters is enabled.
        if(($fileSize != $localManifestJson->fileSize) and ($localManifestJson->strictParameters == true)) {
            throw new Exception("Error: File Size In Local Manifest (" . $localManifestJson->fileSize . ") bytes Does Not Match The Real File Size of (" . $fileSize . ") bytes.");
        }
        
    } catch (Exception $e) {
        
        msg("red", $e->getMessage());
    }
}

?>
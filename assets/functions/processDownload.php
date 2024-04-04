<?php
// Checks the download file exits, if so preforms the download and sends the data  over to the sever.

function processDownload($dlid, $localManifestJson, $mainManifestJson, $autoDownload)
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
        
        
        // ECHO DATA TO THE SERVER TO GIVE INFO.

        // CHANGE THIS TO YOUR HOST NAME!!!! THIS IS THE MAIN SITE DOMAIN WHERE WGET WILL LINK.

        if ($autoDownload == 2) {
            // REDIRECTS PAGE TO THE FILE REMVOIE THE DOWNLAO
            header("Location: " . "Downloads". DIRECTORY_SEPARATOR . $dlid . DIRECTORY_SEPARATOR . $localManifestJson->fileName, true, 301);
        } else if ($autoDownload == 0 || $autoDownload == 1) {
            
            // Change the name of the webpage to the donwload.
            echo "<script type='text/javascript'>updatePage(". json_encode($localManifestJson) . ", " . $dlid . "," . $autoDownload .", '" . $mainManifestJson->settings->hostName . "');</script>";
            
        } else {
            msg("red", "Your download auto option was invlaid: <br> - 0 = Start Download Manualy. <br> - 1 = Start Download Automaticly. <br> - 2 = DIRECT REDIRECT. (You should not be seeing this page)");
        }

    } catch (Exception $e) {

        msg("red", $e->getMessage());
    }
}

?>
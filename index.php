<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>LABMATT DOWNLOAD</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="update.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<!-- Main Html Body -->
<body>

<!-- This is the top text that says what page your on -->
<header>
    <h1>Download Portal</h1>
    <p id="action">Your download should start automatically. If it does not click the button below.</p>
</header>

<!-- Download buttons that show when they have href applied to them -->
<div id="dwl">
    <a id="dwll" href="" rel="noopener noreferrer" target="_blank" download>
        <button id="dwlb">Download</button>
    </a>
</div>

<br>

<!--This is the propites window for the file that is selected -->
<p id="fp"><b>File Properties:</b></p>
<div id="info">
    <table>
        <tr>
            <th id="tit">Name:</th>
            <th class="prop" id="pname"></th>
        </tr>
        <tr>
            <th id="tit">Date-Created:</th>
            <th class="prop" id="pdatec"></th>
        </tr>
        <tr>
            <th id="tit">Date-Modifed:</th>
            <th class="prop" id="pdatem"></th>
        </tr>
        <tr>
            <th id="tit">File-type:</th>
            <th class="prop" id="ptype"></th>
        </tr>
        <tr>
            <th id="tit">Size:</th>
            <th class="prop" id="psize"></th>
        </tr>
    </table>
</div>

<!-- Message witch has its contents swaped if php has an error. -->
<p id="msg"></p>

<br>

<!-- The wget window where you get easy acces to the command to download this file using wget -->
<p id="wgettitle"><b>WGET for linux terminals (click to copy):</b></p>
<p id="wget" onclick="copy()"></p>
<p id="copyed"><b>Copied!</b></p>

<!-- This is the source code for this very program -->
<p id="source">View Source Code For Download Manger here: <a href="https://github.com/LABMATT/DownloadManager"
                                                             target="_blank">https://github.com/LABMATT/DownloadManager</a>
</p>


</body>
</html>


<?php

require 'verifyManifest.php';
require 'verifyLocalManifest.php';
require 'msg.php';
require 'processDownload.php';
require 'Sanitize.php';

// THIS NEEDS TO CHECK IF FILE EXISTS BEFORE SENDING THE LINK!

try {

    // Get the input
    $inFile = htmlspecialchars($_GET["dlid"] ?? null);
    $inAuto = htmlspecialchars($_GET["auto"] ?? null);

    // return Bool, Check if all good.
    $isOK = sanitize($inFile, 25);
    $isautoK = sanitize($inAuto, 2);

    if ($isOK && $isautoK) {

        // Call main file lookup service
        $verifyManifest = verifyManifest($inFile);
        $localManifestjson = 0;
        $dlidStr = "dlid_" . $inFile;
        

        // From our result, we either 0-DO NOTHING, else move on to checking if password protected.
        if (!$verifyManifest == 0) {
            if ($verifyManifest->downloads->$dlidStr->passwordProtected == true) {

                // REQUIRES EXTERNAL SERVER CONNECTION.

            } else {
                // Verify the LocalManifest for  that download. Then return the json
                $localManifestjson = verifyLocalManifest($inFile);
            }
        } 

        // If its 0 then there was an error. Else proceed with download.
        if (!$localManifestjson == 0) {

            processDownload($inFile, $localManifestjson, $verifyManifest, $inAuto);
        }
    }

} catch (Exception $e) {
    $error = $e->getMessage();

    msg("red", $error);
}
?> 
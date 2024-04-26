<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>LABMATT DOWNLOAD</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="assets\javascript\update.js"></script>
    <link rel="stylesheet" type="text/css" href="assets\styles\styles.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Properties.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\versionHistory.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Description.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\wget.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\download.css">

</head>

<!-- Main Html Body -->
<body>

<?php
include("assets\Functions\GetManifest.php");
getManifest(1);
?>

<!-- This is the top text that says what page your on -->
<header>
    <h1>Download Portal</h1>
    <p id="action">Click the "Download" button below when ready.</p>
</header>

<div id="MainContent">

    <!-- Download buttons that show when they have href applied to them -->
    <div id="dwl">
        <a id="dwll" href="" rel="noopener noreferrer" target="_blank" download>Download</a>
    </div>

    <br>


    <!-- This is the centerbit that contains propitys, discription and version info. -->
    <div id="propStruct">

        <div id="properties">
            <p id="propHeader"><b>Properties:</b></p>

            <div id="propContainer">
                <p class="subPropkey">Name:</p>
                <p class="subPropVal" id="pname"></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Creator:</p>
                <p class="subPropVal" id="pcreatorSource"></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Links:</p>
                <p class="subPropVal" id="plink"></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Version:</p>
                <p class="subPropVal" id="pversion"></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Downloads:</p>
                <p class="subPropVal" id="pnumberOfDownloads"></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Date-Created:</p>
                <p class="subPropVal" id="pdatec"></p>
            </div>
            
            <div id="propContainer">
                <p class="subPropkey">Date-Modifed:</p>
                <p class="subPropVal" id="pdatem"></p>
            </div>
            
            <div id="propContainer">
                <p class="subPropkey">File-type:</p>
                <p class="subPropVal" id="ptype"></p>
            </div>
            
            <div id="propContainer">
                <p class="subPropkey">Size:</p>
                <p class="subPropVal" id="psize"></p>
            </div>

        </div>

        <div id="DescriptionDiv">

            <p id="desTitle"><b>Description:</b></p>

            <p id="pdescription">
                This is the descripy
            </p>

        </div>
    </div>


    <!-- The wget window where you get easy acces to the command to download this file using wget -->
    <p id="wgettitle">WGET for linux terminals (click to copy):</p>
    <p id="wget" onclick="copy()"></p>
    <p id="copyed"><b>Copied!</b></p>
    
    <br>
    
    <div id="versionHistory">
        <p id="versionTitle"><b>Previous Versions:</b></p>
        
        <div class="subVersion">
            <p class="versionTextFormat">Name:</p>
            <p class="versionTextFormat">Created:</p>
            <p class="versionTextFormat">Version:</p>
            <a class="versionTextFormat" href="">DLID:</a>
            <p class="versionTextFormat"></p>
        </div>
        <div class="subVersion">
            <p class="versionTextFormat">Name:</p>
            <p class="versionTextFormat">Created:</p>
            <p class="versionTextFormat">Version:</p>
            <a class="versionTextFormat" href="">DLID:</a>
            <p class="versionTextFormat"></p>
        </div>
        <div class="subVersion">
            <p class="versionTextFormat">Name:</p>
            <p class="versionTextFormat">Created:</p>
            <p class="versionTextFormat">Version:</p>
            <a class="versionTextFormat" href="">DLID:</a>
            <p class="versionTextFormat"></p>
        </div>
        <div class="subVersion">
            <p class="versionTextFormat">Name:</p>
            <p class="versionTextFormat">Created:</p>
            <p class="versionTextFormat">Version:</p>
            <a class="versionTextFormat" href="">DLID:</a>
            <p class="versionTextFormat"></p>
        </div>
        
    </div>

</div>

<!-- Message witch has its contents swaped if php has an error. -->
<p id="msg"></p>

<br>

</body>
</html>


<?php

require 'assets\Functions\verifyManifest.php';
require 'assets\Functions\verifyLocalManifest.php';
require 'assets\Functions\msg.php';
require 'assets\Functions\processDownload.php';
require 'assets\Functions\Sanitize.php';

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

            // See if download has been removed from server or not. check status.
            if ($verifyManifest->downloads->$dlidStr->status == false) {
                echo "<script type='text/javascript'>downloadRemoved('" . $verifyManifest->downloads->$dlidStr->reason . "', '" . $verifyManifest->downloads->$dlidStr->downloadName . "');</script>";
            } else {
                processDownload($inFile, $localManifestjson, $verifyManifest, $inAuto);
            }
        }
    }

} catch (Exception $e) {
    $error = $e->getMessage();

    msg("red", $error);
}
?> 
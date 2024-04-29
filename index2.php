<?php

require 'assets\Functions\Sanitize.php';

// START OF NEW REFORMATTING ATTEMPT:

$inDLID = htmlspecialchars($_GET["dlid"] ?? null);
$inDLID = 1;

//$inDLID = santize($inDLID);

require("assets\Functions\GetDownload.php");
require("assets\Functions\GetManifest.php");
require("assets\Functions\Verify_DLID_Manifest.php");


// Get the Manifest for this Download ID
// Verify that the manifest is valid for use. Return false if not ready and error.
$manifest = getManifest($inDLID);
$downloadJSON = json_decode($manifest);
$verifyDLIDManifest = VerifyJSONManifest($downloadJSON, $inDLID);
$settings = "";

echo "Veriffy: " . $verifyDLIDManifest;

if ($downloadJSON != null && $verifyDLIDManifest) {
    if ($downloadJSON->Manifest->Deleted == true) {

    } else if ($downloadJSON->Manifest->Enabled == false) {

    }
}
?>


<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>LABMATT DOWNLOAD</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <!--<script type="text/javascript" src="assets\javascript\update.js"></script>-->
    <script type="text/javascript" src="assets\javascript\UpdateDownload.js"></script>

    <link rel="stylesheet" type="text/css" href="assets\styles\styles.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Properties.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\versionHistory.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Description.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\wget.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\download.css">

</head>

<!-- Main Html Body -->
<body>

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
                <p class="subPropVal" id="pname"><?php echo $downloadJSON->Manifest->DownloadName ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Creator:</p>
                <p class="subPropVal" id="pcreatorSource"><?php echo $downloadJSON->Manifest->CreatorSource ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Links:</p>
                <p class="subPropVal" id="plink"><?php echo $downloadJSON->Manifest->Link ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Version:</p>
                <p class="subPropVal" id="pversion"><?php echo $downloadJSON->Manifest->Version ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Downloads:</p>
                <p class="subPropVal" id="pnumberOfDownloads"><?php echo $downloadJSON->Manifest->Downloads ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Date-Created:</p>
                <p class="subPropVal" id="pdatec"><?php echo $downloadJSON->Manifest->DateCreated ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Date-Modifed:</p>
                <p class="subPropVal" id="pdatem"><?php echo $downloadJSON->Manifest->DateModifed ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">File-type:</p>
                <p class="subPropVal" id="ptype"><?php echo $downloadJSON->Manifest->FileType ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Size:</p>
                <p class="subPropVal" id="psize"><?php echo $downloadJSON->Manifest->FileSize ?></p>
            </div>

        </div>

        <div id="DescriptionDiv">

            <p id="desTitle"><b>Description:</b></p>

            <p id="pdescription">
                <?php echo $downloadJSON->Manifest->Description ?>
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
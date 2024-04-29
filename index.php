<?php

require("assets\Functions\LoginFunctions\ProgramFiles.php");
require("assets\Functions\DownloadError.php");
require 'assets\Functions\Sanitize.php';
require("assets\Functions\GetDownload.php");
require("assets\Functions\GetSettings.php");
require("assets\Functions\GetManifest.php");
require("assets\Functions\VerifySettings.php");
require("assets\Functions\VerifyManifest.php");

$inDLID = htmlspecialchars($_GET["dlid"] ?? null);
$inAUTO = htmlspecialchars($_GET["auto"] ?? null);

$validDLID = sanitize($inDLID);
$validAUTO = sanitize($inAUTO);

$fileLink = "";
$verifyManifest = false;
$verifySettings = false;


// If the auto veriable is empty or invalid then set it to 0.
if (!$validAUTO || $inAUTO == "") {

    $inAUTO = 0;
}


// Make sure the auto is a valid veriable. If not then do nothing.
switch ($inAUTO) {
    case 0:
    case 1:
    case 2:
        break;
    default:
        $inAUTO = 0;
}


// Get the Manifest for this Download ID and the Servers settings.
$manifest = getManifest($inDLID);
$settings = getSettings();


// Verify that the manifest and settings were gettable.
// If SO then decode the json.
// IF NOT then later we will throw an error page.
if ($manifest != null && $settings != null) {

    $manifestJSON = json_decode($manifest);
    $settingsJSON = json_decode($settings);

    $verifyManifest = VerifyJSONManifest($manifestJSON, $inDLID);
    $verifySettings = VerifySettings($settingsJSON);
}


if ($verifyManifest && $verifySettings) {

    if ($manifestJSON->Manifest->Deleted == true) {

        header("Location: DownloadRemoved.php");

    } else if ($manifestJSON->Manifest->Enabled == false) {

        header("Location: DownloadDisabled.php");
    } else {

        // Using hostname and the files name get the file path.
        $fileLink = $settingsJSON->Settings->HostName . "Downloads/" . "dlid_" . $manifestJSON->Manifest->dlid . "/" . $manifestJSON->Manifest->FileName;
        $wgetLink = "sudo wget --content-disposition " . $fileLink;
    }

} else {

    // Error getting settings or dlid.
}
?>


<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>LABMATT DOWNLOAD</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="assets\javascript\WGETCopy.js"></script>
    <script type="text/javascript" src="assets\javascript\DeletedDownload.js"></script>
    <script type="text/javascript" src="assets\javascript\AutoDownload.js"></script>

    <link rel="stylesheet" type="text/css" href="assets\styles\styles.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Properties.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\versionHistory.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Description.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\wget.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\download.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\download.css">

</head>

<!-- Main Html Body -->
<body>


<div id="MainContent">

    <!-- This is the top text that says what page your on -->
    <header>
        <h1>Download Portal</h1>
        <p id="action">Click the "Download" button below when ready.</p>
    </header>

    <!-- Download buttons that show when they have href applied to them -->
    <div id="dwl">
        <a id="dwll" href="<?php echo $fileLink ?>" rel="noopener noreferrer" target="_blank" download>Download</a>
    </div>

    <br>


    <!-- This is the centerbit that contains propitys, discription and version info. -->
    <div id="propStruct">

        <div id="properties">
            <p id="propHeader"><b>Properties:</b></p>

            <div id="propContainer">
                <p class="subPropkey">Name:</p>
                <p class="subPropVal" id="pname"><?php echo $manifestJSON->Manifest->DownloadName ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Creator:</p>
                <p class="subPropVal" id="pcreatorSource"><?php echo $manifestJSON->Manifest->CreatorSource ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Links:</p>
                <p class="subPropVal" id="plink"><?php echo $manifestJSON->Manifest->Link ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Version:</p>
                <p class="subPropVal" id="pversion"><?php echo $manifestJSON->Manifest->Version ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Downloads:</p>
                <p class="subPropVal" id="pnumberOfDownloads"><?php echo $manifestJSON->Manifest->Downloads ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Date-Created:</p>
                <p class="subPropVal" id="pdatec"><?php echo $manifestJSON->Manifest->DateCreated ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Date-Modifed:</p>
                <p class="subPropVal" id="pdatem"><?php echo $manifestJSON->Manifest->DateModifed ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">File-type:</p>
                <p class="subPropVal" id="ptype"><?php echo $manifestJSON->Manifest->FileType ?></p>
            </div>

            <div id="propContainer">
                <p class="subPropkey">Size:</p>
                <p class="subPropVal" id="psize"><?php echo $manifestJSON->Manifest->FileSize ?></p>
            </div>

        </div>

        <div id="DescriptionDiv">

            <p id="desTitle"><b>Description:</b></p>

            <p id="pdescription">
                <?php echo $manifestJSON->Manifest->Description ?>
            </p>

        </div>
    </div>


    <!-- The wget window where you get easy acces to the command to download this file using wget -->
    <p id="wgettitle">WGET for linux terminals (click to copy):</p>
    <p id="wget" onclick="copy()"><?php echo $wgetLink ?></p>
    <p id="copyed"><b>Copied!</b></p>

    <br>

    <?php

    if ($manifestJSON->Manifest->VersionGroupID != "") {

        echo "<div id=\"versionHistory\">";
        echo "<p id=\"versionTitle\"><b>Previous Versions:</b></p>";

        echo "<div class=\"subVersion\">";
        echo "<p class=\"versionTextFormat\">Name:</p>";
        echo "<p class=\"versionTextFormat\">Created:</p>";
        echo "<p class=\"versionTextFormat\">Version:</p>";
        echo "<a class=\"versionTextFormat\" href=\"\">DLID:</a>";
        echo "<p class=\"versionTextFormat\"></p>";
        echo "</div>";
        echo "</div>";
    }
    ?>

</div>

<!-- Message witch has its contents swaped if php has an error. -->
<p id="msg"></p>

<br>

</body>
</html>

<?php

echo "<script>autoAction(" . $inAUTO . ");</script>";

?>
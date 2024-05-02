<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>Error</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <!-- <script type="text/javascript" src="assets\javascript\failedLogin.js"></script> -->

    <link rel="stylesheet" type="text/css" href="assets\styles\Error\Error.css">

</head>

<!-- Main Html Body -->
<body>

<div id="ErrorDiv">

    <?php
    require("assets\Functions\ErrorLog.php");
    require "assets\Functions\LoginFunctions\ProgramFiles.php";
    require "assets\Functions\MangerFunctions\Sanitize.php";
    require "assets\Functions\MangerFunctions\GetManifest.php";
    require "assets\Functions\MangerFunctions\VerifyManifest.php";


    $inDLID = htmlspecialchars($_GET["dlid"] ?? null);
    $inTYPE = htmlspecialchars($_GET["reason"] ?? null);

    $inDLIDFlag = sanitize($inDLID);
    $inTYPEFlag = sanitize($inTYPE);


    if ($inTYPEFlag && $inDLIDFlag) {

        $manifest = getManifest($inDLID);
        $json = null;
        $verifyManifest = false;

        if ($manifest != null) {

            $json = json_decode($manifest);
            $verifyManifest = VerifyJSONManifest($json, $inDLID);
        }

        switch ($inTYPE) {

            // Server Error
            case 1:
                echo "<h1>Server Error</h1>";
                echo "<h3>Reason: An Error Occured While Getting The Download.</h3>";
                break;

            // Unknown DLID
            case 2:
                echo "<h1>Unknown Download ID</h1>";
                echo "<h3>Reason: Unknown Download ID <" . $inDLID . "></h3>";
                break;

            // Download is disabled in manifest
            case 3:
                echo "<h1>Download Unavailable (Disabled)</h1>";
                if ($verifyManifest && $json->Manifest->Reason != "") {

                    echo "<h3>Reason: " . $json->Manifest->Reason . "</h3>";
                } else {

                    echo "<h3>Reason: Download Has Been Disabled By Host.</h3>";
                }

                break;

            // Download Deleated
            case 4:
                echo "<h1>Download Deleted</h1>";
                if ($verifyManifest && $json->Manifest->Reason != "") {

                    echo "<h3>Reason: " . $json->Manifest->Reason . "</h3>";
                } else {

                    echo "<h3>Reason: Download Has Been Deleted By Host.</h3>";
                }
                break;

            default:
                echo "<h1>Server Error</h1>";
                break;
        }

    } else {

        echo "<h1>Server Error</h1>";
    }
    ?>
</div>

</body>
</html>

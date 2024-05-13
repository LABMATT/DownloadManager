<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="assets\javascript\error\ErrorButton.js"></script>

    <link rel="stylesheet" type="text/css" href="assets\styles\Error\Error.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/Styles/CriticalError.css">

</head>

<!-- Main Html Body -->
<body onload="init()">

<div id="ErrorDiv">

    <?php
    require "assets/Functions/SystemFunctions/EchoPageFault.php";
    require "assets/Functions/ErrorLog.php";
    require "assets/Functions/SystemFunctions/ProgramFiles.php";
    require "assets/Functions/MangerFunctions/Sanitize.php";
    require "assets/Functions/MangerFunctions/GetManifest.php";
    require "assets/Functions/MangerFunctions/VerifyManifest.php";

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
                echo "<title>Server Error</title>";
                break;

            // Unknown DLID
            case 2:
                echo "<h1>Unknown Download ID</h1>";
                echo "<h3>Reason: Unknown Download ID <" . $inDLID . "></h3>";
                echo "<title>Unknown Download</title>";
                break;

            // Download is disabled in manifest
            case 3:
                echo "<h1>Download Unavailable (Disabled)</h1>";
                echo "<title>Download Unavailable</title>";
                if ($verifyManifest && $json->Manifest->Reason != "") {

                    echo "<h3>Reason: " . $json->Manifest->Reason . "</h3>";
                } else {

                    echo "<h3>Reason: Download Has Been Disabled By Host.</h3>";
                }

                break;

            // Download Deleated
            case 4:
                echo "<h1>Download Deleted</h1>";
                echo "<title>Download Deleted</title>";
                if ($verifyManifest && $json->Manifest->Reason != "") {

                    echo "<h3>Reason: " . $json->Manifest->Reason . "</h3>";
                } else {

                    echo "<h3>Reason: Download Has Been Deleted By Host.</h3>";
                }
                break;

            default:
                echo "<h1>Server Error</h1>";
                echo "<title>Server Error</title>";
                break;
        }

    } else {

        echo "<h1>Server Error</h1>";
        echo "<title>Server Error</title>";

    }
    ?>


</div>

<div id="buttonDIV">
    <button id="closeButton">Close This Tab</button>
</div>


</body>
</html>

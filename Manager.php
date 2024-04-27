<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>Manage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="assets\javascript\failedLogin.js"></script>
    <script type="text/javascript" src="assets\javascript\errorMenu.js"></script>
    <script type="text/javascript" src="assets\javascript\Manager\SwitchWindow.js"></script>
    <script type="text/javascript" src="assets\javascript\Manager\Dlids.js"></script>


    <link rel="stylesheet" type="text/css" href="assets\styles\Manger.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\errorMenu.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Editor.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Deleted.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Version.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\NAV.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\SignInHistory.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Manager.css">
</head>

<!-- Main Html Body -->
<body>

<!-- The header displays the main title with buttons-->
<div id="header">
    <h3 id="navTitle">DOWNLOAD MANAGER</h3>
    <button class="HeaderButton" id="NAVdownload" onclick="switchWindow(1);">Downloads</button>
    <button class="HeaderButton" id="NAVversion" onclick="switchWindow(2);">Versions</button>
    <button class="HeaderButton" id="NAVdeleted" onclick="switchWindow(3);">Deleted Downloads</button>
    <button class="HeaderButton" id="NAVerror" onclick="switchWindow(4);">Errors (0)</button>
    <button class="HeaderButton" id="NAVhistory" onclick="switchWindow(5);">Sign In History</button>
    <button class="HeaderButton" id="NAVsignout">Sign Out</button>
</div>

<div id="errorMenu">
    <h2>Active Error Messages: </h2>
</div>

<!-- DownloadEdit allows input and info about a download to be edited.-->
<div id="downloadEditor"></div>


<!-- Lists all current download files -->
<div id="currentDownloads">
    <h2 class="heading">Downloads: </h2>

    <?php
    require("assets\Functions\crawlDownloads.php");
    ?>

    <!-- 
    <div class="existingDownload">
        <p class="txtContent" id="dname">Example Download</p>
        <a class="txtContent" id="ddlid" href="http://localhost/DownloadManager/?dlid=1&auto=0" target="_blank">DLID</a>
        <p class="txtContent" id="ddate">version</p>
        <p class="txtContent" id="ddate">filetype</p>
        <p class="txtContent" id="ddate">size</p>
        <p class="txtContent" id="ddate">active</p>
        <button class="modiferButtons" id="viewData">View Data</button>
        <button class="modiferButtons" id="deleteButton">Delete</button>
        <button class="modiferButtons" id="editButton">Edit</button>
    </div>
    -->
</div>


<!-- Shows all current version linked files. -->
<div id="versionDiv">
    <h2 class="heading">Versions:</h2>
</div>

<div id="DeletedDownlaods">
    <h2>Deleated Downloads</h2>
</div>

<div id="SignInHistory">
    <h1>Sign in history</h1>
    <button>Clear History</button>
    <p>Warning! Clearing Sign In History Will Also Clear Any Cooldown Periods Currenly In Affect.</p>
</div>

</body>
</html>
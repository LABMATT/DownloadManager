<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>Manage</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="assets\javascript\failedLogin.js"></script>
    <script type="text/javascript" src="assets\javascript\errorMenu.js"></script>
    <link rel="stylesheet" type="text/css" href="assets\styles\Manger.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\errorMenu.css">
</head>

<!-- Main Html Body -->
<body>

<!-- The header displays the main title with buttons-->
<div id="header">
    <h2 id="navTitle">DOWNLOAD MANGER</h2>
    <button class="HeaderButton">New Download</button>
    <button class="HeaderButton" id="refresh">Refresh Manifests</button>
    <button class="HeaderButton" id="errorMenuButton" onclick="errorMenuToggle();">View Errors (0)</button>
    <button class="HeaderButton" id="signOut">Sign Out</button>
</div>

<div id="errorMenu">
    <h2>Active Error Messages: </h2>
</div>

<!-- DownloadEdit allows input and info about a download to be edited.-->
<div id="downloadEditor"></div>


<!-- Lists all current download files -->
<div id="currentDownloads">
    <h2 class="heading">Downloads: </h2>
    <?php require("assets\Functions\crawlDownloads.php"); ?>

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
</div>


<!-- Shows all current version linked files. -->
<div id="versionDiv">
    <h2 class="heading">Versions:</h2>
</div>
</body>
</html>
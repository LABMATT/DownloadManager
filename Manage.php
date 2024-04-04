<!DOCTYPE html>
<html>
<head>

    <!-- Inportnet info -->
    <title>Manage</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="assets\javascript\failedLogin.js"></script>
    <link rel="stylesheet" type="text/css" href="assets\styles\Manger.css">
</head>

<!-- Main Html Body -->
<body>

<!-- The header displays the main title with buttons-->
<div id="header">
    <button class="HeaderButton">New Download</button>
    <button class="HeaderButton" id="refresh">Refresh Manifests</button>
    <button class="HeaderButton" id="signOut">Sign Out</button>
</div>

<!-- DownloadEdit allows input and info about a download to be edited.-->
<div id="downloadEditor"></div>

<h2 class="heading">Downloads: </h2>
<div id="currentDownloads">
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

    <h2 class="heading">Versions:</h2>
    <h2 class="heading">Downloads Without Manifests:</h2>
</body>
</html>
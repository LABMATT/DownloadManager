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
    <script type="text/javascript" src="assets\javascript\Manager\NewDownload.js"></script>


    <link rel="stylesheet" type="text/css" href="assets\styles\Manger.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\errorMenu.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Editor.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Deleted.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Version.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\NAV.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\SignInHistory.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\Manager.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\NAVdownloads.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\DownloadEditor.css">
    <link rel="stylesheet" type="text/css" href="assets\styles\Manager\ExistingDownload.css">

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
    <button class="HeaderButton" id="NAVhistory" onclick="switchWindow(5);">Settings</button>
    <button class="HeaderButton" id="NAVsignout">Sign Out</button>
</div>

<div id="errorMenu">
    <h2>Active Error Messages: </h2>
</div>

<!-- DownloadEdit allows input and info about a download to be edited.-->
<div id="downloadEditor">
    <div id="editor">
        <h1 class="editorHeadings">Download Editor: </h1>
        <h2 class="editorHeadings">Upload File:</h2>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileUpload" id="fileUpload">
            <input type="submit" value="Upload" name="submit" id="fileUploadButton">
        </form>
        <br>

        <h2 class="editorHeadings">Enable/Disabled Download:</h2>
        <p>Should the download Webpage Be Acessable?
            <br>
            Enabled = Download Page Visable.
            <br>
            Disabled = Download Link Leads To "Download Not Aviable".
            <br>
            #NOTE Download Will Still Be Acessable Via WGET.
        </p>

        <div id="EditorEnableDisable">
            <button class="NAVscontent" id="Enabled" onclick="EnabledDisabled(1);">Enabled</button>
            <button class="NAVscontent" id="Disabled" onclick="EnabledDisabled(0);">Disabled</button>
        </div>

        <h2 class="editorHeadings">Download Data:</h2>

        <form id="editorForm">
            <label for="Name" class="editorFormLabel">Downlaod Name: (Required)</label><br>
            <input type="text" id="editorName" name="name" class="editorFormInput" placeholder="FEX: Texture Pack"><br>
            <br>
            <label for="Version" class="editorFormLabel">Downlaod Version: (Optional)</label><br>
            <input type="text" id="editorVersion" name="Version" class="editorFormInput"
                   placeholder="FEX: alpha 1.5.4b"><br>
            <br>
            <label for="Version" class="editorFormLabel">Downlaod Version: (Required)</label><br>
            <input type="text" id="editorDVID" name="Version" class="editorFormInput" placeholder="FEX: 3"><br>
            <br>
            <label for="Version" class="editorFormLabel">Date Created: (Optional)</label><br>
            <input type="text" id="editorCreated" name="Version" class="editorFormInput" placeholder="auto"><br>
            <br>
            <label for="Version" class="editorFormLabel">Date Modifed: (Optional)</label><br>
            <input type="text" id="editorModifed" name="Version" class="editorFormInput" placeholder="auto"><br>
            <br>
            <label for="Version" class="editorFormLabel">File Type: (Optional)</label><br>
            <input type="text" id="editorType" name="Version" class="editorFormInput" placeholder="auto"><br>
            <br>
            <label for="Version" class="editorFormLabel">Creator / Source: (Optional)</label><br>
            <input type="text" id="editorSource" name="Version" class="editorFormInput"
                   placeholder="FEX: Susan Williams"><br>
            <br>
            <label for="Version" class="editorFormLabel">Link: (Optional)</label><br>
            <input type="text" id="editorLink" name="Version" class="editorFormInput"
                   placeholder="www.labmatt.space/texturepack"><br>
            <br>
            <label for="description" class="editorFormLabel">Descirption: (Optional)</label><br>
            <textarea id="editorDescription" name="description" rows="6" cols="40"></textarea>
        </form>

        <h2 class="editorHeadings">Version Group: (Optional)</h2>
        <p>Version Grouping:
            <br>
            If a program or file has multiple versions, a Version Group will allow all versions
            <br>
            to show in order with there accoated downloads. A Version Gorup could
            <br>
            be used by a program to check if new updates are aviable. FEX:
            <br>
            A program could check a version ID to see if new downloads are aviable
            <br>
            thhen use that to download stright from a server avoiding the need for backend systems.
            <br><br>
            VGID = Version Group ID is the group ID.
            <br>
            Version Group Name = The group to be apart of.
            <br>
            Branch = stable, Alpha, Beta branchs allow
            A VGID could have mutliple branches.
            <br>
            Version = Version You refrnace the project by FEX: alpha 1.5.4b
            <br>
            VGIDVersion = A number with no charters that is used by DownloadManager
            to place the downloads in order.
        </p>

        <form id="editorForm">
            <label for="Name" class="editorFormLabel">Version Gorup Name:</label><br>
            <input type="text" id="editorName" name="name" class="editorFormInput" placeholder="FEX: Textures"><br>
            <br>
            <label for="Name" class="editorFormLabel">Branch:</label><br>
            <input type="text" id="editorName" name="name" class="editorFormInput" placeholder="FEX: beta"><br>
            <br>
            <label for="Name" class="editorFormLabel">VGIDVersion:</label><br>
            <input type="text" id="editorName" name="name" class="editorFormInput" placeholder="FEX: 1.2"><br>
        </form>

        <div>
            <button>Save</button>
            <button onclick="switchWindow(1);">Close</button>
        </div>
    </div>
</div>


<!-- Lists all current download files -->
<div id="currentDownloads">

    <div id="NAVdownloads">
        <button class="NAVscontent" id="NewDownload" onclick="newDownload()">New Download</button>
        <button class="NAVscontent" id="SelectDownlaod">Select Downloads</button>
    </div>

    <div id="DownloadSearch">

    </div>

    <h2 class="heading">Downloads: </h2>

    <?php
    require("assets\Functions\crawlDownloads.php");
    ?>

    <!-- 
    <div class="existingDownload">
        <p class="txtContent" id="dname">Example Download</p>
        <a class="txtContent" id="ddlid" href="http://localhost/DownloadManager/?dlid=1&auto=0" target="_blank">DLID</a>
        <p class="txtContent" id="ddate">DVID: </p>        
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
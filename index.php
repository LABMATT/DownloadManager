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
  <a id="dwll" href="" rel="noopener noreferrer" target="_blank" download><button id="dwlb">Download</button></a>
  </div>

  <br>

  <!--This is the propites window for the file that is selected -->
  <p id="fp"><b>File Properties:</b></p>
  <div id="info">
  <table>
  <tr>
    <th id="tit">Name: </th>
    <th class="prop" id="pname"></th>
  </tr>
  <tr>
    <th id="tit">Date-Created: </th>
    <th class="prop" id="pdatec"></th>
  </tr>
  <tr>
    <th id="tit">Date-Modifed: </th>
    <th class="prop" id="pdatem"></th>
  </tr>
  <tr>
    <th id="tit">File-type: </th>
    <th class="prop" id="ptype"></th>
  </tr>
  <tr>
    <th id="tit">Size: </th>
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
  <p id="source">View Source Code For Download Manger here: <a href="https://github.com/LABMATT/DownloadManager" target="_blank">https://github.com/LABMATT/DownloadManager</a></p>


</body>
</html>


<?php 

// THIS NEEDS TO CHECK IF FILE EXISTS BEFORE SENDING THE LINK!

 try {

  // Get the input
 $inFile = htmlspecialchars($_GET["dlid"] ?? null); 
 $inAuto = htmlspecialchars($_GET["auto"] ?? null); 

 // return Bool, Check if all good.
    $isOK = sanitize($inFile, 25);
    $isautoK = sanitize($inAuto, 2);

    if($isOK && $isautoK)
    {

      // Call main file lookup service
      dldb($inFile, $inAuto);
    }

 } catch(Exception $e)
 {
   $error = $e->getMessage();

     msg("red", $error);
 }


 // Sanitize checks the the input does not exceed max charter limit and fits within regex limits.
 function sanitize($inputTXT, $mx)
 {
   
  // Predefined SQL charters that we dont allow in the input. (even if i know that most of them are disabled.)
  $illigle = array("ACTION ","ADD ","ALL ","ALLOCATE ","ALTER ","ANY ","APPLICATION ","ARE ","AREA ","ASC ","ASSERTION ","ATOMIC ","AUTHORIZATION ","AVG ","BEGIN ","BY ","CALL ","CASCADE ","CASCADED ","CATALOG ","CHECK ","CLOSE ","COLUMN ","COMMIT ","COMPRESS ","CONNECT ","CONNECTION ","CONSTRAINT ","CONSTRAINTS ","CONTINUE ","CONVERT ","CORRESPONDING ","CREATE ","CROSS ","CURRENT ","CURRENT_PATH ","CURRENT_SCHEMA ","CURRENT_SCHEMAID ","CURRENT_USER ","CURRENT_USERID ","CURSOR ","DATA ","DEALLOCATE ","DECLARE ","DEFAULT ","DEFERRABLE ","DEFERRED ","DELETE ","DESC ","DESCRIBE ","DESCRIPTOR ","DETERMINISTIC ","DIAGNOSTICS ","DIRECTORY ","DISCONNECT ","DISTINCT ","DO ","DOMAIN ","DOUBLEATTRIBUTE ","DROP ","EACH ","EXCEPT ","EXCEPTION ","EXEC ","EXECUTE ","EXTERNAL ","FETCH ","FLOAT ","FOREIGN ","FOUND ","FULL ","FUNCTION ","GET ","GLOBAL ","GO ","GOTO ","GRANT ","GROUP ","HANDLER ","HAVING ","IDENTITY ","IMMEDIATE ","INDEX ","INDEXED ","INDICATOR ","INITIALLY ","INNER ","INOUT ","INPUT ","INSENSITIVE ","INSERT ","INTERSECT ","INTO ","ISOLATION ","JOIN ","KEY ","LANGUAGE ","LAST ","LEAVE ","LEVEL ","LOCAL ","LONGATTRIBUTE ","LOOP ","MODIFIES ","MODULE ","NAMES ","NATIONAL ","NATURAL ","NEXT ","NULLIF ","ON ","ONLY ","OPEN ","OPTION ","ORDER ","OUT ","OUTER ","OUTPUT ","OVERLAPS ","OWNER ","PARTIAL ","PATH ","PRECISION ","PREPARE ","PRESERVE ","PRIMARY ","PRIOR ","PRIVILEGES ","PROCEDURE ","PUBLIC ","READ ","READS ","REFERENCES ","RELATIVE ","REPEAT ","RESIGNAL ","RESTRICT ","RETURN ","RETURNS ","REVOKE ","ROLLBACK ","ROUTINE ","ROW ","ROWS ","SCHEMA ","SCROLL ","SECTION ","SELECT ","SEQ ","SEQUENCE ","SESSION ","SESSION_USER ","SESSION_USERID ","SET ","SIGNAL ","SOME ","SPACE ","SPECIFIC ","SQL ","SQLCODE ","SQLERROR ","SQLEXCEPTION ","SQLSTATE ","SQLWARNING ","STATEMENT ","STRINGATTRIBUTE ","SUM ","SYSACC ","SYSHGH ","SYSLNK ","SYSNIX ","SYSTBLDEF ","SYSTBLDSC ","SYSTBT ","SYSTBTATT ","SYSTBTDEF ","SYSUSR ","SYSTEM_USER ","SYSVIW ","SYSVIWCOL ","TABLE ","TABLETYPE ","TEMPORARY ","TRANSACTION ","TRANSLATE ","TRANSLATION ","TRIGGER ","UNDO ","UNION ","UNIQUE ","UNTIL ","UPDATE ","USAGE ","USER ","USING ","VALUE ","VALUES ","VIEW ","WHERE ","WHILE ","WITH ","WORK ","WRITE ","ALLSCHEMAS ","ALLTABLES ","ALLVIEWS ","ALLVIEWTEXTS ","ALLCOLUMNS ","ALLINDEXES ","ALLINDEXCOLS ","ALLUSERS ","ALLTBTS ","TABLEPRIVILEGES ","TBTPRIVILEGES ","MYSCHEMAS ","MYTABLES ","MYTBTS ","MYVIEWS ","SCHEMAVIEWS ","DUAL ","SCHEMAPRIVILEGES ","SCHEMATABLES ","STATISTICS ","USRTBL ","STRINGTABLE ","LONGTABLE ","DOUBLETABLE ");


    // Check if the input is shorter then the intended maxmum input.
     if(strlen($inputTXT) < $mx && strlen($inputTXT) != 0)
     {

        // Looks for patten in the string. If patten not followed fex an illigle charter then return 1. 
         $charTest = preg_match("/[^a-zA-Z0-9\[\]_]+/", $inputTXT); //"/[^a-zA-Z0-9\s\[\]_]+/"

         // IF false then the patten found no illigle charters
         if($charTest == false)
         {

             // Make sure no sql terms are entered. THIS REQIRES PHP 8
             foreach($illigle as $value)
             {
                 if(str_contains($inputTXT, $value))
                 {
                    throw new Exception("SQL INJECTION ERROR.");
                 }
                 
             }
             return true;

         }
         else {
             throw new Exception("The URL provided can only contain letters, Numbers and underscore.");
         }

     } else {
         throw new Exception("Download is invalid. <br> File not found by that DLID. <br> Max DLID length reached.");
     }
 }

 
 function dldb($indlid, $auto)
 {
   // Get the main manifest file to check if the file exists. RETURNS FALSE if file is empty or not exists.
   $mainManifestFile = file_get_contents("Manifest.json");
   
   $mainManifestJsonData = json_decode($mainManifestFile);
   
   //echo $mainManifestJsonData->downloads->dlid_1->downloadName;
   
   if(isset($mainManifestJsonData->downloads->dlid_1``)) {
     echo "dlid exists <br>";
   } else {
     echo "dlid does not exists <br>";
   }
   
   if($mainManifestFile) {
     echo "File exists";
   } else {
     echo "File it does not exist";
   }
 }


 // Sends a message back to the bottom of the login form, has colour and the message. 
 function msg($color, $message)
 {
  echo "<script>document.getElementById('msg').style.color = '" . $color . "'; </script>";
  echo "<script>document.getElementById('msg').innerHTML = '" . $message . "'; </script>";

  if($color == "red")
  {
    echo "<script>cleanup();</script>";
  }
 }

 // Sends this download info over javascript
 function preformDownload($loc, $auto, $indlid)
 {
   
  // No matter if its linix or windows were gonna use / not \ and this is totaly because wget wast not happy with one of them.
  $loc = str_replace("\\", "/", $loc); // Adds extra exit char to the pre existing exit char so that when its sent over there still remain in the string.

  // Check if the file exists in its path.
  if(file_exists($loc))
  {

    // CHANGE THIS TO YOUR HOST NAME!!!! THIS IS THE MAIN SITE DOMAIN WHERE WGET WILL LINK.
    $serverHoster = "http://192.168.1.108/DownloadManager/";

    if($auto == 2)
    {
      // REDIRECTS PAGE TO THE FILE
      header("Location: " . $serverHoster . $loc, true, 301); 
    } else if ($auto == 0 || $auto == 1){

      echo "<script type='text/javascript'>titlepd(\"" . $indlid . "\");</script>"; // Changes name of webpage to the file name.

      // This creates all the basic pramters for the file info.
      $fname = basename($loc);
      $fdatem = date ("F d Y H:i:s.", filemtime($loc));
      $fdatec = date ("F d Y H:i:s.", filectime($loc));
      $ftype = filetype($loc);
      $fsize = filesize($loc) . " Bytes";
      $dynlink = $serverHoster . "?dlid=" . $indlid . "&auto=2";

      echo "<script type='text/javascript'>updateProp(\"" . $fname . "\",\"" . $fdatec . "\" , \"" . $fdatem . "\" , \"" . $ftype . "\",\"" . $fsize . "\");</script>"; // Changes name of webpage to the file name.
      echo "<script type='text/javascript'>updateinfo(\"" . $loc . "\", \"" . $auto . "\",\"" . $dynlink . "\");</script>";

    } else {
      msg("red", "Your download auto option was invlaid: <br> - 0 = Start Download Manualy. <br> - 1 = Start Download Automaticly. <br> - 2 = DIRECT REDIRECT. (You should not be seeing this page)");
    }
  }else 
    {
      msg("red", "Failed To find file on server.");
    }  
 }


// Reads data from binary file.
// Database:
// 0x00 database version 1 byte
// 0x01 database pair size, eg how many values per entery. FEX: "19 Name location blank" as one entery with dlid first, name, file location,
// 0x1E Start of lookup numbers. dlid: offset start (HEX) OFFSET END (HEX). 

 function databaseLookup($id) {

 }
?> 
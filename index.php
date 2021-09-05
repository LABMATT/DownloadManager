<!DOCTYPE html>
<html>
<head>

<!-- Inportnet info -->
  <title>LABMATTDOWNLOADSUPERVISOR</title>
  <meta charset="UTF-8">

</head>

<style>
  body {
    margin: 2%;
  }
</style>

<!-- Main Html Body -->
<body>

<header>
  <h1> Download Portal</h1>
  <p>Your download should start automatically. If it does not click the button below.</p>
  <button>Download</button>
  <p id="msg"></p>



</body>
</html>


<?php 



 try {

  // Get the input
 $inFile = htmlspecialchars($_GET["dlid"] ?? null); 
 $inAuto = htmlspecialchars($_GET["auto"] ?? null); 

 // return Bool, Check if all good.
    $isK = sanitize($inFile, 25);
    $isautoK = sanitize($inAuto, 2);

    if($isK && $isautoK)
    {
      echo " san is " . $inFile;
      echo $inAuto;
    }

 } catch(Exception $e)
 {
   $error = $e->getMessage();

     msg("lightred", $error);
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
         throw new Exception("Input Exceeds maximum Character Limit.");
     }
 }

 // Login find if the user exists. If they do, register there session, get some info such as is admin or not, then echo the response the the webpage though javascript saving the login cookie, then redirect them to the correct page.
 function login($inUsername, $inPassword)
 {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "downloads";
  
  try {

    // DATABASE FOR DOWNLOADS SERVER IS SETUP SO:
    // Schema: downloads
    // Table: downloadindex
    // tableCol: iddownloadindex=int=NN=PK=Ai , dlid=vchar44=NN , relloc=vchar200=nn

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Set MySQLi to throw exceptions 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
  
    // Check connection
    if ($conn->connect_error) {
    $sqlError = $conn->connect_error;

    msg("lightred", "There was an error connecting to the server: " . $sqlError);

    } else{

    // Code from here on asks the database for user info and works with the database.

    $sql = "SELECT password FROM users WHERE username='" . $inUsername . "';";
    $pwresult = $conn->query($sql);

    if ($pwresult->num_rows > 0) {
      // output data of each row

      $row = mysqli_fetch_array($pwresult);
      
      if(strcmp($row["password"], $inPassword) == 0)
    {
      msg("lightgreen", "Working to log you in.");

      // Now that password is correct were gonna insert them into the active users, then save the cookie for futher login. THEN redirect them to either user or admin page.
      finalLogin($conn, $inUsername);

    } else{
      msg("lightred", "Incorrect Username Or Password..");
    }

     
    } else {
      msg("lightred", "Incorrect Username Or Password.");
    }
    
    $conn->close();
    }
  } catch(mysqli_sql_exception $e)
  {
    $error = $e->getMessage();
    msg("lightred", "There was an error loging you in: " . $error);
  }
  
 }


 // Sends a message back to the bottom of the login form, has colour and the message. 
 function msg($color, $message)
 {
  echo "<script>document.getElementById('msg').style.color = '" . $color . "'; </script>";
  echo "<script>document.getElementById('msg').innerHTML = '" . $message . "'; </script>";
 }
?>
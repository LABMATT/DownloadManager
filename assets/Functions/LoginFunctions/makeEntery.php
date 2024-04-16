<?php


// Writes the info into the Access Log about the attempt. (unixTimeStamp - IPadress - Resault)
// Takes "path" of the access logs folder.
// Takes an Outcome to write to file.
function makeEntery($path, $outCome)
{
    $accessLogPathFile = $path . "Logs" . DIRECTORY_SEPARATOR . "AccessLog_" . date("m-Y") . ".log";
    $accessLogFile = fopen($accessLogPathFile, "a+");
    
    $logEntry = "Log:" . time() . ":" . date("d/m/Y") . ":" . $_SERVER['REMOTE_ADDR'] . ":" . "Attmept-Outcome: " . $outCome . "\r\n";
    
    fwrite($accessLogFile, $logEntry);

    fclose($accessLogFile);
}
?>
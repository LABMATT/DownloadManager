<?php
// Writes the info into the Access Log about the attempt.
function makeEntery($path, $outCome)
{
    $accessLogFile = fopen($path, "a");
    
    $logEntry = "Log:" . time() . ":" . date("d/m/Y") . ":" . $_SERVER['REMOTE_ADDR'] . ":" . "Attmept-Outcome: " . $outCome . "\r\n";
    
    fwrite($accessLogFile, $logEntry);

    fclose($accessLogFile);
}
?>
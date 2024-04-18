<?php


// Writes the info into the Access Log about the attempt. (unixTimeStamp - IPadress - Resault)
// Takes "path" of the access logs folder.
// Takes an Outcome to write to file.
function makeEntery($path, $outCome)
{
    $accessLogPathFile = $path . "Logs" . DIRECTORY_SEPARATOR . "AccessLog_" . date("m-Y") . ".log";
    $accessLogFile = fopen($accessLogPathFile, "a+");

    $logEntry = "Log:" . time() . ":" . date("d/m/Y") . ":" . getIP() . ":" . "Attmept-Outcome: " . $outCome . "\r\n";

    fwrite($accessLogFile, $logEntry);

    fclose($accessLogFile);
}


// Pritty much code form geeks for geeks that gets all the types of IP
// Returns IP or localhost if local.
function getIP()
{
    $ip = "Error";
    
    // if user from the share internet   
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } //if user is from the proxy   
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } //if user is from the remote address   
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    if($ip == "::1") {
        $ip = "localhost";
    }
    
    return $ip;
}

?>
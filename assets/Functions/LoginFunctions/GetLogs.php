<?php


// Gets array of prev logs from latest and second latest file (File spans one month)
// "accessLogPath" is where logs are stored path wise.
// "cooldown" is how long it has to be between attempts. This is used to deteman if we must acces the previos log file.
//      FEX if month has swtiched over and no enterys in this file but the cooldown is 10 minutes then see if anything last month was done 10 mins before 12am.
function getLogs($accessLogPath, $cooldown)
{
    // If this months logins events have a time period less than the minium, then recall the previos date to.
    // Fex: if someone logged on at 11:59pm then a new month rolled oven then get the previos month.
    $readPreviodMonth = true;
    $accessLogPathFile = $accessLogPath . "Logs" . DIRECTORY_SEPARATOR . "AccessLog_" . date("m-Y") . ".log";
    $accessLog[] = "";
    $prvLogArray[] = "";

    logDir($accessLogPath);

    // If the current access log file exists then read it grabbing each var.
    // IF not then read previos file (Set true by default). 
    if (file_exists($accessLogPathFile)) {
        $accessLogFile = fopen($accessLogPathFile, "r");

        while (!feof($accessLogFile)) {

            array_push($accessLog, fgets($accessLogFile));
        }

        foreach ($accessLog as $logEntry) {

            (array)$logEntry = explode(":", $logEntry);

            if (sizeof($logEntry) > 1) {
                if ((Time() - $logEntry[1]) > $cooldown) {
                    
                    echo "A prv was fdalse";

                    $readPreviodMonth = false;
                }
            }
        }

        fclose($accessLogFile);
    }
    
    
    // Flips array so the last entry is first in the array.
    $accessLog = array_reverse($accessLog);

    
    // Read the previos Month to make sure no logins were made.
    // If so push to array.
    // If Not then do nothing.
    if ($readPreviodMonth == true) {
        
        echo "Reading prev array";

        $prvFileName = "";
        $prvMonth = date("m");

        
        // Gets name of log based on the date before.
        // If its the first month then subtract 1 year and set month to 12.
        // If the month is less then 10 then make sure there is a 0 before the month number.
        // else just grab the month and use that.
        if ($prvMonth == "01") {
            $prvFileName = "AccessLog_" . 12 . "-" . (date("Y") - 1) . ".log";
        } else if (date("m") < 10) {
            $prvFileName = "AccessLog_0" . (date("m") - 1) . "-" . date("Y") . ".log";
        } else {
            $prvFileName = "AccessLog_" . (date("m") - 1) . "-" . date("Y") . ".log";
        }
        
        echo $prvFileName;
        
        
        // Make sure a prefivos file exists and if so then get contents.
        // Add contents to the "accessLog".
        if (file_exists($accessLogPath . "Logs" . DIRECTORY_SEPARATOR . $prvFileName)) {

            // Get the contents of this months current login log.
            $prevLogFile = fopen($accessLogPath . "Logs" . DIRECTORY_SEPARATOR . $prvFileName, "r");

            while (!feof($prevLogFile)) {

                array_push($prvLogArray, fgets($prevLogFile));
            }
            
            $prvLogArray = array_reverse($prvLogArray);
            
            $accessLog = array_merge($accessLog, $prvLogArray);
        }
    }
    
    print_r($accessLog);

    return $accessLog;
}


function logDir($path)
{
    if(!is_dir($path . "Logs" . DIRECTORY_SEPARATOR)) {
        mkdir($path . "Logs");
    }
}

?>
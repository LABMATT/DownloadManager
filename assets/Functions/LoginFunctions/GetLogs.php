<?php

function getLogs($accessLogPathFile, $accessLogPath, $cooldown)
{

    // Get the contents of this months current login log.
    $accessLogFile = fopen($accessLogPathFile, "a+");
    $accessLog[] = "";

    $index = 0;
    while (!feof($accessLogFile)) {
        $accessLog[$index] = fgets($accessLogFile);
        $index++;
    }


    // If this months logins events have a time period less than the minium, then recall the previos date to.
    // Fex: if someone logged on at 11:59pm then a new month rolled oven then get the previos month.
    $readPreviodMonth = true;

    foreach ($accessLog as $logEntry) {

        (array)$logEntry = explode(":", $logEntry);

        if (sizeof($logEntry) > 1) {
            if ((Time() - $logEntry[1]) > $cooldown) {

                $readPreviodMonth = false;
            }
            echo (Time() - $logEntry[1]) . "<br>";
        }
    }


    fclose($accessLogFile);


    if ($readPreviodMonth == true) {
        echo "reading back";
        $previousDateLog[] = "";

        $prvFileName = "";
        $prvMonth = date("m");
        $prvYera = "";

        if ($prvMonth == "01") {
            $prvFileName = "AccessLog_" . 12 . "-" . (date("Y") - 1) . ".log";
        } else if (date("m") < 10) {
            $prvFileName = "AccessLog_0" . (date("m") - 1) . "-" . date("Y") . ".log";
        } else {
            $prvFileName = "AccessLog_" . (date("m") - 1) . "-" . date("Y") . ".log";
        }

        echo "Prv file name:" . $prvFileName;

        // Make sure a prefivos file exists and if so then get contents.
        if (file_exists($accessLogPath . $prvFileName)) {

            // Get the contents of this months current login log.
            $prevLogFile = fopen($accessLogPath . $prvFileName, "r");
            $accessLog[] = "";

            $index = 0;
            while (!feof($prevLogFile)) {
                $accessLog[$index] = fgets($prevLogFile);
                $index++;
            }

            echo "Got the second file";
        }


    }


    return $accessLog;
}

?>
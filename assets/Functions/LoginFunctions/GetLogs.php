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

        // Get the contents of this months current login log.
        $prevLogFile = fopen($accessLogPath . "", "a+");
        $accessLog[] = "";

        $index = 0;
        while (!feof($accessLogFile)) {
            $accessLog[$index] = fgets($accessLogFile);
            $index++;
        }
    }


    return $accessLog;
}

?>
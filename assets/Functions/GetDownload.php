<?php

function GetDownload($dlid)
{
    $dlidPath = "Downloads" . DIRECTORY_SEPARATOR . "dlid_" . $dlid;

    if (is_dir($dlidPath)) {

        if (file_exists($dlidPath . DIRECTORY_SEPARATOR . "index.html")) {

            $downloadContent = file_get_contents($dlidPath . DIRECTORY_SEPARATOR . "index.html",);

            if (!$downloadContent) {

                return false;
            } else {

                echo $downloadContent;
            }

        }
        return true;
    } else return false;
}

?>
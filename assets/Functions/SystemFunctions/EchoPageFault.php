<?php

// If we cant write to the error logs then we shall write the error to the webpage. This echos a div to the page containg info about an error.
function spawnError($source, $message) {

    echo "<div class=\"criticalError\">";
    echo "<p class=\"criticalErrorHead\">DownloadManager Error (" . $source . "): </p>";
    echo "<p>" . $message . "</p>";
    echo "</div>";
    echo "<script>console.log(\"DownloadManager Error (" . $source . "): " . $message . "\"); </script>";

}

?>
<?php
// Acess Preforms functions to check if a login is valid.
require 'makeEntery.php';
require 'getAccessConfig.php';
require 'GetLogs.php';


function CheckAcess()
{
    $loginConfig = "";
    $accessLogPath = "C:\Users\Matt\Downloads\\";
    $accessLogPathFile = $accessLogPath . "AccessLog_" . date("m-Y") . ".log";
    $outCome = "Interal Server Error.";

    getLogs($accessLogPathFile, $accessLogPath, 60);

    $accessConfigJSON = getAccessConfig();
    
    if ($accessConfigJSON != null) {

    }

    
    // Logs this attempts/perptrators and outcome. 
    makeEntery($accessLogPathFile, $outCome);

}

?>
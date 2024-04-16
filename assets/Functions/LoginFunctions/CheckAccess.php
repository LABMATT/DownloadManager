<?php
// Acess Preforms functions to check if a login is valid.
require 'makeEntery.php';
require 'getAccessConfig.php';
require 'GetLogs.php';


function CheckAcess()
{
    $loginConfig = ""; 
    $accessLogPath = "C:\Users\Matt\Downloads\\";
    
    $outCome = "Interal Server Error.";

    getLogs($accessLogPath, 60);

    $accessConfigJSON = getAccessConfig();
    
    if ($accessConfigJSON != null) {

    }

    
    // Logs this attempts/perptrators and outcome. 
    makeEntery($accessLogPath, $outCome);

}

?>
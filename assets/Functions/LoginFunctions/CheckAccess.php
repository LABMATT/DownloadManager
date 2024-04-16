<?php
// Acess Preforms functions to check if a login is valid.
require 'makeEntery.php';
require 'getAccessConfig.php';
require 'GetLogs.php';
require 'ProgramFiles.php';
require 'CheckAttempt.php';


function CheckAcess()
{
    $projectPath = GetSystemPath();

    // Make sure sub DIRS are created.
    logDir($projectPath);
    configDir($projectPath);


    $loginAttempts = getLogs($projectPath, 60);
    $loginConfig = getAccessConfig();
    $outCome = checkAttempt($loginConfig, $loginAttempts);


    switch ($outCome) {
        case "Sucessful":
            break;
        case "Failure":
            break;
        case "Error":
            break;
        case "Cooldown":
            break;
        case "Dissabled":
            break;
    }


    // Logs this attempts/perptrators and outcome. 
    makeEntery($projectPath, $outCome);
}

?>
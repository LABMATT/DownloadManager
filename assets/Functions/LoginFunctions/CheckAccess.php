<?php
// Acess Preforms functions to check if a login is valid.
require 'makeEntery.php';
require 'getAccessConfig.php';
require 'GetLogs.php';
require 'ProgramFiles.php';
require 'CheckAttempt.php';
require 'GenKeys.php';
require 'loginFailed.php';


function CheckAcess()
{
    $projectPath = GetSystemPath();

    // Make sure sub DIRS are created.
    logDir($projectPath);
    configDir($projectPath);


    
    $loginConfig = getAccessConfig($projectPath);
    $loginAttempts = getLogs($projectPath, $loginConfig->login->CooldownBetweenAttempts);
    $outCome = checkAttempt($projectPath, $loginConfig, $loginAttempts);


    switch ($outCome) {
        case "Sucessful":
            break;
        case "Failure":
            break;
        case "Error":
            break;
        case "Cooldown":
            failedLogin("Login Attempt To Quick. Please Try Again Soon.", 0);
            break;
        case "Dissabled":
            break;
    }


    // Logs this attempts/perptrators and outcome. 
    makeEntery($projectPath, $outCome);
}

?>
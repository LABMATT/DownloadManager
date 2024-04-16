<?php

// If both AESu and AESp are empty and the NewUsername and NewPassword feidls contain info then hash them.
// Takes the project path for config and the json config data.
function GenKeys($filePath, $config)
{

    if(($config->login->AESu == "") && ($config->login->AESp == "")) {
        
        if(($config->login->NewUsername != "") && ($config->login->NewPassword != "")) {
            
            $config->login->AESu = password_hash($config->login->NewUsername, PASSWORD_DEFAULT);
            $config->login->AESp = password_hash($config->login->NewPassword, PASSWORD_DEFAULT);
            
            $config->login->NewUsername = "";
            $config->login->NewPassword = "";
            
            $updateLogin = fopen($filePath . "Config" . DIRECTORY_SEPARATOR . "login.config", "w");
            
            fwrite($updateLogin, json_encode($config, JSON_PRETTY_PRINT));
            
            fclose($updateLogin);
            
            failedLogin("New Username And Password Generated!", 20000);
            return false;
            
        } else {
            failedLogin("Please Reset Username And Password!", 0);
            return false;
        }
    } else {
        
        return true;
    } 
}
?>
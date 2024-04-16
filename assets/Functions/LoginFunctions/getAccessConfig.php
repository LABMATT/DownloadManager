<?php

// Verifys the config is ok. if so then returns it.
function getAccessConfig()
{

}


function configDir($path)
{
    if (!is_dir($path . "Config" . DIRECTORY_SEPARATOR)) {
        mkdir($path . "Config");
    }
    
    if(!file_exists($path . "Config" . DIRECTORY_SEPARATOR . "login.config")) {
        copy(__DIR__ . DIRECTORY_SEPARATOR . "Templatelogin.config", $path . "Config" . DIRECTORY_SEPARATOR . "login.config");
        copy(__DIR__ . DIRECTORY_SEPARATOR . "Readme.help", $path . "Config" . DIRECTORY_SEPARATOR . "Readme.help");
    }
}

?>
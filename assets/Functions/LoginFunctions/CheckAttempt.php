<?php

// Makes sure the keys are inside the file and gens new ones if needed.
function checkAttempt($projectPath, $settingsJson, $attempts)
{

    $validkey = GenKeys($projectPath, $settingsJson);

    // If not new keys and locout is false then run check.
    if ($validkey && (!$settingsJson->login->Lockedout)) {

        // Check if the cooldown period applies.
        if (checkCooldown($settingsJson, $attempts)) {
            return "Cooldown";
        }
    }

    return "Success";
}


function checkCooldown($settingsJson, $attempts)
{
    // Check to see if the last attempt was more than the cooldown ago.
    foreach ($attempts as $attempt) {

        if (str_contains($attempt, ":")) {

            $attempt = explode(":", $attempt);

            // If the time from login is >0 then its valid.
            // If time elsapsed is less than cooldown then prevent login.
            $elapsed = Time() - $attempt[1];
            
            $validtime = $elapsed > 0;
            $cooldown = $elapsed < $settingsJson->login->CooldownBetweenAttempts;
            $isCooldown = $attempt[5] == " Cooldown";
            
            echo $attempt[5];
            
            echo "Last Was cooldown: " . $isCooldown;
            
            if ($validtime && $cooldown && $isCooldown) {
                
                return true;
            }
        }
        
        echo "loop";
    }

    return false;
}

?>
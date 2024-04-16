<?php

// Makes sure the keys are inside the file and gens new ones if needed.
function checkAttempt($projectPath, $settingsJson, $attempts) {
    
    $validkey = GenKeys($projectPath, $settingsJson);
    
    // If not new keys and locout is false then run check.
    if($validkey && (!$settingsJson->login->Lockedout)) {
        
    }
}
?>
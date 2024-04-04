<?php
function checkAccess($inPassword)
{

    $fileLocation = "assets\json\access.json";

    try {

        // This block checks if the access file is accessable ironicly.
        if (file_exists($fileLocation)) {
            if (is_readable($fileLocation)) {
                if (filesize($fileLocation) == 0) {
                    throw new Exception("Server Acess File Is Empty.");
                }
            } else {
                throw new Exception("Server Does Not Have Permission To Access Login File.");
            }

        } else {
            throw new Exception("No Server Access File Found.");
        }


        // After Confirming were unlightly going to encouter common errors we can try get the json data.
        $fileData = file_get_contents($fileLocation);
        $jsonData = json_decode($fileData);


        // Check the file has the correct setup. If not then throw error.
        if (!isset($jsonData->lastattempt)) {
            throw new Exception("Server Access Format Error");
        }
        if (!isset($jsonData->attempts)) {
            throw new Exception("Server Access Format Error");
        }
        if (!isset($jsonData->longTimer)) {
            throw new Exception("Server Access Format Error");
        }
        if (!isset($jsonData->cooldown)) {
            throw new Exception("Server Access Format Error");
        }
        if (!isset($jsonData->allowedAttempts)) {
            throw new Exception("Server Access Format Error");
        }
        if (!isset($jsonData->attemptPeriod)) {
            throw new Exception("Server Access Format Error");
        }
        if (!isset($jsonData->lockedout)) {
            throw new Exception("Server Access Format Error");
        }
        if (!isset($jsonData->key)) {
            throw new Exception("Server Access Format Error");
        }


        // Now we have verifed that all the access elements are in the file we can preform locgic. make sure were not locked out, timed out or anything else.

        // lock user out if to many attempts.
        if ($jsonData->lockedout == "true") {
            throw new Exception("Locked Out Of Server. You Must Manualy Re-enable login.");
        }

        // Waits the cooldown period between attempts
        if ((time() - (int)$jsonData->lastattempt) < (int)$jsonData->cooldown) {
            throw new Exception("Please wait for cooldown period to finish.");
        }


        // If the last attempt was longer than the new try period then reset the amount of attempts and the attempts count.
        if ((time() - (int)$jsonData->lastattempt) > (int)$jsonData->attemptPeriod) {
            // set attempt new attempt long attmpet period time.

            $jsonData->attempts = 0;
        }

        // Try password
        if ($inPassword == $jsonData->key) {
            // password is correct

            $jsonData->attempts = 0;
            $jsonData->longTimer = 0;

            echo "logged in";
            putJson($fileLocation, $jsonData);

        } else {
            echo "not log";
            if ((int)$jsonData->attempts == (int)$jsonData->allowedAttempts) {
                $jsonData->lockedout = true;
                putJson($fileLocation, $jsonData);
                throw new Exception("Locked Out Of Server. To Many Attempts.");
            } else {
                $jsonData->attempts = (int)$jsonData->attempts + 1;
                putJson($fileLocation, $jsonData);
            }
        }


    } catch (Exception $e) {

        msg("red", $e->getMessage());
        return 0;
    }
}


function putJson($file, $content)
{
    $content->lastattempt = time();
    file_put_contents($file, json_encode($content));
}

?>
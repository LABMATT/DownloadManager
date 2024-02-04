<?php
// Amout of Seconds a backup is kept before been deleted. 5184000 is 60 days
$databaseBackupKeepedSeconds = 60;

//copy("test.txt","test2.txt");

clearBackup($databaseBackupKeepedSeconds);
BackupDatabase();

// if database does not exist then create database.

function CreateDatabase()
{
    
}

// Database backup copys the database file to anotehr folder.
function BackupDatabase() {
    
    // Returns a unix timestamp for rile name. 
    $unixTimestamp = time();
    
    // set the new database names
    $dbfile = 'database.bin';
    $newdbfile = 'DatabaseBackups' . DIRECTORY_SEPARATOR  . 'Database_Backup_unixts_' . $unixTimestamp . '.bin';


    // Copy the old database over to the backups folder.
    if (!copy($dbfile, $newdbfile)) {
        echo "Failed to copy old database file to backups folder.";
    }
}


function clearBackup($databaseBackupKeepedSeconds) {

    $backupFiles = scandir('DatabaseBackups');

    //print_r($backupFiles);

    if($backupFiles) {

        foreach($backupFiles as $key => $filename) {

            if (file_exists('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename)) {

                // If the file is longer than allowerble backup time then delete it.
                if($filename != '..' & $filename != '.') {
                    echo "checking file $filename <br>";
                    echo "$filename was last modified: " . filemtime($filename) . "<br>";

                    echo time() . " normal time <br>";
                    echo filemtime('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename) . "file time <br>";
                    echo (time() - filemtime('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename));

                    if((time() - filemtime('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename)) > $databaseBackupKeepedSeconds) {
                        unlink('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename);
                    }
                }

            } else {
                echo "$filename no exit: <br>";
            }
        }
    }



    /*

    */

}



?> 
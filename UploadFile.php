<?php

// Amout of Seconds a backup is kept before been deleted. 5184000 is 60 days
$databaseBackupKeepedSeconds = 60;

//copy("test.txt","test2.txt");

clearBackup($databaseBackupKeepedSeconds);
BackupDatabase();

// Creates A new LocalManifest for an uploaded file.
function CreateManifest($dlid, $fileName, $fileVersion, $fileSource, )
{
    
}


// Gens a new DLID and then adds it to the MainManifest.
function genDLID($fileName)
{
    
    $dlid = rand(0,65535); // As there non essenital we just use php random num gen.
    
    //
    $localManifestContent = new stdClass();
    $localManifestContent->dlid = $dlid;
    $localManifestContent->downloadName = "null";
    $localManifestContent->filename = "null";
    $localManifestContent->version = "null";
    $localManifestContent->dateCreated = "null";
    $localManifestContent->dateLastmodifed = "null";
    $localManifestContent->type = "null";
    $localManifestContent->description = "null";
    $localManifestContent->creatorSource = "null";
    $localManifestContent->link = "null";
    $localManifestContent->numberOfDownloads = "null";
    $localManifestContent->filesize = "null";
    $localManifestContent->passwordProtected = "no";
    
    $mainManifestContent = new stdClass();
    $mainManifestContent->dlid = $dlid;
    $mainManifestContent->downloadName = "null";
    $mainManifestContent->status = "true";
    $mainManifestContent->reason = "true";
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



// Clear backups, deletes backups older than the amout of seconds entered.
function clearBackup($databaseBackupKeepedSeconds) {

    // Scans the backup folder
    $backupFiles = scandir('DatabaseBackups');

    if($backupFiles) {

        // For each file, get the time it was made, then see if its older than the expirty date. If so delete, else leave.
        foreach($backupFiles as $key => $filename) {

            if (file_exists('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename)) {

                // If the file is longer than allowerble backup time then delete it.
                if($filename != '..' & $filename != '.') {

                    if((time() - filemtime('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename)) > $databaseBackupKeepedSeconds) {
                        unlink('DatabaseBackups' . DIRECTORY_SEPARATOR . $filename);
                    }
                }
            }
        }
    }
    
    
    
}

?> 
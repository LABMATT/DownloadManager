<?php
// Amout of days a backup is kept before been deleted. 
$databaseBackupKeepedDay = 60;

BackupDatabase();

// if database does not exist then create database.

function CreateDatabase()
{
    
}

function BackupDatabase() {
    
    // Returns a unix timestamp for rile name. 
    $unixTimestamp = time();
    
    // set the new database names
    $dbfile = 'database.bin';
    $newdbfile = DIRECTORY_SEPARATOR . 'DatabaseBackups' . DIRECTORY_SEPARATOR  . 'Database_Backup_unixts_' . $unixTimestamp . '.bin';
    
    // Copy the old database over to the backups folder.
    if (!copy($dbfile, $newdbfile)) {
        echo "Failed to copy old database file to backups folder. \n";
    }
}

?> 
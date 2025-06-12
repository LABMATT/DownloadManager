INFO FACT SHEET FOR DOWNLOAD MANGER BY LABMATT (MATTHEW LEWINGTON)


// DLID = download ID for the file. Randomly gernated on files upload to the download server.
EXAMPLE: (Download Identifcation of 166)
https://download.labmatt.space/?dlid=166&auto=0


// AUTO = If the download should start automaticly.
EXAMPLE: (Download automaticly)
https://download.labmatt.space/?dlid=166&auto=1

if(auto == 0) USER WILL HAVE TO CLICK DOWNLOAD BUTTON MANUALY.
if(auto == 1) AUTOMATICLY DOWNLAOD ON PAGE OPEN.
if(auto == 2) DIRECT REDIRECT TO DOWNLOAD FILE.


// SETTIGNS LOCATED IN Settings.json
 ---> hostName: 192.168.1.1        // You should change this to your website/server ip. This fild is importent for WGET. EG: download.labmatt.space
 ---> displayGithub: false         // If true the downloadManger GITHUB link displays at the bottom of every download page. if false it does not.
 ---> DarkTheme: true              // True = dark theme, False = Normal white, null = auto detect
 ---> Sitemap: true                // Lists all the downloads on the server in one location.
 ---> AdminPortal: true            // Enables the admin portal to change settings.


// Download Manager structure:
1. File is uploaded and given and ID.
2. A Manifest is created and placed into "Manifests" named after the uploads ID. Settings are populated
3. A folder is created in the "Downloads" folder named after the uploaded files ID.
4. The uploaded file is placed in the "Downloads" > "ID NUMBER".
5. When a user wants to dowload that file. Program looks up manifest, then gets the info and the downloads name.



// Format of Manifest for a file on the server.
 ---> dlid:                        // Download ID
 ---> downloadName:                // Name of the download                                   EG: example.jpg
 ---> status:                      // If the download is still on the server.                EG: false - No longer available. true - still avaible.
 ---> reason:                      // If download has been removed then why.                 EG: Removed to save space
 ---> passwordProtected:           // If passwordProtected Then we have to use the           EG: True
 ---> fileName:                    // The name of the File in the folder.                    EG: example.jpg
 ---> version:                     // Version of the file. If you got things with same name  EG: 1
 ---> dateCreated:                 // The date the file was made (unix timestamp             EG: 1/1/1970 - 0 in unix time stamp
 ---> dateLastModifed              // When file was last modifed.                            EG: 1/2/1970 -
 ---> type                         // File Type                                              EG: png
 ---> description:                 // A discription of what is been downloaded               EG: Our wedding photos?
 ---> creatorSource                // Who made it or is a source.                            EG: Created by LABMATT, Arasaka corp etc
 ---> link                         // Link to profile or site related to download.           EG: www.labmatt.space
 ---> numberOfDownloads            // Number of times the download button has been clicked   EG: 4 times
 ---> fileSize                     // fileSize in bytes                                      EG: 4 bytes
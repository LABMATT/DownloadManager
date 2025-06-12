INFO FACT SHEET FOR DOWNLOAD MANGER BY LABMATT (MATTHEW LEWINGTON)

// DLID = download ID for the file.
EXAMPLE:
https://download.labmatt.space/?dlid=1&auto=0
THIS BREAKS DOWN TO: //https://HOST NAME/?dlid= A NUBMER FROM 0 to 65535 &auto= 0 or 1 for auto download on page open

// URL php term "auto=" allows the files to be auto downloaded when the page is opened.
if(auto == 2) DIRECT REDIRECT.
if(auto == 1) THEN AUTO DOWNLAOD ON PAGE OPEN.
if(auto == 0) THEN DO NOTHING ON PAGE OPEN.

// A DLID (Download ID) is a randomly genrated ID between 0 and 65535.
dlid=1 ---> Leads to info in the Manifest.json that relates to the file.
       ---> Definds a folder in the Downloads Folder labed the same "1"
       ---> Inside this folder is A LocalManifest.json Containing the downloads info and file name.

// SETTIGNS LOCATED IN Manifest.json
//Under the "settings" tab you should have
 ---> hostName: 192.168.1.1        // You should change this to your website/server ip. This feild is importent for WGET. EG: download.labmatt.space
 ---> displayGithub: false         // If true the downloadManger GITHUB link displays at the bottom of every download page. if false it does not.
 ---> forceDisplayWGET             // WGET box provids an easy way for people to download the item on linux terminals.
                                   // 0 - leaves this to the indivual download page. Default Enabled.
                                   // 1 - Forces all downloads to have it.
                                   // 2 - Forces all downlaods not to have it.
 ---> autoDectectDarkTheme: true   // The download page deteacts if browser is using a dark theme then ajusts for it.


// "downloads": Format in Manifest.json
// The dlid_number is a sub catogry under the downlaod, it provides inital info on the downlaod before the local manifest. local provid more spersific info.
 ---> dlid_downloadNumber(0-65535):
  ---> downloadName                // Name of the download                                   EG: example.jpg
  ---> status                      // If the download is still on the server. If not
                                   // A message/Reason can be left.                          EG: false - No longer available. true - still avaible
  ---> reason                      // Reason why the download is not avaiable                EG: A newer version has been release, click here for new link.
  ---> passwordProtected           // If passwordProtected Then we have to use the
                                   // Exteral Server to aquire thed ownload using
                                   // Websockets                                             EG: true - its passwrod protected, false - its not and is normal downloadble.


// LocalManifest.json Setup.
// LocalManifest.json is located in each dlid folder within the downloads folder.
// It provides info about the download.
 ---> downloadName:                // The Name of the download as shown on downlaod webpage. EG photo of gate.
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
 ---> strictParameters             // If enabled All vars such as date created, modifed size
                                   // type and all must match the manifed and are compaired
                                   // to the file systems info. Else program will error      EG: true - has to match else error, false - dont check.


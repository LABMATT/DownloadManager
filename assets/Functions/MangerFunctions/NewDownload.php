<?php

$data = $_POST["jsonData"];
$autho = htmlspecialchars($_POST["autho"] ?? null);
$file = $_FILES["fileUpload"];

require "VerifyJSON.php";

//$data = file_get_contents("C:\Users\Matt\AppData\Roaming\DownloadManager" . DIRECTORY_SEPARATOR . "t.json");

print_r($data);

$validData = verifyJSON($data);

echo "valid data: " . $validData;

//$santizedData = genjson();

if($data != null) {
    
    
}
?>

<!DOCTYPE html>
<html>
<body>

<h1>My First Heading</h1>
<p>My first paragraph.</p>

</body>
</html>
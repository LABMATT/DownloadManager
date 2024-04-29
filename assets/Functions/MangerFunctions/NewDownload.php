<?php
$data = htmlspecialchars($_POST["jsonData"] ?? null);
$autho = htmlspecialchars($_POST["autho"] ?? null);
$file = $_FILES["fileUpload"];

echo "website <br>";
print_r($data);
echo "Json: " . $data . "<br>";
print_r($file);

if($data != null) {
    
    
}
?>
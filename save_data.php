<?php
require_once 'vendor/autoload.php';

use Azure\Storage\Blob\BlobServiceClient;
use Azure\Storage\Blob\BlobRestProxy;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $data = $first_name . ' ' . $last_name . PHP_EOL;
    $data_file = 'datafiles/data.txt';

    file_put_contents($data_file, $data, FILE_APPEND);
    
    $connectionString = "DefaultEndpointsProtocol=https;AccountName=cs4413webappstorage;AccountKey=b8TgJ53iXdv4KTrocr/eZSXTqygxgqr7+UuXFrLuSmTYXZTRmooZg1AN4WM99yy4AvvClXBLGu6g+ASt2gxAAg==;";
    $containerName = 'cs4413-blob';

    $blobServiceClient = BlobServiceClient::createConnection($connectionString);
    $containerClient = $blobServiceClient->getContainerClient($containerName);

    if (file_exists($data_file)) {
        $fileContent = file_get_contents($data_file);
        $blobName = 'data.txt';
        $blobClient = $containerClient->getBlobClient($blobName);

        try {
            $blobClient->upload($fileContent);
            echo "Data has been successfully uploaded to Azure Blob Storage.";
        } catch (Exception $e) {
            echo "Error: Unable to upload data to Azure Blob Storage.";
        }
    } else {
        echo "Error: Local file not found.";
    }

    header('Location: lab10/index.html');
    exit;
}
?>

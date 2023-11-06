<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $data = $first_name . ' ' . $last_name . PHP_EOL;
    $data_file = 'datafiles/data.txt';
    file_put_contents($data_file, $data, FILE_APPEND)

    header('Location: lab10/index.html');
    exit;
}
?>

<?php
require_once 'vendor/autoload.php'; // Include Azure SDK

use Azure\Storage\Blob\BlobServiceClient;
use Azure\Storage\Blob\BlobRestProxy;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $data = $first_name . ' ' . $last_name . PHP_EOL;
    $data_file = 'datafiles/data.txt';

    // Append the data to the local file
    file_put_contents($data_file, $data, FILE_APPEND);
    
    // Azure Storage Account credentials and container name
    $connectionString = "DefaultEndpointsProtocol=https;AccountName=cs4413webappstorage;AccountKey=b8TgJ53iXdv4KTrocr/eZSXTqygxgqr7+UuXFrLuSmTYXZTRmooZg1AN4WM99yy4AvvClXBLGu6g+ASt2gxAAg==;EndpointSuffix=core.windows.net";
    $containerName = 'cs4413-blob';

    // Create a BlobServiceClient instance
    $blobServiceClient = BlobServiceClient::createConnection($connectionString);

    // Get the Blob Container client
    $containerClient = $blobServiceClient->getContainerClient($containerName);

    // Check if the file exists locally
    if (file_exists($data_file)) {
        $fileContent = file_get_contents($data_file);

        // Upload the file to Azure Blob Storage
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

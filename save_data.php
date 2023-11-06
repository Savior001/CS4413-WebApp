<?php
require_once 'vendor/autoload.php';

use Azure\Core\AzureCliCredential;
use Azure\Storage\Blobs\BlobServiceClient;
use Azure\Storage\Blobs\Models\CreateContainerOptions;
use Azure\Storage\Blobs\Models\ListBlobsOptions;

$blobServiceClient = new BlobServiceClient('https://cs4413webappstorage.blob.core.windows.net/cs4413-blob', new AzureCliCredential());
$containerName = 'cs4413-blob';

$containerClient = $blobServiceClient->getContainerClient($containerName);
if (!$containerClient->exists()) {
    $containerClient->create(new CreateContainerOptions());
}

$listBlobsOptions = new ListBlobsOptions();
$blobs = $containerClient->listBlobs($listBlobsOptions);

foreach ($blobs as $blobItem) {
    echo 'Blob Name: ' . $blobItem->getName() . PHP_EOL;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $data = $first_name . ' ' . $last_name . PHP_EOL;
    $data_file = 'datafiles/data.txt';

    file_put_contents($data_file, $data, FILE_APPEND);
}

$blobClient = $containerClient->getBlobClient('data.txt');
$blobClient->upload($data, strlen($data));

$blobContents = $blobClient->download()->getContentStream()->readAll();

echo 'Downloaded Blob Contents: ' . $blobContents;

$blobClient->delete();
$containerClient->delete();
$blobServiceClient->close();
?>

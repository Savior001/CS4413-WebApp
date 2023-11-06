<?php
require_once 'vendor/autoload.php';

use Azure\Core\AzureCliCredential;
use Azure\Storage\Blobs\BlobServiceClient;
use Azure\Storage\Blobs\Models\CreateContainerOptions;
use Azure\Storage\Blobs\Models\BlobStreamOptions;

static function UploadBlob(string $accountName, string $containerName, string $blobName, string $blobContents): void {
    $blobServiceClient = new BlobServiceClient('https://' . $accountName . '.blob.core.windows.net', new AzureCliCredential());

    $containerClient = $blobServiceClient->getContainerClient($containerName);
    if (!$containerClient->exists()) {
        $containerClient->create(new CreateContainerOptions());
    }

    $blobClient = $containerClient->getBlobClient($blobName);
    $blobStreamOptions = new BlobStreamOptions();
    $blobStreamOptions->setAccessTier('Hot'); 
    $blobStreamOptions->setContentType('text/plain');
    $blobStreamOptions->setContentLanguage('en-US');
    $blobStreamOptions->setContentDisposition('attachment');
    $blobStreamOptions->setContentEncoding('gzip');
    $blobStreamOptions->setContentMD5(base64_encode(md5($blobContents, true)));
    $blobClient->uploadData($blobContents, $blobStreamOptions);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $data = $first_name . ' ' . $last_name . PHP_EOL;
    $data_file = 'datafiles/data.txt';

    file_put_contents($data_file, $data, FILE_APPEND);
    UploadBlob('cs4413webappstorage', 'cs4413-blob', 'data.txt', $data);
}
?>

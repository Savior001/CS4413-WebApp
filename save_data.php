<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    $data = $first_name . ' ' . $last_name . PHP_EOL;
    $data_file = 'datafiles/data.txt';

    file_put_contents($data_file, $data, FILE_APPEND);
    header('Location: lab10/index.html');
}

$connectionString = "DefaultEndpointsProtocol=https;AccountName=".getenv('cs4413webappstorage').";AccountKey=".getenv('b8TgJ53iXdv4KTrocr/eZSXTqygxgqr7+UuXFrLuSmTYXZTRmooZg1AN4WM99yy4AvvClXBLGu6g+ASt2gxAAg==');
$blobClient = BlobRestProxy::createBlobService($connectionString);

$createContainerOptions = new CreateContainerOptions();
$createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

$createContainerOptions->addMetaData("key1", "value1");
$createContainerOptions->addMetaData("key2", "value2");

$containerName = "blockblobs".generateRandomString();

try    {
    $blobClient->createContainer($containerName, $createContainerOptions);

    echo "Uploading BlockBlob: ".PHP_EOL;
    echo $data_file;
    echo "<br />";

    $content = fopen($data_file, "r");

    //Upload blob
    $blobClient->createBlockBlob($containerName, $fileToUpload, $data);
} catch () {
    echo "Erro while creating blob.";
}
?>

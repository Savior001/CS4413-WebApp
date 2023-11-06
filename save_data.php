<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $data = $first_name . ' ' . $last_name . PHP_EOL;
    #$data_file = 'datafiles/data.txt';
    #file_put_contents($data_file, $data, FILE_APPEND)

    $data_file = fopen("datafiles/data.txt", "w");

    if ($data_file) {
        fwrite($data_file, $data);
        fclose($data_file);
    }

    header('Location: lab10/index.html');
    exit;
}
?>
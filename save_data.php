<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    
    $data = $first_name . ' ' . $last_name . PHP_EOL;

    
    $data_file = 'datafiles/data.txt';

    if (file_put_contents($data_file, $data, FILE_APPEND) !== false) {
        echo "Saved data to the file.";
        exit;
    } else {
        echo "Failed to save data to the file.";
    }

    header('Location: lab10/index.html');
    exit;
}
?>

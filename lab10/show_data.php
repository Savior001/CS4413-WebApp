<?php

$data_file = '../datafiles/data.txt';


$data_array = file($data_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

echo '<html><head><title>Data Viewer</title></head><body>';
echo '<h1>Data Viewer</h1>';
echo '<table border="1"><tr><th>First Name</th><th>Last Name</th></tr>';
foreach ($data_array as $line) {
    list($first_name, $last_name) = explode(' ', $line, 2);
    echo '<tr><td>' . htmlspecialchars($first_name) . '</td><td>' . htmlspecialchars($last_name) . '</td></tr>';
}
echo '</table>';
echo '<br />';
echo '<a href="index.html">Return to Data Entry Form</a>';
echo '<br />';
echo '<a href="../index.html">Return to Labs page</a>';
echo '</body></html>';
?>
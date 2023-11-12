<?php
if (isset($_COOKIE['cs4413'])) {
    echo '<html><head><title>Cookie Is Set...</title></head><body>';
    echo '<p>The 'cs4413' cookie is already set with the value: ' . $_COOKIE['cs4413'] . '</p>';
    echo '<br />';
    echo '<a href="../index.html">Return to Labs page</a>';
    echo '</body></html>';
} else {
    $cookieValue = "Beware the cookie monster. >:D";
    $expirationTime = time() + 3600; // 1 hour (in seconds)
    setcookie('cs4413', $cookieValue, $expirationTime);
    echo '<html><head><title>Setting Cookie</title></head><body>';
    echo '<p>The 'cs4413' cookie has been set with the value: "' . $cookieValue . '" and will expire in 1 hour.</p>';
    echo '<br />';
    echo '<a href="../index.html">Return to Labs page</a>';
    echo '</body></html>';
}
?>
<p><?= $message ?></p>
<br />
<a href="../index.html">Return to Labs page</a>
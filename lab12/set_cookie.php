<?php
if (isset($_COOKIE['cs4413'])) {
    $message = "The 'cs4413' cookie is already set with the value: " . $_COOKIE['cs4413'];
} else {
    $cookieValue = "Beware the cookie monster. >:D";
    $expirationTime = time() + 3600; // 1 hour (in seconds)
    setcookie('cs4413', $cookieValue, $expirationTime);
    $message = "The 'cs4413' cookie has been set with the value: '$cookieValue' and will expire in 1 hour.";
}
?>
<html>
<head>
    <title>Cookie Handling</title>
</head>
<body>
    <p><?= $message ?></p>
    <br />
    <a href="../index.html">Return to Labs page</a>
</body>
</html>

<h1>Test Mail</h1>
<ul>
<?php
echo '<li>' . date('Y-m-d H:i:s') . ': Initialising</li>' . "\n";

$to = 'ben@leftclick.com.au';
$subject = 'Test Mail ' . date('Y-m-d H:i:s');
$message = 'This is a test.';
$headers = 'From: no-reply@leftclick.com.au' . "\r\n" . 'Content-type: text/plain';

echo '<li>' . date('Y-m-d H:i:s') . ': Ready to send</li>' . "\n";
echo '<li>' . date('Y-m-d H:i:s') . ': Settings: <ul><li>$to = ' . $to . '</li><li>$subject = ' . $subject . '</li><li>$message = ' . substr($message, 0, 50) . '</li><li>$headers = ' . $headers . '</li></ul></li>' . "\n";

$result = mail($to, $subject, $message, $headers, "-f ben@203.161.90.233.static.amnet.net.au");

echo '<li>' . date('Y-m-d H:i:s') . ': Mail sent, result = ' . ($result ? 'true' : 'false') . '</li>' . "\n";
?>
</ul>

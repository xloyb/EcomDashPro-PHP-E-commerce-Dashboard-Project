<?php
session_start();

$_SESSION['test_variable'] = 'Hello, this is a test variable!';

echo '<pre>';
echo 'Session ID: ' . session_id() . PHP_EOL;
echo 'Session Variables:' . PHP_EOL;
print_r($_SESSION);
echo '</pre>';
?>

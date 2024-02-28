<?php
require("settings.php");
$url =  $settings['domain'];
header("Location: $url");
die();
?>
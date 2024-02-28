<?php
require("../inc/settings.php");
$url =  $settings['domain'];
header("Location: $url");
die();
?>
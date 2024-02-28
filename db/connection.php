<?php
try{
$user= "root";
$pass= "";
$dbh = new PDO('mysql:host=localhost;dbname=beta_project',$user, $pass);
}catch(Exception $e){
    echo "Error: $e";
}
?>
<?php
require("settings.php");


function checkAuthentication() {
    global $settings;
    if (!isset($_SESSION['user_id'])) {
        echo"<script>
        alert('Check authontication Failed, Redirecting to the login page...');</script>";
        header("Refresh: 5;URL= {$settings['domain']}");
        exit();
    }
}

function  todisplaycheckAuthentication() {
    global $settings;
    return !isset($_SESSION['user_id']);
}

function  isLogged() {
    global $settings;
    if(isset($_SESSION['user_id'])){
        header("Location: index.php");
    }
}

function  todisplaycheckadminAuthentication() {
    global $settings;
    return isset($_SESSION['admin_level']) ==3;
}



function redirectToLogin() {
    echo "<script>
        window.location.href = 'login.php';
    </script>";
    exit();
}

function insufficientPrivilegesRedirect() {
    global $settings;
    echo "<script>
        alert('You do not have sufficient privileges to access this page.');
       
    </script>";
    header("Refresh: 5;URL= {$settings['domain']}");

    
    exit();
}

function checkadminAuthentication() {
    global $settings;
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['admin_level'])) {
        header("Refresh: 5;URL= {$settings['domain']}");

        redirectToLogin();
    }

    if ($_SESSION['admin_level'] != 3) {
        insufficientPrivilegesRedirect();
    }
}




?>
<?php


$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";

session_start();
require ($documentroot . "Database.php");
if (isset($_POST['actionString']) && $_POST['actionString'] = 'deleteBiometricData') {
    $query = "truncate table biometric";
    $result = mysqli_query($connection, $query);
    if ($result)
        echo "true";
    else
        echo "false";
}
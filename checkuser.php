<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
session_start();
require $documentroot . "/Database.php";


if (isset($_POST['actionString']) && $_POST['actionString'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * from userinfo where userinfo_username='$username' and userinfo_password='$password'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $dbname = $row['dbname'];
        mysqli_close($connection);
        $connection = mysqli_connect(null, $dbserveruser, $dbserverpassword, $dbname, null, $dbserverinst);
        if (!$connection) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        $query = "SELECT userinfo.*,role.* from userinfo inner join role on
        userinfo.role_id=role.role_id 
         where userinfo_username='$username' and userinfo_password='$password'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['userinfo_username'];
            $_SESSION['password'] = $row['userinfo_password'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['fullname'] = $row['userinfo_fullname'];
            $_SESSION['dbname'] = $dbname;
            //   $_SESSION['usertype']=$row['userinfo_usertype'];
            $_SESSION['role'] = $row['role_name'];
            //    $role=$row['role_name'];
            $_SESSION['loginstatus'] = true;
            echo "true";
        } else {
            // echo "false" . $dbname;
            // exit();
            echo "false";
        }
    } else {
        // echo "false" . getenv('CLOUDSQL_DB');
        // exit();
        echo "false";
    }

}



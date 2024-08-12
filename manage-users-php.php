<?php
session_start();
require ("Database.php");
if (isset($_POST['actionString']) && $_POST['actionString'] == 'createUser') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];
    $query = "insert into userinfo (userinfo_username,userinfo_fullname
    ,userinfo_passoword,role_id) values ('" . $username . "','" . $fullname . "','" . $password . "',
    '" . $role . "')";
    //  echo $query;
    if (!mysqli_query($connection, $query))
        echo "false";
    else
        echo "true";
} else if (isset($_POST['actionString']) && $_POST['actionString'] == 'updateUser') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $query = "update userinfo set userinfo_fullname='" . $fullname . "',
    userinfo_passoword='" . $password . "' where userinfo_username='" . $username . "'";
    //  echo $query;
    if (!mysqli_query($connection, $query))
        echo "false";
    else
        echo "true";
} else {
    $result = mysqli_query($connection, "select userinfo.*, role.* from userinfo 
inner join role on userinfo.role_id=role.role_id");
    $output = "";
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '                 
    <tr>
        <td>' . $i . '</td>
    <td>' . $row['userinfo_username'] . '</td>
    <td>' . $row['userinfo_fullname'] . '</td>
    <td>' . $row['userinfo_passoword'] . '</td>
    <td>' . $row['role_name'] . '</td>
    <td><input type="button" class="btn btn-info editUser" value="Edit"
    id="' . $row['userinfo_username'] . '">
            </tr>';
        $i++;
    }
    echo $output;
}
?>
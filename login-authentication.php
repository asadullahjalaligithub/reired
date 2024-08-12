<?php
session_start();
if (!isset($_SESSION['loginstatus'])) {
    header("location:index.php");
    exit();
}


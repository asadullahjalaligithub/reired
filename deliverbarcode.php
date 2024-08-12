<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require ($documentroot . 'barcode.php');
if (isset($_POST['invoice'])) {
  $text = $_POST['invoice'];
  //  $text=55555;
  $filepath = "barcodeimages/" . $text . ".png";
  $size = "40";
  $orientation = "horizontal";
  $code_type = "code39";
  $print = false;
  $SizeFactor = 1;
  barcode($filepath, $text, $size, $orientation, $code_type, $print, $SizeFactor);
  header('location:printDeliverySheet.php?filename=' . $text);// Instanciation of inherited class
}

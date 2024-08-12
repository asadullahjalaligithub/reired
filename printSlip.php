<?php
require('barcode.php');
require('Database.php');


if(isset($_GET['filename']))
{
    $invoice=$_GET['filename'];
    $query="select application.application_referenceno from application inner join
    invoice on invoice.invoice_no=application.application_invoice_no where invoice.invoice_no='$invoice'";
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
    $text=$row['application_referenceno'];
   // $filepath="barcodeimages/".$text.".png";
    $filename=$text.".png";
    $filepath="barcodeimages/".$text.".png";
    $size="40";
    $orientation="horizontal";
    $code_type="code39";
    $print=false;
    $SizeFactor=1;
 
   barcode( $filepath, $text, $size, $orientation, $code_type, $print, $SizeFactor);
 header('location:slip.php?filename='.$filename.'&no='.$text);   
// Instanciation of inherited class

}
?>

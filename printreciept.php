<?php
session_start();
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
require("Database.php");
date_default_timezone_set('Asia/Kabul');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Asadullah Jalali');
$pdf->SetTitle('my simple PDF');
$pdf->SetSubject('Nothing especial');
$pdf->SetKeywords('this is the guide');

// set default header data
$currentDate=date('Y/m/d');
$currentTime=date('H:i:s');

$pdf->SetHeaderData('','','Reciept Sheet : ',$currentDate.' '.$currentTime, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
//$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
// set some language dependent data:
/*$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';
*/
// set some language-dependent strings (optional)
//$pdf->setLanguageArray($lg);

$pdf->SetFont('times', '', 10, '', true);
// convert TTF font to TCPDF format and store it on the fonts folder 

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print

// Print text using writeHTMLCell()
$html='';
if(isset($_GET['filename']))
{
    $invoiceno=$_GET['filename']; 
   // $invoiceno=55555;
    $query="SELECT invoice.*, point_of_contact.*
FROM invoice
    inner JOIN application ON application.application_Invoice_no = invoice.invoice_no
    inner JOIN point_of_contact ON application.application_poc_id = point_of_contact.poc_id
    where invoice.invoice_no=".$invoiceno;
    $result=mysqli_query($connection,$query);
    $row1=mysqli_fetch_assoc($result);
    $html.='
<table cellspacing="0" style="padding:2px">
<tr>
<td >
<img src="images/reiredlogo.png" style="width:200px; height:70px">
</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img   src="barcodeimages/'.$row1['invoice_no'].'.png" style="width:150px; height:80px">
</td>
</tr>
<tr>
<td>
</td>
<td style="text-align:center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RTS-KBL-'.$row1['invoice_no'].'</td>
</td>
</tr>
</table>
';
    $date=str_replace('-','',$row1['invoice_date']);
    
$pdf->writeHTMLCell(0, 0, '', '', $html, true); 
$pdf->ln(34);
$pdf->cell(120,0,'Reciept No :'.$row1['invoice_no'].$date,0,0,'L');
$pdf->cell(120,0,'Reciept Date :'.date('Y/m/d'),0,1,'L');
    $pdf->ln();
   // $pdf->Line(5, $pdf->y, $pdf->w - 5, $pdf->y);
    $pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->cell(120,0,'Invoice No :'.$row1['invoice_no'],0,0,'L');
$pdf->cell(0,0,'Service Type : Normal',0,1,'L'); 
$pdf->ln();
    //  $pdf->SetFont('times','B','10');
    $html = '
<table cellspacing="0" cellpadding="1" border="1" width="640px">
<tr style="font-weight:bold">
<th  align="center">Applicant\'s Name</th>
<th align="center">P.P.#</th>
<th align="center">US$</th>
</tr>';
$query='SELECT invoice.*, application.*, applicant.*
FROM invoice
    inner JOIN application ON application.application_Invoice_no = invoice.invoice_no
    inner JOIN applicant ON application.application_applicant_id = applicant.applicant_id
where invoice.invoice_no='.$invoiceno.'';
    $result=mysqli_query($connection,$query);
    $i=1;
    $sum1=0;
    $sum2=0;
    while($row2=mysqli_fetch_assoc($result)) {
        $user=$row2['application_enterby'];
        $sum1+=$row2['application_embassycharges'];
        $sum2+=$row2['application_TVACcharges'];
        $fullname=$row2['applicant_firstname'].' '.$row2['applicant_lastname'];
 $html.='   
<tr>

<td align="center">'.strtoupper($fullname).'</td>
<td align="center" >'.$row2['applicant_passportno'].'</td>
<td align="center">'.$row2['application_embassycharges'].'.00</td>

</tr>
';
   $i++; }
     
     $html.='
<tr>
<td colspan="2" align="right">Embassy Fee US$</td>
<td align="center">'.$sum1.'.00</td>


</tr>
<tr>
<td colspan="2" align="right">Package Service Fee US$</td>
<td  align="center">'.$sum2.'.00</td>


</tr>
<tr>
<td colspan="2" align="right">Total US$</td>
<td  align="center">'.($sum1+$sum2).'.00</td>


</tr>
</table>
';
 //   $pdf->writeHTMLcell(0, 0, '', '', $html, true); 
   
        $pdf->writeHTML($html, true, false, false, false, '');
    
    $pdf->cell(120,0,'Prepared By: '.$user.'',0,0,'',0,'',0,false,'T','T');
    $pdf->cell(60,0,date('Y/m/d').' '.date('H:i:s'),0,1,'',0,'',0,false,'T','T');
    $pdf->ln();
    $pdf->cell(0,40,'Cashier Sign. Stamp:',1,0,'',0,'',0,false,'T','T');

}


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
  ob_end_clean();
$pdf->Output($invoiceno.'.pdf', 'I');

unlink('barcodeimages/'.$row1['invoice_no'].'.png');
//============================================================+
// END OF FILE
//============================================================+





//Orginal form of it
/*<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04


// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Asadullah Jalali');
$pdf->SetTitle('my simple PDF');
$pdf->SetSubject('Nothing especial');
$pdf->SetKeywords('this is the guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('times', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
require('invoiceexample.php');
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
  ob_end_clean();
$pdf->Output('invoice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
*/
?>

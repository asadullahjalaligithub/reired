<?php require("login-authentication.php"); 
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
require("Database.php");
date_default_timezone_set('Asia/Kabul');
if($_SESSION['role']=='user' || $_SESSION['role']=='view') {
    header('location:index.php?logout=true');
}
    
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

$pdf->SetHeaderData('','','','Application Manifest : '.$currentDate.' '.$currentTime, array(0,64,255), array(0,64,128));
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

$pdf->SetFont('times', '', 14, '', true);
// convert TTF font to TCPDF format and store it on the fonts folder 

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print

// Print text using writeHTMLCell()
$html='';
if(isset($_GET['s']) && isset($_GET['e']))
{
    $s=$_GET['s'];
    $e=$_GET['e']; 
   // $invoiceno=55555;
  /*  $query="SELECT applicant.*, application.*, invoice.*, point_of_contact.*
FROM invoice
    inner JOIN application ON application.application_Invoice_no = invoice.invoice_no
    inner JOIN applicant ON application.application_applicant_id = applicant.applicant_id
    inner JOIN point_of_contact ON application.application_poc_id = point_of_contact.poc_id    WHERE
    application.application_entrydate>='$s' and application.application_entrydate<='$e'
    order by application.application_entrydate";
*/// Image example with resizing
//$pdf->Image('images/reiredlogo.png', 15, 18, 75, 30, 'png', '', '', true, 150, '', false, false, 0, false, false, false);
//$pdf->Image('images/reiredlogo.png', 15, 18, 75, 30, 'png', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Image('images/mylogo.jpg',15,18,75,30,'jpg');
  //  $html='<img src="images/mylogo.jpg" width="20" height="30">';
    // $pdf->writeHTML($html, true, false, false, false, '');
    $pdf->setFont('Times','B',14);
    $pdf->ln(5);
    $pdf->cell(120);
    $pdf->cell(80,0,'Application Manifest',0,1,'l');
    $pdf->cell(120);
    
    $pdf->setFont('Times','',10);
    $pdf->cell(80,0,'From : '.$s,0,1,'l');
    $pdf->cell(120);
    $pdf->cell(80,0,'To : '.$e,0,1,'l');
    $pdf->ln(15);
     $html.='
     <table cellpadding="5px" width="800px">
     
             <tr>
                 <td width="55px"><b>Inv. No.</b></td>
                 <td width="180px"><b>Applicant\'s Name</b></td>
                 <td width="80px"><b>Passport</b></td>
                 <td width="130px"><b>Embassy Ref.No</b></td>
                 <td width="80px"><b>Visa Type</b></td>
                 <td width="60px"><b>Tax Charges</b></td>
                 <td width="80px"><b>Visa Chgs</b></td>
             </tr>
          

         ';    $query="select invoice.* from invoice where invoice_date>='$s' and invoice_date<='$e'";
    $totaltax=0;
    $totalvisa=0;
    $totaltvaccharges=0;
    $result=mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($result))
    {
      $query2="select  application.application_TVACcharges,applicant.applicant_firstname, applicant.applicant_lastname, applicant.applicant_passportno, application.application_referenceno, application.application_visaType, application.application_embassycharges
FROM applicant
    inner JOIN application ON application.application_applicant_id = applicant.applicant_id
    where application.application_invoice_no=".$row['invoice_no'];

           $result2=mysqli_query($connection,$query2);
        $totalapplicant=0;
        $count=0;
      $print=true;
        while($row2=mysqli_fetch_assoc($result2))
        {   
           
            $totalapplicant+=$row2['application_embassycharges'];
            $fullname=$row2['applicant_firstname'].' '.$row2['applicant_lastname'];
          //  $tax=($row2['application_embassycharges']*10)/100;
           $tax = ($row2['application_TVACcharges']*20)/100;
                
            $totalvisa+=$row2['application_embassycharges'];
            $totaltax+=$tax;
            $totaltvaccharges+=$row2['application_TVACcharges'];
            if($print==true)
            {
                  $html.='
            <tr>
            <td colspan="7"><b>Invoice Date : </b>'.$row['invoice_date'].'</td>
            </tr>';
                $print=false;
            }
           
            $html.='
            <tr>
            <td>'.$row['invoice_no'].'</td>
            <td>'.strtoupper($fullname).'</td>
            <td>'.$row2['applicant_passportno'].'</td>
            <td>'.$row2['application_referenceno'].'</td>
            <td>'.$row2['application_visaType'].'</td>
            <td>'.$tax.'.00</td>
            <td>'.$row2['application_embassycharges'].'.00</td>
            </tr>
            ';
          
            $count++;
        }
     if($count!=0)
     {
            $html.=' <tr>
            <td colspan="4">No of Applicants : '.$count.'</td>
            <td colspan="3" align="right">'.$totalapplicant.'.00</td>
            </tr>
            <tr>
            <td colspan="3">List of Original Documents </td>
            <td colspan="4">'.$row['original_documents'].'</td>
            </tr>
            <tr>
            <td colspan="3">List of Original Relative Documents </td>
            <td colspan="4">'.$row['related_documents'].'</td>
            </tr>
            <tr>
            <td colspan="3">List of Supportive Documents </td>
            <td colspan="4">'.$row['supportive_documents'].'</td>
            </tr>
            <tr>
            <td colspan="2">Remarks</td>
            <td colspan="5">'.$row['invoice_description'].'</td>
            </tr>
            
            ';
         
        $html.=' <tr>
            <td colspan="7"></td>
            </tr>';
    
     }
    }
        $html.='
        <tr>
        <td colspan="6" align="right"><b>Total Visa Charges</b></td>
        <td><b>'.$totalvisa.'.00</b></td>
        </tr>
        <tr>
        <td colspan="6" align="right"><b>Total Tax Charges</b></td>
        <td><b>'.$totaltax.'.00</b></td>
        </tr>
        <tr>
        <td colspan="6" align="right"><b>Total TVAC Charges</b></td>
        <td><b>'.($totaltvaccharges-$totaltax).'.00</b></td>
        </tr>
        </table>
        <style> td {border:solid 1px lightgray;} 
        
        </style>';
   $pdf->writeHTML($html, true, false, false, false, '');
  $query3="select
  sum(case when application_visaType = 'Touristic' then 1 else 0 end) as tourist,
  sum(case when application_visaType = 'Business' then 1 else 0 end) as business,
  sum(case when application_visaType = 'Student / Education' then 1 else 0 end) as student,
  sum(case when application_visaType = 'Medical / Treatment' then 1 else 0 end) as medical,
  sum(case when application_visaType = 'Training' then 1 else 0 end) as training,
  sum(case when application_visaType = 'Conference / Seminar' then 1 else 0 end) as conference,
  sum(case when application_visaType = 'Transit' then 1 else 0 end) as transit,
  sum(case when application_visaType='Turkey ScholarShip Student' then 1 else 0 end) as turkey,
  sum(case when application_visaType = 'Official Medical' then 1 else 0 end) as official,
  sum(case when application_visaType = 'Other Scholarship Situation' then 1 else 0 end) as scholarship,
  sum(case when application_visaType = 'Some Special Meetings / Visit' then 1 else 0 end) as meeting,
  sum(case when application_visaType = 'Sportive Activity Visa' then 1 else 0 end) as Sportive,
  sum(case when application_visaType = 'Cultural Artist Activity Visa' then 1 else 0 end) as cultural,
  sum(case when application_visaType = 'Festival/Fare/Exhibition Visa' then 1 else 0 end) as festival,
  sum(case when application_visaType = 'Work' then 1 else 0 end) as work
from application
where application_entrydate>='$s' and application_entrydate<='$e'";
    $result=mysqli_query($connection,$query3);
    $html=' <table cellpadding="5px" width="300px" >
    <tr><td><b>Passport</b></td><td><b>Visa Type</b></td></tr>';
    $visacount=0;
    $row3=mysqli_fetch_assoc($result);
    if($row3['turkey']!=0){
    $html.='<tr>
    <td>'.$row3['turkey'].'</td>
    <td>Turkey Scholarship Student</td>
    </tr>';
        $visacount+=$row3['turkey'];
    }
    if($row3['work']!=0){
    $html.='<tr>
    <td>'.$row3['work'].'</td>
    <td>work</td>
    </tr>';
        $visacount+=$row3['work'];
    }
    if($row3['meeting']!=0){
    $html.='<tr>
    <td>'.$row3['meeting'].'</td>
    <td>Some Special Meeting / Visit</td>
    </tr>';
        $visacount+=$row3['meeting'];
    }
    if($row3['scholarship']!=0){
    $html.='<tr>
    <td>'.$row3['scholarship'].'</td>
    <td>Other Scholarship Situation</td>
    </tr>';
        $visacount+=$row3['scholarship'];
    }
    if($row3['official']!=0){
    $html.='<tr>
    <td>'.$row3['official'].'</td>
    <td>Official Medical</td>
    </tr>';
        $visacount+=$row3['official'];
    }
    if($row3['transit']!=0){
    $html.='<tr>
    <td>'.$row3['transit'].'</td>
    <td>Transit</td>
    </tr>';
        $visacount+=$row3['transit'];
    }
    if($row3['conference']!=0){
    $html.='<tr>
    <td>'.$row3['conference'].'</td>
    <td>Conference / Seminar</td>
    </tr>';
        $visacount+=$row3['conference'];
    }
    if($row3['training']!=0){
    $html.='<tr>
    <td>'.$row3['training'].'</td>
    <td>Training</td>
    </tr>';
        $visacount+=$row3['training'];
    }
    if($row3['medical']!=0){
    $html.='<tr>
    <td>'.$row3['medical'].'</td>
    <td>Medical / Treatment</td>
    </tr>';
        $visacount+=$row3['medical'];
    }
    if($row3['tourist']!=0){
    $html.='<tr>
    <td>'.$row3['tourist'].'</td>
    <td>Tourist</td>
    </tr>';
        $visacount+=$row3['tourist'];
    }if($row3['business']!=0){
    $html.='<tr>
    <td>'.$row3['business'].'</td>
    <td>Business</td>
    </tr>';
        $visacount+=$row3['business'];
		
		
    }if($row3['student']!=0){
    $html.='<tr>
    <td>'.$row3['student'].'</td>
    <td>Student / Education</td>
    </tr>';
        $visacount+=$row3['student'];
		
    }if($row3['Sportive']!=0){
    $html.='<tr>
    <td>'.$row3['Sportive'].'</td>
    <td>Sportive Activity</td>
    </tr>';
        $visacount+=$row3['Sportive'];
	}
	
	if($row3['festival']!=0){
    $html.='<tr>
    <td>'.$row3['festival'].'</td>
    <td>Festival/Exhibition</td>
    </tr>';
        $visacount+=$row3['festival'];
	}
	
		if($row3['cultural']!=0){
    $html.='<tr>
    <td>'.$row3['cultural'].'</td>
    <td>Cultural/Artist</td>
    </tr>';
        $visacount+=$row3['cultural'];
	}
	
	
    $html.='
    <tr>
    <td><b>Total</b></td>
    <td><b>'.$visacount.'</b></td>
    </tr>
    </table><style> td {border:solid 1px lightgray;} 
        
        </style>';
    $pdf->Addpage();
   $pdf->writeHTML($html, true, false, false, false, '');
       ob_end_clean();
$pdf->output($s.'to'.$e.'.pdf','I');
   
}
  /*  
$pdf->writeHTMLCell(0, 0, '', '', $html, true); 
$pdf->ln(34);
$pdf->cell(120,0,'Reciept No :'.$row1['invoice_no'].$date,0,0,'L');
$pdf->cell(120,0,'Reciept No :'.$row1['invoice_no'].$date,0,1,'L');
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
        $fullname=$row2['applicant_firstname'].$row2['applicant_lastname'];
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
<td colspan="2" align="right">Services Fee US$</td>
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

  $pdf->Output($invoiceno.'.pdf', 'I');
*/
 
//unlink('barcodeimages/'.$row1['invoice_no'].'.png');

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

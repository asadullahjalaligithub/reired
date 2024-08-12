<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require ($documentroot . "login-authentication.php");
// Include the main TCPDF library (search for installation path).
require_once ($documentroot . 'tcpdf/tcpdf.php');
require ($documentroot . "Database.php");
date_default_timezone_set('Asia/Kabul');
if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'view' || $_SESSION['role'] == 'finance') {
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
$currentDate = date('Y/m/d');
$currentTime = date('H:i:s');

$pdf->SetHeaderData('', '', '', 'General Report : ' . $currentDate . ' ' . $currentTime, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once (dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetFont('times', '', 14, '', true);

$pdf->AddPage();

$html = '';
if (isset($_GET['s']) && isset($_GET['e'])) {
    $s = $_GET['s'];
    $e = $_GET['e'];

    $pdf->Image('images/mylogo.jpg', 15, 18, 75, 30, 'jpg');
    //  $html='<img src="images/mylogo.jpg" width="20" height="30">';
    // $pdf->writeHTML($html, true, false, false, false, '');
    $pdf->setFont('Times', 'B', 14);
    $pdf->ln(5);
    $pdf->cell(120);
    $pdf->cell(80, 0, 'General Report', 0, 1, 'l');
    $pdf->cell(120);

    $pdf->setFont('Times', '', 10);
    $pdf->cell(80, 0, 'From : ' . $s, 0, 1, 'l');
    $pdf->cell(120);
    $pdf->cell(80, 0, 'To : ' . $e, 0, 1, 'l');
    $pdf->ln(15);

    $queryView1 = "create or replace view v_applicant_application as
select applicant.*, application.*,province.province_name,province.zone_id from applicant INNER join application 
on applicant.applicant_id=application.application_applicant_id inner join province
on applicant.province_id=province.province_id
 where application.application_date>='" . $s . "' and application.application_date<='" . $e . "'";
    mysqli_query($connection, $queryView1);
    $queryView2 = "create or replace view v_test1 as
select CEIL(DATEDIFF( CURRENT_DATE,v_applicant_application.applicant_dob)/365.25) as age,count(v_applicant_application.application_applicant_id) as numofApplicant
from v_applicant_application group by (age) ";
    mysqli_query($connection, $queryView2);

    $queryView3 = "create or replace view v_test2 as
select sum(numofApplicant) as total from v_test1";

    mysqli_query($connection, $queryView3);

    $queryView4 = "create or replace view v_test3 AS
select v_test1.age,v_test1.numofApplicant,(v_test1.numofApplicant*100) / v_test2.total as percent FROM v_test1,v_test2";

    mysqli_query($connection, $queryView4);
    $html .= '
     <table cellpadding="5px" width="650px">
          <tr> 
          <td colspan="3" align="center" id="firstrow"><h1>Age Statistics</h1></td>
          </tr>
             <tr>
                 <td ><b>Age</b></td>
                 <td ><b>Frequency</b></td>
                 <td ><b>Percentage</b></td>
             </tr>
         ';

    $queryView5 = "select * from v_test3";
    $fcount = 0;
    $pcount = 0;
    $result = mysqli_query($connection, $queryView5);
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
        <td>' . $row['age'] . '</td>
        <td>' . $row['numofApplicant'] . '</td>
        <td>' . $row['percent'] . '%</td>
        </tr>';
        $fcount += $row['numofApplicant'];
        $pcount += $row['percent'];
    }
    $html .= '<tr>
    <td><b>Total</b></td>
    <td><b>' . $fcount . '</b></td>
    <td><b>' . ceil($pcount) . '%</b></td>
    </tr>
    </table>';
    $html .= '
        </table><style> td {border:solid 1px skyblue; text-align:center;}
       td#firstrow{background-color:red; color:white;}
        </style>';
    $pdf->writeHTML($html, true, false, false, false, '');

    $pdf->addPage();
    // gender queries
    $queryView6 = 'create or replace view v_gender as 
select v_applicant_application.applicant_gender, count(v_applicant_application.application_no) as totalGender from v_applicant_application group by v_applicant_application.applicant_gender';
    mysqli_query($connection, $queryView6);

    $queryView7 = '
create or replace view v_genderPercent as 
select 
v_gender.applicant_gender as gender,
v_gender.totalGender as Count,
(v_gender.totalGender *100)/v_test2.total as percent 
from v_gender,v_test2';
    mysqli_query($connection, $queryView7);

    $html = '
     <table cellpadding="5px" width="650px">
          <tr> 
          <td colspan="3" align="center" id="firstrow"><h1>Gender Statistics</h1></td>
          </tr>
             <tr>
                 <td><b>Gender</b></td>
                 <td><b>Frequency</b></td>
                 <td><b>Percentage</b></td>
             </tr>
         ';

    $queryView8 = 'select * from v_genderPercent';
    $fcount = 0;
    $pcount = 0;
    $result = mysqli_query($connection, $queryView8);
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
    <td>' . $row['gender'] . '</td>
    <td>' . $row['Count'] . '</td>
    <td>' . $row['percent'] . '%</td>
    </tr>';
        $fcount += $row['Count'];
        $pcount += $row['percent'];
    }
    $html .= '<tr>
    <td><b>Total</b></td>
    <td><b>' . $fcount . '</b></td>
    <td><b>' . ceil($pcount) . '%</b></td>
    </tr>';
    $html .= '
        </table><style> td {border:solid 1px skyblue; text-align:center;}  
         td#firstrow{background-color:red; color:white;}
        </style>';
    $pdf->writeHTML($html, true, false, false, false, '');

    // Resident Statistics

    $pdf->ln(20);
    $queryView12 = 'create or replace view v_zone as
select v_applicant_application.zone_id, count(v_applicant_application.application_no) as count from v_applicant_application group by v_applicant_application.zone_id';
    mysqli_query($connection, $queryView12);

    $queryView13 = 'create or replace view  v_zonePercentage as
select v_zone.zone_id, v_zone.count, (v_zone.count*100/v_test2.total) as percentage from v_zone, v_test2';
    mysqli_query($connection, $queryView13);

    $html = '
     <table cellpadding="5px" width="650px">
          <tr> 
          <td colspan="3" align="center" id="firstrow"><h1>Resident Statistics</h1></td>
          </tr>
             <tr>
                 <td><b>Resident</b></td>
                 <td><b>Frequency</b></td>
                 <td><b>Percentage</b></td>
             </tr>
         ';
    $queryView11 = 'select * from v_zonePercentage';
    $fcount = 0;
    $pcount = 0;
    $result = mysqli_query($connection, $queryView11);
    while ($row = mysqli_fetch_assoc($result)) {
        $zoneid = $row['zone_id'];
        if ($zoneid == '201')
            $zone = "kabul";
        else if ($zoneid == '202')
            $zone = "Herat";
        else if ($zoneid == '203')
            $zone = "Kandahar";
        else if ($zoneid == '204')
            $zone = "Mazare-sharif";
        else if ($zoneid == '205')
            $zone = "Other";
        $html .= '<tr>
    <td>' . $zone . '</td>
    <td>' . $row['count'] . '</td>
    <td>' . $row['percentage'] . '%</td>
    </tr>';
        $fcount += $row['count'];
        $pcount += $row['percentage'];
    }
    $html .= '<tr>
    <td><b>Total</b></td>
    <td><b>' . $fcount . '</b></td>
    <td><b>' . ceil($pcount) . '%</b></td>
    </tr></table>';
    $html .= '
        <style> 
         td {border:solid 1px skyblue; text-align:center;}  
         td#firstrow{background-color:red; color:white;}
        </style>';
    $pdf->writeHTML($html, true, false, false, false, '');

    // Visa Status
    $pdf->ln(20);
    $queryView14 = 'create or replace view v_visastatus AS select v_applicant_application.application_approvestatus, count(v_applicant_application.application_no) as count from v_applicant_application group by v_applicant_application.application_approvestatus;';
    mysqli_query($connection, $queryView14);

    $queryView15 = 'create or replace view v_visaPercentage AS select v_visastatus.application_approvestatus, v_visastatus.count, (v_visastatus.count*100)/v_test2.total as percent from v_visastatus, v_test2;';
    mysqli_query($connection, $queryView15);

    $html = '
     <table cellpadding="5px" width="650px">
          <tr> 
          <td colspan="3" align="center" id="firstrow"><h1>Visa Status Statistics</h1></td>
          </tr>
             <tr>
                 <td><b>Visa Type</b></td>
                 <td><b>Frequency</b></td>
                 <td><b>Percentage</b></td>
             </tr>
         ';
    $queryView16 = 'select * from v_visaPercentage';
    $fcount = 0;
    $pcount = 0;
    $result = mysqli_query($connection, $queryView16);
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
    <td>' . $row['application_approvestatus'] . '</td>
    <td>' . $row['count'] . '</td>
    <td>' . $row['percent'] . '%</td>
    </tr>';
        $fcount += $row['count'];
        $pcount += $row['percent'];
    }
    $html .= '<tr>
    <td><b>Total</b></td>
    <td><b>' . $fcount . '</b></td>
    <td><b>' . floor($pcount) . '%</b></td>
    </tr>';
    $html .= '
        </table><style> td {border:solid 1px skyblue; text-align:center;}  
         td#firstrow{background-color:red; color:white;}
        </style>';
    $pdf->writeHTML($html, true, false, false, false, '');



    // occupation

    $pdf->addPage();
    $queryView9 = 'Create or replace view v_occupation as
select v_applicant_application.applicant_occupation, count(v_applicant_application.application_no) as count from v_applicant_application group by v_applicant_application.applicant_occupation';
    mysqli_query($connection, $queryView9);

    $queryView10 = 'create or replace view v_occupationPercent as
select v_occupation.applicant_occupation, v_occupation.count as count , (v_occupation.count*100/v_test2.total) as percent from v_occupation,v_test2';
    mysqli_query($connection, $queryView10);

    $html = '
     <table cellpadding="5px" width="650px">
          <tr> 
          <td colspan="3" align="center" id="firstrow"><h1>Occupation Statistics</h1></td>
          </tr>
             <tr>
                 <td><b>Occupation</b></td>
                 <td><b>Frequency</b></td>
                 <td><b>Percentage</b></td>
             </tr>
         ';
    $queryView11 = 'select * from v_occupationPercent';
    $fcount = 0;
    $pcount = 0;
    $result = mysqli_query($connection, $queryView11);
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
    <td>' . $row['applicant_occupation'] . '</td>
    <td>' . $row['count'] . '</td>
    <td>' . $row['percent'] . '%</td>
    </tr>';
        $fcount += $row['count'];
        $pcount += $row['percent'];
    }
    $html .= '<tr>
    <td><b>Total</b></td>
    <td><b>' . $fcount . '</b></td>
    <td><b>' . floor($pcount) . '%</b></td>
    </tr>';
    $html .= '
        </table><style> td {border:solid 1px skyblue; text-align:center;}  
         td#firstrow{background-color:red; color:white;}
        </style>';
    $pdf->writeHTML($html, true, false, false, false, '');



    // Visa type count
    $pdf->addPage();
    $queryView17 = 'create or replace view v_visatypecount AS select v_applicant_application.application_visaType, count(v_applicant_application.application_no) as count from v_applicant_application group by v_applicant_application.application_visaType';
    mysqli_query($connection, $queryView17);

    $queryView18 = 'create or replace view v_visatype_percentage
AS
select v_visatypecount.application_visaType, v_visatypecount.count, (v_visatypecount.count*100)/v_test2.total as percentage from v_visatypecount, v_test2;
';
    mysqli_query($connection, $queryView18);

    $html = '
     <table cellpadding="5px" width="650px">
          <tr> 
          <td colspan="3" align="center" id="firstrow"><h1>Visa Type  Statistics</h1></td>
          </tr>
             <tr>
                 <td><b>Visa Type</b></td>
                 <td><b>Frequency</b></td>
                 <td><b>Percentage</b></td>
             </tr>
         ';
    $queryView19 = 'select * from v_visatype_percentage';
    $fcount = 0;
    $pcount = 0;
    $result = mysqli_query($connection, $queryView19);
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
    <td>' . $row['application_visaType'] . '</td>
    <td>' . $row['count'] . '</td>
    <td>' . $row['percentage'] . '%</td>
    </tr>';
        $fcount += $row['count'];
        $pcount += $row['percentage'];
    }
    $html .= '<tr>
    <td><b>Total</b></td>
    <td><b>' . $fcount . '</b></td>
    <td><b>' . floor($pcount) . '%</b></td>
    </tr>';
    $html .= '
        </table><style> td {border:solid 1px skyblue; text-align:center;}  
         td#firstrow{background-color:red; color:white;}
        </style>';
    $pdf->writeHTML($html, true, false, false, false, '');

    // Full ScholarShip statistics
    $pdf->ln(30);
    $queryView20 = "select count(v_applicant_application.application_no) from v_applicant_application where v_applicant_application.application_embassycharges='' and v_applicant_application.application_TVACcharges!='' ";
    $result = mysqli_query($connection, $queryView20);
    $row = mysqli_fetch_array($result);
    $serviceVisa = $row[0];
    $queryView21 = "select count(v_applicant_application.application_no) from v_applicant_application where v_applicant_application.application_TVACcharges='' and v_applicant_application.application_embassycharges='' ";
    $result = mysqli_query($connection, $queryView21);
    $row = mysqli_fetch_array($result);
    $scholarshipVisa = $row[0];
    $html = '
     <table cellpadding="5px" width="650px">
          <tr> 
          <td colspan="3" align="center" id="firstrow"><h1>Service and Scholarship Visa   Statistics</h1></td>
          </tr>
             <tr>
                 <td><b>Visa Type</b></td>
                 <td><b>Frequency</b></td>
                 <td><b>Percentage</b></td>
             </tr>
         ';
    $html .= '<tr>
    <td> ScholarShip</td>
    <td>' . $scholarshipVisa . '</td>
    <td>' . round((($scholarshipVisa * 100) / $fcount), 2) . '%</td>
    </tr>
    <tr>
    <td> Service</td>
    <td>' . $serviceVisa . '</td>
    <td>' . round((($serviceVisa * 100) / $fcount), 2) . '%</td>
    </tr>
    ';
    $pcount = ($scholarshipVisa * 100) / $fcount + ($serviceVisa * 100) / $fcount;
    $fcount = $scholarshipVisa + $serviceVisa;
    $html .= '<tr>
    <td><b>Total</b></td>
    <td><b>' . $fcount . '</b></td>
    <td><b>' . round($pcount, 2) . '%</b></td>
    </tr>';
    $html .= '
        </table><style> td {border:solid 1px skyblue; text-align:center;}  
         td#firstrow{background-color:red; color:white;}
        </style>';
    $pdf->writeHTML($html, true, false, false, false, '');


    ob_end_clean();
    $pdf->output($s . 'to' . $e . '.pdf', 'I');
}

//unlink('barcodeimages/'.$row1['invoice_no'].'.png');

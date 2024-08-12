<?php

session_start();
require ("Database.php");
if (isset($_POST['actionString']) && $_POST['actionString'] == 'markPaid') {
    // $empty=false;
    $invoiceArray = $_POST['invoiceArray'];
    /*    foreach($invoiceArray as $invoice) {
            $result=mysqli_query($connection,"select application.application_referenceno from application where application_invoice_no='$invoice'");
            while($row=mysqli_fetch_assoc($result))
            {
                if(is_null($row['application_referenceno']))
                { $empty=true;
                 break;
                }
            }
        }
        if($empty==false)
        {*/
    foreach ($invoiceArray as $invoice) {
        mysqli_query($connection, "update application set application_feestatus='paid' where application_invoice_no='$invoice'");
    }
    echo "true";
    //    }
    //  else
    //    echo "false";
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'sendtoconsulate') {
    $empty = "paid";
    $invoiceArray = $_POST['invoiceArray'];
    $username = $_SESSION['username'];
    $current_date = Date('Y-m-d');
    foreach ($invoiceArray as $invoice) {
        $result = mysqli_query($connection, "select application.application_feestatus from application where application_invoice_no='$invoice'");
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['application_feestatus'] == 'due') {
                $empty = "due";
                break;
            }
        }
    }
    if ($empty == "paid") {
        foreach ($invoiceArray as $invoice) {
            $query = "update application set application_sentConsulateDate='" . $current_date . "', application_sentConsulateBy='" . $username . "', application_deliveredDate=null,
        application_deliveredBy=null,
        application_receivedConsulateDate=null,
        application_receivedConsulateBy=null
        where application_invoice_no='" . $invoice . "'";
            mysqli_query($connection, $query);
            // echo $query;
        }
        echo "true";
    } else
        echo "false";
    /*    $invoiceArray = $_POST['invoiceArray'];
        $username=$_SESSION['username'];
        $current_date=Date('Y-m-d');
        foreach($invoiceArray as $invoice) {
            mysqli_query($connection,"update application set application_sentConsulateDate='".$current_date."', application_sentConsulateBy='".$username."', application_deliveredDate=null,
            application_deliveredBy=null,
            application_receivedConsulateDate=null,
            application_receivedConsulateBy=null
            where application_invoice_no='".$invoice."'");
            }
        echo "true";
    */
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'markdue') {
    $invoiceArray = $_POST['invoiceArray'];
    foreach ($invoiceArray as $invoice) {
        mysqli_query($connection, "update application set application_feestatus='due' where application_invoice_no=$invoice");
    }
    echo "true";
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'delete') {
    $delete = true;
    $invoiceArray = $_POST['invoiceArray'];
    foreach ($invoiceArray as $invoice) {
        $query = "select application_feestatus from application where application_invoice_no='$invoice'";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result))
            if ($row['application_feestatus'] == 'paid') {
                $delete = false;
                break;
            }
    }
    if ($delete == true) {
        foreach ($invoiceArray as $invoice) {
            mysqli_query($connection, "delete from application where application_invoice_no=$invoice");
            mysqli_query($connection, "delete from invoice where invoice_no=$invoice");
        }
        echo "true";
    } else
        echo "false";
}

if (isset($_POST['actionString']) && $_POST['actionString'] == 'recieveFromConsulate') {

    $invoiceArray = $_POST['invoiceArray'];
    $username = $_SESSION['username'];
    $current_date = Date('Y-m-d');
    $update = "true";
    foreach ($invoiceArray as $invoice) {
        $result = mysqli_query($connection, "select * from application where application_invoice_no='" . $invoice . "'");
        while ($row = mysqli_fetch_assoc($result)) {

            if ($row['application_receivedConsulateBy'] != "" && $row['application_receivedConsulateDate'] != "") {
                $update = "false";
                break;
            }
            if ($row['application_sentConsulateBy'] == "" && $row['application_sentConsulateDate'] == "") {
                $update = "false";
                break;
            }
        }
    }
    if ($update == "true") {
        foreach ($invoiceArray as $invoice) {
            mysqli_query($connection, "update application set application_receivedConsulateDate='" . $current_date . "', 
        application_deliveredDate=null,
        application_deliveredBy=null,
        application_receivedConsulateBy='" . $username . "'  where application_invoice_no='" . $invoice . "'");
        }
        echo "true";
    } else
        echo "false";
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'deliveredToCustomer') {
    $invoiceArray = $_POST['invoiceArray'];
    $username = $_SESSION['username'];
    $current_date = Date('Y-m-d');
    $update = "true";
    foreach ($invoiceArray as $invoice) {
        $result = mysqli_query($connection, "select * from application where application_invoice_no='" . $invoice . "'");
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['application_deliveredDate'] != "" && $row['application_deliveredBy'] != "") {
                $update = "false";
                break;
            }
            if ($row['application_receivedConsulateBy'] == "" && $row['application_receivedConsulateDate'] == "") {
                $update = "false";
                break;
            }
            if ($row['application_sentConsulateBy'] == "" && $row['application_sentConsulateDate'] == "") {
                $update = "false";
                break;
            }
        }
    }
    if ($update == "true") {
        foreach ($invoiceArray as $invoice) {

            mysqli_query($connection, "update application set application_deliveredDate='" . $current_date . "', application_deliveredBy='" . $username . "'  where application_invoice_no='" . $invoice . "'");
        }
        echo "true";
    } else
        echo "false";
}

if (isset($_POST['actionString']) && $_POST['actionString'] == 'approveRejectApplication') {
    $invoiceno = $_POST['invoiceno'];
    echo printApplicationApproveStatus($invoiceno);
}

if (isset($_POST['actionString']) && $_POST['actionString'] == 'approveApplication') {
    $invoice_no = $_POST['invoiceno'];
    $application_no = $_POST['application_no'];
    mysqli_query($connection, "update application set application_approvestatus='Approved' where
    application_no='" . $application_no . "'");
    echo printApplicationApproveStatus($invoice_no);
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'rejectApplication') {
    $invoice_no = $_POST['invoice_no'];
    $application_no = $_POST['application_no'];
    $query = "update application set application_approvestatus='Rejected' where
    application_no='" . $application_no . "'";
    mysqli_query($connection, $query);
    //  echo $query;
    echo printApplicationApproveStatus($invoice_no);
}
/*if(isset($_POST['actionString']) && $_POST['actionString']=='viewApplication')
{
    $invoiceno = $_POST['invoiceno'];
    echo printViewApplication($invoiceno);
}*/


if (isset($_POST['actionString']) && $_POST['actionString'] == 'InsertRejectReason') {
    $application_no = $_POST['application_no'];
    $remark = $_POST['remark'];
    $invoice_no = $_POST['invoiceno'];
    $query = "update application set remark='" . $remark . "' ,
       application_approvestatus='rejected' where application_no='" . $application_no . "'";
    if (mysqli_query($connection, $query))
        //echo $query;
        echo printApplicationApproveStatus($invoice_no);
}


if (isset($_POST['actionString']) && $_POST['actionString'] == 'updateApplicationReferenceNos') {
    $invoiceno = $_POST['invoiceno'];
    $output = '
      
    <table class="table table-hover">
        <tr style="background-color:#cccccc">
        <th>Application Reference no</th>
        <th>Applicant Passport no</th>
        <th>Applicant Name </th>
        <th>Approve/Reject Status</th>
        <th>Action</th>
        </tr>
    </table>';
    $result = mysqli_query($connection, "select application_referenceno,
        applicant_lastname,applicant_firstname,applicant_passportno,
        application_approvestatus from application 
        inner join applicant on application.application_applicant_id=applicant.applicant_id where application.application_invoice_no=$invoiceno");
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
    <form>
    <table class="table table-hover">
    <tr class="background"> 
    <td ><input type="text" class="form-control  newReferenceNo" name="newReferenceNo" value=' . $row['application_referenceno'] . '></td>
    <td>' . $row['applicant_firstname'] . '</td>
    <td>' . $row['applicant_passportno'] . '</td>
    <td>' . $row['application_approvestatus'] . '</td>
    <td><input type="button" class="btn btn-primary updateButton" id="' . $row['application_referenceno'] . '" value="update"></td>
    </tr>
    </table>
    </form>
   ';
    }
    echo $output;
}



function printViewApplication($invoiceno)
{
    global $connection;
    $output = '<table class="table table-hover">
        <tr style="background-color:#cccccc">
        <th>Application Reference no</th>
        <th>Applicant Passport no</th>
        <th>Applicant Name </th>
        <th>Approve/Reject Status</th>
        </tr>';
    $result = mysqli_query($connection, "select application_referenceno,
        applicant_firstname,applicant_lastname,applicant_passportno,
        application_approvestatus from application 
        inner join applicant on application.application_applicant_id=applicant.applicant_id where application.application_invoice_no=$invoiceno");
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
    <tr>
    <td>' . $row['application_referenceno'] . '</td>
    <td>' . $row['applicant_passportno'] . '</td>
    <td>' . $row['applicant_firstname'] . ' ' . $row['applicant_lastname'] . '</td>
    <td>' . $row['application_approvestatus'] . '</td>
    </tr>
   ';
    }
    $output .= "</table>";
    return $output;
}
/*
if(isset($_POST['actionString']) && $_POST['actionString']=='printSlipApplication')
{ 
     $invoiceno = $_POST['invoiceno'];
    echo printPrintSlipApplication($invoiceno);
}
function printPrintSlipApplication($invoiceno)
{
    global $connection;
     $output = '<table class="table table-hover">
        <tr style="background-color:#cccccc">
        <th>Application Reference no</th>
        <th>Applicant Passport no</th>
        <th>Applicant First Name </th>
        <th>Approve/Reject Status</th>
        <th>Action</th>
        </tr></table>';
        $result=mysqli_query($connection,"select application_referenceno,applicant_firstname,applicant_passportno,
        application_approvestatus from application 
        inner join applicant on application.application_applicant_id=applicant.applicant_id where application.application_invoice_no=$invoiceno");
    while($row=mysqli_fetch_assoc($result))
    {
    $output.='
    <form action="printSlip.php" method="post">
    <table class="table table-hover">
    <tr>
    <td>'.$row['application_referenceno'].'</td>
    <td>'.$row['applicant_firstname'].'</td>
    <td>'.$row['applicant_passportno'].'</td>
    <td>'.$row['application_approvestatus'].'</td>
    <td><input type="hidden" value='.$row['application_referenceno'].' name="application_referenceno" >
    <input type="submit" target="_blank" class="btn btn-primary printButton" name="printButton" value="Print"></td>
    </tr>
    </table>
    </form>
   ';
    }
    return $output;
}*/
function printApplicationApproveStatus($invoiceno)
{
    global $connection;
    $output = '<table class="table table-hover approverejecttable">
        <tr style="background-color:#cccccc">
        <th>Application Reference no</th>
        <th>Applicant Passport no</th>
        <th>Applicant Name </th>
        <th>Approve/Reject Status</th>
        <th>Approve</th>
        <th>Reject</th>
        <th>Remark</th>
        </tr>
      </table>
      ';
    $result = mysqli_query($connection, "select application.remark,application.application_no, application_referenceno,
        applicant_lastname,applicant_firstname,applicant_passportno,
        application_approvestatus from application 
        inner join applicant on application.application_applicant_id=applicant.applicant_id where application.application_invoice_no=$invoiceno");
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
    <form>
    <table class="table table-hover approverejecttable">
    <tr>
    <td>' . $row['application_referenceno'] . '</td>
    <td>' . $row['applicant_passportno'] . '</td>
    <td>' . $row['applicant_firstname'] . ' ' . $row['applicant_lastname'] . '</td>
    <td>' . $row['application_approvestatus'] . '</td>
    <td>
    <input type="hidden" value="' . $invoiceno . '" class="invoiceno">
    <input type="button" class="btn btn-primary approveButton" 
    value="Approve" id=' . $row['application_no'] . '></td>
    <td><input type="button" class="btn btn-primary rejectButton" id=' . $row['application_no'] . ' value="Reject"></td>
    <td><input value="' . $row['remark'] . '" type="text" class="input-control rejectreason"></td> 
    </tr>
    </table>
    </form>
   ';
    }
    //$output.="</table>";
    return $output;
}

// view
if (isset($_POST['actionString']) && $_POST['actionString'] == 'viewApplication') {
    $invoiceno = $_POST['invoiceno'];
    // $invoiceno=55555;
    $query = "SELECT invoice.*, point_of_contact.*
FROM invoice
    inner JOIN application ON application.application_Invoice_no = invoice.invoice_no
    inner JOIN point_of_contact ON application.application_poc_id = point_of_contact.poc_id
    where invoice.invoice_no=" . $invoiceno;
    $result = mysqli_query($connection, $query);
    $row1 = mysqli_fetch_assoc($result);
    $html = '
<table class="table tabel-stripped" cellpadding="1"  width="100%">
<tr>
<td>Invoice No :</td>
<td>' . $row1['invoice_no'] . '</td>
<td>Invoice Date:</td>
<td>' . $row1['invoice_date'] . '</td>
</tr>
<tr>
<td>Lead Pax</td>
<td>' . strtoupper($row1['poc_firstname']) . ' ' . strtoupper($row1['poc_lastname']) . '</td>
</tr>
<td colspan=4>Mobile1 : ' . $row1['poc_mobileno1'] . ', Mobile2: ' . $row1['poc_mobileno2'] . ', NID: ' . $row1['poc_nid'] . ', Email: ' . $row1['email'] . '</td>
</tr>
<table>
';
    $html .= '
<table cellspacing="0" cellpadding="1" border="1" width="100%">
<tr style="font-weight:bold">
<th width="20px">SI#</th>
<th align="center">Applicants Name</th>
<th align="center">Visa Type</th>
<th align="center">PassportType</th>
<th align="center">Type of Entry</th>
<th align="center">P.P</th>
<th align="center">Relation</th>
<th align="center" width="40px">US$</th>
<th align="center">Status</th>
<th align="center">Remarks</th>
<th align="center">Biometric</th>
</tr>';
    $query1 = 'SELECT invoice.*, application.*, applicant.*
FROM invoice
    inner JOIN application ON application.application_Invoice_no = invoice.invoice_no
    inner JOIN applicant ON application.application_applicant_id = applicant.applicant_id
where invoice.invoice_no=' . $invoiceno;

    $result = mysqli_query($connection, $query1);
    $i = 1;
    $sum1 = 0;
    $sum2 = 0;
    while ($row2 = mysqli_fetch_assoc($result)) {
        if ($row2['application_TVACcharges'] == '80')
            $service = "Business Launch Package Service Fee US$";
        else
            $service = "Package Service Fee US$";
        $sum1 += $row2['application_embassycharges'];
        $sum2 += $row2['application_TVACcharges'];
        $html .= '   
<tr>
<td align="center" width="20px">' . $i . '</td>
<td align="center">' . $row2['applicant_firstname'] . ' ' . $row2['applicant_lastname'] . '</td>
<td align="center">' . $row2['application_visaType'] . '</td>
<td align="center">' . $row2['applicant_passprotType'] . '</td>
<td align="center">' . $row2['application_entrytype'] . '</td>
<td align="center">' . $row2['applicant_passportno'] . '</td>
<td align="center">' . $row2['applicant_relation'] . '</td>
<td align="center">' . $row2['application_embassycharges'] . '</td>
<td align="center">' . $row2['application_approvestatus'] . '</td>
<td align="center">' . $row2['remark'] . '</td>';
        $query2 = "select * from biometric where biometric.applicant_id=" . $row2['applicant_id'];
        // echo $query2;
        $result2 = mysqli_query($connection, $query2);
        if (mysqli_num_rows($result2) != 0) {
            $row3 = mysqli_fetch_assoc($result2);
            if (!is_null($row3['leftlittle1']) && !is_null($row3['leftring2']) && !is_null($row3['leftmiddle3']) && !is_null($row3['leftindex4']) && !is_null($row3['leftfourprint5']) && !is_null($row3['rightindex6']) && !is_null($row3['rightlittle7']) && !is_null($row3['rightmiddle8']) && !is_null($row3['rightring9']) && !is_null($row3['rightfourprint10']) && !is_null($row3['leftthumb11']) && !is_null($row3['rightthumb12']) && !is_null($row3['thumbs13']) && !is_null($row3['face14']))
                $html .= '<td><button type="button"  value=' . $row2['applicant_passportno'] . ' class="btn btn-danger btn-sm  xmlButton">Biometric</td>';
            else
                $html .= '<td></td>';
        } else
            $html .= '<td></td>';
        $html .= '</tr>';
        $no = $row2['application_referenceno'];
        $user = $row2['application_enterby'];
        $i++;
    }

    $html .= '<tr>
<td colspan="7" align="right">Embassy Fee US$</td>
<td align="center">' . $sum1 . '</td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan="7" align="right">' . $service . '</td>
<td  align="center">' . $sum2 . '</td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan="7" align="right">Total US$</td>
<td  align="center">' . ($sum1 + $sum2) . '</td>
<td></td>
<td></td>
</tr>


<tr>
<td colspan=2>List of Original documents</td>
<td colspan=9>' . $row1['original_documents'] . '</td>
</tr>

<tr>
<td colspan=2>List of Original Relative documents</td>
<td colspan=9>' . $row1['related_documents'] . '</td>
</tr>

<tr>
<td colspan=2>List of Supportive documents</td>
<td colspan=9>' . $row1['supportive_documents'] . '</td>
</tr>
</table>
<table width="100%">
<tr>
<td  align="right" style="border:none">Prepared by : </td>
<td >' . $user . ' ' . date('Y/m/d') . ' ' . date('H:i:s') . '</td>
</tr>
<tr>
<td   style="border:none"><b>Reference Number : ' . $no . '</b> </td>
</tr>
</table>
';
    echo $html;
    //echo $query1;
}

?>
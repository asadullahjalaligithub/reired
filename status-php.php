<?php

session_start();
require ("Database.php");
$page = '';
$output = '';
if (isset($_POST['page'])) {
    $page = $_POST['page'];
} else
    $page = 1;

if (isset($_POST['actionString']) && $_POST['actionString'] != "default") {
    if (isset($_POST['actionString']) && $_POST['actionString'] == 'searchInvoiceNumber') {
        $invoice = $_POST['invoicenumber'];
        $whereclause = "invoice_no like '%" . $invoice . "%'";
    } else if (isset($_POST['actionString']) && $_POST['actionString'] == 'searchFirstname') {
        $firstname = $_POST['firstname'];
        strtoupper($firstname);
        $whereclause = "upper(poc_firstname) like '%" . $firstname . "%'";
    } else if (isset($_POST['actionString']) && $_POST['actionString'] == 'searchUser') {
        $user = $_POST['user'];
        $whereclause = "application_enterby='" . $user . "'";
    } else if (isset($_POST['actionString']) && $_POST['actionString'] == 'searchDate') {
        $date = $_POST['date'];
        $whereclause = "invoice_date='" . $date . "'";
    }
} else
    $whereclause = 1;

$start_from = ($page - 1) * $record_per_page;
$query = "select * from view1 where $whereclause order by invoice_no desc limit $start_from,$record_per_page ";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $totalcharges = 0;
        $q = "select application_TVACcharges, application_embassycharges from application
    where application_invoice_no=" . $row['invoice_no'];
        $r = mysqli_query($connection, $q);
        while ($w = mysqli_fetch_assoc($r)) {
            $totalcharges += $w["application_TVACcharges"] + $w['application_embassycharges'];
        }
        $textcolor = $row['application_feestatus'] == 'due' ? 'red' : 'green';
        //$display=$row['application_feestatus']=='due'?'true':'false';
        //   if(!is_null($row['deliveredby']) || $row['deliveredby']!="")
        if ($row['deliveredby'] != "")
            $status = "Delivered To Customer";
        //else if(!is_null($row['recievedby']) || $row['recievedby']!="")
        else if ($row['recievedby'] != "")
            $status = "Recieved from Consulate";
        else if ($row['sentby'] != "")
            //else if(!is_null($row['sentby']) || $row['sentby']!="")
            $status = "Sent to Consulate";
        else
            $status = "pending";
        $output .= '
    <tr>
    <td><input type="checkbox" class="checkboxes" id=' . $row["invoice_no"] . '></td><td>' . $row["invoice_no"] . '</td>
    <td class="a">' . $row["invoice_date"] . '</td>
    <td>' . $row["poc_firstname"] . ' ' . $row["poc_lastname"] . '</td>
    <td>' . $row["application_enterby"] . '</td>
    <td class="status">' . $status . '</td>
    <td>' . $totalcharges . '</td>
    <td style="color:' . $textcolor . '">' . $row["application_feestatus"] . '</td>
    <td class="action-buttons">
    ';
        if ($row['deliveredby'] != "" && $_SESSION['role'] != 'finance') {
            $output .= '<form method="post" action="deliverbarcode.php" target="_blank"
     style="margin-bottom:-20px;">
     <input type="submit"
    class="btn btn-success printSlip" value="Print Delivery Sheet">
    <input type="hidden" name="invoice" value="' . $row['invoice_no'] . '"></form><br>';
        }
        if ($row['recievedby'] != "") {
            if ($_SESSION['role'] == 'admin') {
                $output .= '<button class="btn btn-warning approveRejectButton" value=' . $row['invoice_no'] . '>Approved/Reject</button><br>';
            }
        }
        if ($_SESSION['role'] != 'finance') {
            $output .= '<form method="post" action="updateApplication.php" style="margin-bottom:-20px;">
     <input type="hidden" value=' . $row['invoice_no'] . ' name="invoiceno">
     <input type="submit" class="btn btn-info updateReferenceNo" value="Update">
     </form>
     <br>';
        }
        if ($row['application_feestatus'] == 'paid') {
            $output .= '
     <form method="post" action="invoicebarcode.php" target="_blank"
     style="margin-bottom:-20px;">
     <input type="submit"
    class="btn btn-success printSlip" value="Print Invoice">
    <input type="hidden" name="invoice" value="' . $row['invoice_no'] . '"></form><br>';
        }
        if ($row['application_feestatus'] == 'paid' && $_SESSION['role'] != 'user') {
            $output .= '
    <form method="post" action="recieptbarcode.php" target="_blank"
     style="margin-bottom:-20px;">
     <input type="submit"
    class="btn btn-success printSlip" value="Print Reciept">
    <input type="hidden" name="invoice" value="' . $row['invoice_no'] . '"></form><br>';
        }

        $output .= '<button  class="btn btn-primary viewButton" value=' . $row['invoice_no'] . '>view</button></td>
    </tr>
    ';
    }

    /*
    $<p>You can use the mark tag to <mark>highlight</mark> text.</p>
    age_query = "select * from view1";
    $page_result=mysqli_query($connection,$page_query);
    $total_records=mysqli_num_rows($page_result);
    $total_pages=ceil($total_records/$record_per_page);
    for($i=1;$i<=$total_pages;$i++)
    {
        $output.="<li class='page_item'><span class='pagination_link page-link'  id='".$i."'>".$i."</span></li>";
    }
    $output.="</ul></nav></td></tr>";
    */
    echo $output;
} else
    echo 'false';

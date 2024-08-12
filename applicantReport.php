<?php
$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require ($documentroot . "login-authentication.php");
require ($documentroot . "Database.php");
date_default_timezone_set('Asia/Kabul');
if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'view' || $_SESSION['role'] == 'finance') {
    header('location:index.php?logout=true');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-size: 13px;
        }

        table tr td {
            text-align: center;
            border: solid 1px black;
        }

        tr.header {
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: gray;
            border: solid 1px white;
        }

        table tr th {
            width: 150px;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_GET['s']) && isset($_GET['e'])) {
        $s = $_GET['s'];
        $e = $_GET['e'];





        $query = "select * from invoice where invoice_date>='" . $s . "' and invoice_date<='" . $e . "'";
        $invoice_result = mysqli_query($connection, $query);
        $html = "<table>
        <tr class='header'>
        <th>Name</th>
        <th>SureName</th>
        <th>Passport No</th>
        <th>Invoice No</th>
        <th>Invoice Date</th>
        <th>Visa Type</th>
        <th>Number of Applications</th>
        <th class='reference_number'>Reference Number</th>
        <th>Phone1</th>
        <th>Phone2</th>
        </tr>";
        while ($invoice_row = mysqli_fetch_assoc($invoice_result)) {
            $query = "select count(application_no) as count,point_of_contact.* from application inner join point_of_contact on point_of_contact.poc_id = application.application_poc_id where application_Invoice_no=" . $invoice_row['invoice_no'];
            $result1 = mysqli_query($connection, $query);
            $row1 = mysqli_fetch_assoc($result1);
            $query = "select * from applicant inner join application on application.application_applicant_id=applicant.applicant_id where application.application_Invoice_no=" . $invoice_row['invoice_no'];
            $result2 = mysqli_query($connection, $query);
            $poc = true;
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $html .= "<tr>
            <td>" . $row2['applicant_firstname'] . "</td>
            <td>" . $row2['applicant_lastname'] . "</td>
            <td>" . $row2['applicant_passportno'] . "</td>";
                if ($poc)
                    $html .= "<td>" . $row2['application_Invoice_no'] . "</td>";
                else
                    $html .= "<td>" . $row2['applicant_relation'] . "</td>";
                $html .= "<td>" . $invoice_row['invoice_date'] . "</td>
            <td>" . $row2['application_visaType'] . "</td>";
                if ($poc)
                    $html .= "<td>" . $row1['count'] . "</td>";
                else
                    $html .= "<td></td>";
                $html .= "<td>" . $row2['application_referenceno'] . "</td>";
                if ($poc)
                    $html .= "<td>" . $row1['poc_mobileno1'] . "</td>";
                else
                    $html .= "<td></td>";
                if ($poc)
                    $html .= "<td>" . $row1['poc_mobileno2'] . "</td>";
                else
                    $html .= "<td></td>";
                $poc = false;
            }

        }


        header('Content-Type: application/xls');
        header('Content-Disposition:attachment; filename=report.xls');
        echo $html;
    }
    ?>
</body>

</html>
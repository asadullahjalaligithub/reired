<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
session_start();
require ($documentroot . 'Database.php');
if (isset($_POST['actionString']) && $_POST['actionString'] == 'checkInvoice') {
    $invoiceno = $_POST['invoiceno'];
    $result = mysqli_query($connection, "select * from invoice where invoice_no='$invoiceno'");
    if (mysqli_num_rows($result) != 0) {
        $query2 = "select * from view2 where invoice_no='$invoiceno'";
        $result2 = mysqli_query($connection, $query2);
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $totalcharges = $row2["application_TVACcharges"] + $row2['application_embassycharges'];
            $textcolor = $row2['application_feestatus'] == 'due' ? 'red' : 'green';
            //$display=$row2['application_feestatus']=='due'?'true':'false';
            if ($row2['deliveredby'] != "")
                $status = "Delivered To Customer";
            //else if(!is_null($row['recievedby']) || $row['recievedby']!="")
            else if ($row2['recievedby'] != "")
                $status = "Recieved from Consulate";
            else if ($row2['sentby'] != "")
                //else if(!is_null($row['sentby']) || $row['sentby']!="")
                $status = "Sent to Consulate";
            else
                $status = "pending";
            $output = '
    <tr>
    <td>' . $row2["invoice_no"] . '</td>
    <td class="a">' . $row2["invoice_date"] . '</td>
    <td>' . $row2["poc_firstname"] . ' ' . $row2["poc_lastname"] . '</td>
    <td>' . $row2["application_enterby"] . '</td>
    <td class="status">' . $status . '</td>
    <td>' . $totalcharges . '.00</td>
    <td style="color:' . $textcolor . '">' . $row2["application_feestatus"] . '</td>
    </tr>';
        }
        echo $output;
    } else
        echo "false";
}



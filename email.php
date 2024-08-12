<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require ($documentroot . "Database.php");
session_start();
if (isset($_POST['actionString']) && $_POST['actionString'] == 'sendToConsulateEmail') {
    $invoiceArray = $_POST['invoiceArray'];
    foreach ($invoiceArray as $invoiceNo) {
        $query = "select point_of_contact.email from point_of_contact 
        inner join application on application.application_poc_id=point_of_contact.poc_id
        inner join invoice on invoice.invoice_no=application.application_Invoice_no
        where invoice.invoice_no=$invoiceNo";
        $result = mysqli_query($connection, $query);
        $email = mysqli_fetch_array($result);
        // echo $phone[0];
        if (validateEmail($email[0])) {
            sendToConsulateEmail($email[0]);
        } else {
            echo "Invalid Email address";
        }
    }
} else if (isset($_POST['actionString']) && $_POST['actionString'] == 'receiveFromConsulateEmail') {
    $invoiceArray = $_POST['invoiceArray'];
    foreach ($invoiceArray as $invoiceNo) {
        $query = "select point_of_contact.email from point_of_contact 
            inner join application on application.application_poc_id=point_of_contact.poc_id
            inner join invoice on invoice.invoice_no=application.application_Invoice_no
            where invoice.invoice_no=$invoiceNo";
        $result = mysqli_query($connection, $query);
        $email = mysqli_fetch_array($result);
        // echo $phone[0];

        if (validateEmail($email[0])) {
            receiveFromConsulateEmail($email[0]);
        } else {
            echo "Invalid Email address";
        }
    }
} else if (isset($_POST['actionString']) && $_POST['actionString'] == "markPaidEmail") {
    $invoiceArray = $_POST['invoiceArray'];
    foreach ($invoiceArray as $invoiceNo) {
        $query = "select point_of_contact.email from point_of_contact 
            inner join application on application.application_poc_id=point_of_contact.poc_id
            inner join invoice on invoice.invoice_no=application.application_Invoice_no
            where invoice.invoice_no=$invoiceNo";
        $result = mysqli_query($connection, $query);
        $email = mysqli_fetch_array($result);
        // echo $phone[0];

        if (validateEmail($email[0])) {
            markPaidEmail($email[0]);
        } else {
            echo "Invalid Email address";
        }
    }
} else if (isset($_POST['actionString']) && $_POST['actionString'] == "deliverToCustomerEmail") {
    $invoiceArray = $_POST['invoiceArray'];
    foreach ($invoiceArray as $invoiceNo) {
        $query = "select point_of_contact.email from point_of_contact 
            inner join application on application.application_poc_id=point_of_contact.poc_id
            inner join invoice on invoice.invoice_no=application.application_Invoice_no
            where invoice.invoice_no=$invoiceNo";
        $result = mysqli_query($connection, $query);
        $email = mysqli_fetch_array($result);
        // echo $phone[0];

        if (validateEmail($email[0])) {
            deliverToCustomerEmail($email[0]);
        } else {
            echo "Invalid Email address";
        }
    }
}
function markPaidEmail($email)
{
    $email_address = $email;
    $email_body =
        "Dear Mr/Mrs
        
        Your application has been submitted to Reired Tourism.
         
        Regards 
        Reired Team";
    // $email_address=filter_email_header($email_address);
    // $email_body=filter_email_header($email_body);
    $header = "From: REIRED";
    $sent = mail($email_address, "REIRED", $email_body, $header);
    if ($sent)
        echo "True";
    else
        echo "False";
}
function receiveFromConsulateEmail($email)
{
    $email_address = $email;
    $email_body =
        "Dear Mr/Mrs
        
        Your application has been received from Turkish embassy consulate section.
         
        Regards 
        Reired Team";
    // $email_address=filter_email_header($email_address);
    // $email_body=filter_email_header($email_body);
    $header = "From: REIRED";
    $sent = mail($email_address, "REIRED", $email_body, $header);
    if ($sent)
        echo "True";
    else
        echo "False";
}
function sendToConsulateEmail($email)
{
    $email_address = $email;
    $email_body =
        "Dear Mr/Mrs
    
    Your application has been sent to Turkish embassy consulate section.
     
    Regards 
    Reired Team";
    // $email_address=filter_email_header($email_address);
    // $email_body=filter_email_header($email_body);
    $header = "From: REIRED";
    $sent = mail($email_address, "REIRED", $email_body, $header);
    if ($sent)
        echo "True";
    else
        echo "False";
}
function deliverToCustomerEmail($email)
{
    $email_address = $email;
    $email_body =
        "Dear Mr/Mrs
    
    Your application has been delivered to you.
     
    Regards 
    Reired Team";
    // $email_address=filter_email_header($email_address);
    // $email_body=filter_email_header($email_body);
    $header = "From: REIRED";
    $sent = mail($email_address, "REIRED", $email_body, $header);
    if ($sent)
        echo "True";
    else
        echo "False";
}

function validateEmail($email)
{
    if ($email != "")
        return true;
    else
        return false;

}

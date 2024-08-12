<?php

require('Database.php');
session_start();
function newId($query)
{
    global $connection;
    $result= mysqli_query($connection,$query);
    $row = mysqli_fetch_array($result);
    return $row[0];
}
if(isset($_POST['actionString']) && $_POST['actionString']=='addApplication')
{
//    $applicationreferenceno=$_POST['applicationreferenceno'];
    $tvaccharges=$_POST['tvaccharges'];
    $embassycharges=$_POST['embassycharges'];
    $visatype=$_POST['visatype'];
    $entrytype=$_POST['entrytype'];
    $applicantid=$_POST['applicantid'];
    $pocid=$_POST['pocid'];
  //  $applicationid=$_POST['application_no'];
    $currentDate=date('Y/m/d');
    $currentTime=date('H:i:s');
    $username=$_SESSION['username'];
    $invoiceno = $_POST['invoiceno'];
 //   $applicationid=$_POST['application_no'];
    
  //  $invoiceusage=$_POST['invoiceusage'];
    $applicationid = newID("select max(application_no)+1 from application");
  //  if($invoiceusage=="false")
   // {
   //     $invoiceno = checkInvoiceNumber();
  //  }
    $query = "insert into application (application_no,  application_visaType,  application_date,
    application_TVACcharges,  application_embassycharges,  application_entrydate,  application_enterby,
    application_applicant_id  ,application_poc_id,
    application_entrytype,
    time,application_invoice_no) values('$applicationid','$visatype','$currentDate',
    '$tvaccharges','$embassycharges','$currentDate','$username','$applicantid','$pocid',
    '$entrytype','$currentTime','$invoiceno')";  
   // echo $query;
  if(mysqli_query($connection,$query))
    //  $return_array [] =array("invoiceno"=>$invoiceno);
       echo "true";
       else 
    //    $return_array[]=array("invoiceno"=>"duplicate");
    echo "false";
           //echo json_encode($return_array);
}


if(isset($_POST['actionString']) && $_POST['actionString']=='insertApplicationData')
{
//    $applicationreferenceno=$_POST['applicationreferenceno'];
    $tvaccharges=$_POST['tvaccharges'];
    $embassycharges=$_POST['embassycharges'];
    $visatype=$_POST['visatype'];
    $entrytype=$_POST['entrytype'];
    $applicantid=$_POST['applicantid'];
    $pocid=$_POST['pocid'];
    $applicationid=$_POST['application_no'];
    $currentDate=date('Y/m/d');
    $currentTime=date('H:i:s');
    $username=$_SESSION['username'];
    $invoiceno = $_POST['invoiceno'];
    $applicationid=$_POST['application_no'];
    
  //  $invoiceusage=$_POST['invoiceusage'];
  //  $applicationtid = newID("select max(application_no)+1 from application");
  //  if($invoiceusage=="false")
   // {
   //     $invoiceno = checkInvoiceNumber();
  //  }
    $query = "update application   set application_visaType='".$visatype."',
     application_TVACcharges='".$tvaccharges."',
     application_embassycharges='".$embassycharges."',
     application_applicant_id='".$applicantid."', 
     application_poc_id='".$pocid."',
     application_entrytype = '".$entrytype."'
     where application_no='".$applicationid."'";
   // echo $query;
  if(mysqli_query($connection,$query))
    //  $return_array [] =array("invoiceno"=>$invoiceno);
       echo "true";
       else 
    //    $return_array[]=array("invoiceno"=>"duplicate");
    echo "false";
           //echo json_encode($return_array);
}


if(isset($_POST['actionString']) && $_POST['actionString']=='updateApplicationCharges')
{
    $applicationno=$_POST['aplicationno'];
    $tvaccharges=$_POST['tvaccharges'];
    $embassycharges=$_POST['embassycharges'];
    $visatype=$_POST['visatype'];
    $entrytype=$_POST['entrytype'];
    $query="update application set application_TVACcharges='$tvaccharges',
    application_embassycharges='$embassycharges',
    application_visaType='$visatype',
    application_entrytype='$entrytype' where application_no='".$applicationno."'";
 //  echo $query;
    if(mysqli_query($connection,$query))
        echo "true";
    else
        echo "false";
}
if(isset($_POST['actionString']) && $_POST['actionString']=='updateApplicationsReferenceno')
{
    $invoice=$_POST['invoiceno'];
    $referenceno=$_POST['applicationreferenceno'];
    $odocuments=$_POST['odocuments'];
    $rdocuments=$_POST['rdocuments'];
    $sdocuments=$_POST['sdocuments'];
    $query = "update application set application_referenceno='".$referenceno."' where application_invoice_no=".$invoice;
 //  echo $query;
    if(mysqli_query($connection,$query))
    {
        $query="update invoice set original_documents='".$odocuments."',
        related_documents='".$rdocuments."',
        supportive_documents='".$sdocuments."' where invoice_no=".$invoice;
        if(mysqli_query($connection,$query))
        {
            echo "true";
            exit();
        }
        else 
            echo "false";
    }
    else
        echo "false";

}

?>
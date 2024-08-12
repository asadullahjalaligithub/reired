<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/Database.php";

if (isset($_POST['actionString']) && $_POST['actionString'] == 'loadProvince') {
    $key = $_POST['selectedvalue'];
    $query = "select province_id,province_name from province where zone_id='$key'";
    $result = mysqli_query($connection, $query);
    $return_array = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $province_id = $row['province_id'];
            $province_name = $row['province_name'];
            $return_array[] = array("province_id" => $province_id, "province_name" => $province_name);
        }
        echo json_encode($return_array);
        exit();
    } else {
        echo "false";
    }

}

if (isset($_POST['actionString']) && $_POST['actionString'] == 'searchpassportnumber') {
    $key = $_POST['key'];
    $query = "select * from applicant where applicant_passportno='$key'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $firstname = $row['applicant_firstname'];
        $lastname = $row['applicant_lastname'];
        $mobileno = $row['applicant_mobileno'];
        $dob = $row['applicant_dob'];
        $gender = $row['applicant_gender'];
        $applicantid = $row['applicant_id'];
        $relation = $row['applicant_relation'];
        $occupation = $row['applicant_occupation'];
        $passportType = $row['applicant_passprotType'];
        $passportno = $row['applicant_passportno'];
        $provinceid = $row['province_id'];
        $zone = getZone($provinceid);
        $provincename = getProvinceName($provinceid);
        $fathername = $row['fathername'];
        $mothername = $row['mothername'];
        $return_array[] = array("gender" => $gender, "applicantid" => $applicantid, "zone" => $zone, "province_id" => $provinceid, "province_name" => $provincename, "firstname" => $firstname, "lastname" => $lastname, "mobileno" => $mobileno, "dob" => $dob, "relation" => $relation, "passportType" => $passportType, "occupation" => $occupation, "passportno" => $passportno, "fathername" => $fathername, "mothername" => $mothername);
        echo json_encode($return_array);
        exit();
    } else
        echo 'false';
}
function getProvinceName($provinceid)
{
    global $connection;
    $result = mysqli_query($connection, "select province_name from province where province_id='$provinceid'");
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['province_name'];
    }
}
function getZone($provinceid)
{
    global $connection;
    $result = mysqli_query($connection, "select zone_id from province where province_id='$provinceid'");
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['zone_id'];
    }
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'searchnid') {
    $key = $_POST['key'];
    $query = "select * from point_of_contact where poc_nid='$key'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $firstname = $row['poc_firstname'];
        $lastname = $row['poc_lastname'];
        $phone1 = $row['poc_mobileno1'];
        $phone2 = $row['poc_mobileno2'];
        $nid = $row['poc_nid'];
        $pocid = $row['poc_id'];
        $email = $row['email'];
        $return_array[] = array(
            "email" => $email,
            "pocid" => $pocid,
            "firstname" => $firstname,
            "secondname" => $lastname,
            "phone1" => $phone1,
            "phone2" => $phone2,
            "nid" => $nid
        );
        echo json_encode($return_array);
        exit();
    } else
        echo 'false';
}

/*  if(isset($_POST['actionString']) && $_POST['actionString']=='deleteInvoiceno')
 {
      $invoiceno=$_POST['invoiceno'];
      if(mysqli_query($connection,"delete from invoice where invoice_no='$invoiceno'"))
      echo "true";
      else
          echo "false";
  }*/
/*if(isset($_POST['actionString']) && $_POST['actionString']=='generateInvoiceNumber')
   {

 $result= mysqli_query($connection,"select max(invoice_no)+1 from invoice");
if(mysqli_num_rows($result)!=0){
       $row = mysqli_fetch_array($result);
            $return_array [] =array("invoiceno"=>$row[0]);
            echo json_encode($return_array);
    }
         else
           echo "false";
   }
   */
/*  if(isset($_POST['actionString']) && $_POST['actionString']=='insertInvoiceNumber')
  {
      $currentDate=date('Y/m/d');
       $result= mysqli_query($connection,"select max(invoice_no)+1 from invoice");
   if(mysqli_num_rows($result)!=0){
      $row = mysqli_fetch_array($result);
       if(mysqli_query($connection,"insert into invoice (invoice_no,invoice_date) values
       ('$row[0]','$currentDate')"))
       {   
           $return_array [] =array("invoiceno"=>$row[0]);
           echo json_encode($return_array);
       }
        else
          echo "false";
   }
      else
         echo "false";
  }*/
function newId($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    return $row[0];
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'insertPOC') {
    $firstname = $_POST['firstname'];
    $secondname = $_POST['secondname'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $nid = $_POST['nid'];
    $email = $_POST['email'];
    $nextid = newId("SELECT coalesce(max(poc_id)+1,1) from point_of_contact");
    $currentDate = date('Y/m/d');
    $query = "INSERT into point_of_contact 
    (poc_id,poc_firstname,poc_lastname,poc_mobileno1,poc_mobileno2,poc_nid,poc_dataEntryDate,email)
    values('$nextid','$firstname','$secondname','$phone1','$phone2','$nid','$currentDate','$email')";
    if (mysqli_query($connection, $query))
        $message = "true";
    else
        $message = "false";
    echo $message;
}


if (isset($_POST['actionString']) && $_POST['actionString'] == 'updateDataApplicant') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $passportno = $_POST['passportno'];
    $zone = $_POST['zone'];
    $province = $_POST['province'];
    $dob = $_POST['dob'];
    $passporttype = $_POST['passporttype'];
    $occupation = $_POST['occupation'];
    $relation = $_POST['relation'];
    $gender = $_POST['gender'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $query = "UPDATE applicant set 
    applicant_firstname='$firstname',
    applicant_lastname='$lastname',
    applicant_mobileno='$phone',
    applicant_gender='$gender',
    applicant_dob='$dob',
    applicant_relation='$relation',
    applicant_occupation='$occupation',
    applicant_passprotType='$passporttype',
    fathername='$fathername',
    mothername='$mothername',
    province_id='$province' where applicant_passportno='$passportno'";
    if (mysqli_query($connection, $query))
        echo "true";
    else
        echo "false";
}

if (isset($_POST['actionString']) && $_POST['actionString'] == 'insertDocuments') {
    $invoiceno = $_POST['invoiceno'];
    $odocuments = $_POST['odocuments'];
    $rdocuments = $_POST['rdocuments'];
    $sdocuments = $_POST['sdocuments'];
    $query = " UPDATE invoice set original_documents='$odocuments',
    related_documents='$rdocuments',
    supportive_documents='$sdocuments'
    where invoice_no='$invoiceno'";
    if (mysqli_query($connection, $query))
        echo 'true';
    else
        echo 'false';
}
function getInvoiceNumber($parameter)
{
    global $connection;
    /*   $query ="select * from invoice where invoice_no='$invoice'";
       $currentDate=date('Y/m/d');
       $result=mysqli_query($connection,$query);
       if(mysqli_num_rows($result)!=0)
       {
           return $invoice;
       }
       else {
           $query ="insert into invoice (invoice_no,invoice_date) values ('$invoice','$currentDate')";
           if(mysqli_query($connection,$query))
               return $invoice;
       }*/
    $currentDate = date('Y/m/d');
    $currentTime = date('H:i:s');
    $query = "SELECT coalesce(max(invoice_no)+1,1) from invoice";
    $user = $_SESSION['username'];
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_array($result);
        if ($user != '' && $parameter != '') {
            $query = "INSERT into invoice (invoice_no,invoice_date
,invoice_time,user,reason) values
        ('$row[0]','$currentDate','$currentTime','$user','$parameter')";
            //echo $query;
            if (mysqli_query($connection, $query))
                return $row[0];
        }
        return "false";
    }
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'insertApplicationDataInvoice') {
    //    $applicationreferenceno=$_POST['applicationreferenceno'];
    $tvaccharges = $_POST['tvaccharges'];
    $embassycharges = $_POST['embassycharges'];
    $visatype = $_POST['visatype'];
    $entrytype = $_POST['entrytype'];
    $applicantid = $_POST['applicantid'];
    $pocid = $_POST['pocid'];
    $applicationid = newID("SELECT coalesce(max(application_no)+1,1) from application");
    $currentDate = date('Y/m/d');
    $currentTime = date('H:i:s');
    $username = $_SESSION['username'];
    $invoiceno = $_POST['invoiceno'];
    //  $invoiceusage=$_POST['invoiceusage'];
    // $applicationid = newID("SELECT coalesce(max(application_no)+1,1) from application");
    //  if($invoiceusage=="false")
    //   {
    //  $invoiceno = getInvoiceNumber();
    //}
    $query = "INSERT into application (application_no,  application_visaType,  application_date,
    application_TVACcharges,  application_embassycharges,  application_entrydate,  application_enterby,
    application_applicant_id  ,application_poc_id,
    application_entrytype,
    time,application_invoice_no) values('$applicationid','$visatype','$currentDate',
    '$tvaccharges','$embassycharges','$currentDate','$username','$applicantid','$pocid',
    '$entrytype','$currentTime','$invoiceno')";
    //echo $query;
    if (mysqli_query($connection, $query))
        // $return_array [] =array("invoiceno"=>$invoiceno);
        echo "true";
    else
        echo "false";
    //    $return_array[]=array("invoiceno"=>"duplicate");
    //  echo json_encode($return_array);
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'insertApplicationData') {
    //    $applicationreferenceno=$_POST['applicationreferenceno'];
    $tvaccharges = $_POST['tvaccharges'];
    $embassycharges = $_POST['embassycharges'];
    $visatype = $_POST['visatype'];
    $entrytype = $_POST['entrytype'];
    $applicantid = $_POST['applicantid'];
    $pocid = $_POST['pocid'];
    $applicationid = newID("SELECT coalesce(max(application_no)+1,1) from application");
    $currentDate = date('Y/m/d');
    $currentTime = date('H:i:s');
    $parameter = $_POST['parameter'];
    $username = $_SESSION['username'];
    //  $invoiceno = $_POST['invoiceno'];
    //  $invoiceusage=$_POST['invoiceusage'];
    // $applicationid = newID("select max(application_no)+1 from application");
    //  if($invoiceusage=="false")
    //   {
    $invoiceno = getInvoiceNumber($parameter);
    //}
    $query = "INSERT into application (application_no,  application_visaType,  application_date,
    application_TVACcharges,  application_embassycharges,  application_entrydate,  application_enterby,
    application_applicant_id  ,application_poc_id,
    application_entrytype,
    time,application_invoice_no) values('$applicationid','$visatype','$currentDate',
    '$tvaccharges','$embassycharges','$currentDate','$username','$applicantid','$pocid',
    '$entrytype','$currentTime','$invoiceno')";
    //echo $query;
    if (mysqli_query($connection, $query))
        $return_array[] = array("invoiceno" => $invoiceno);
    else
        $return_array[] = array("invoiceno" => "duplicate");
    echo json_encode($return_array);
    exit();
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'insertApplicantData') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $passportno = $_POST['passportno'];
    $zone = $_POST['zone'];
    $province = $_POST['province'];
    $dob = $_POST['dob'];
    $passporttype = $_POST['passporttype'];
    $occupation = $_POST['occupation'];
    $relation = $_POST['relation'];
    $gender = $_POST['gender'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $applicantid = newID("SELECT coalesce(max(applicant_id)+1,1) from applicant");
    $query = "insert into applicant (applicant_id,applicant_firstname,applicant_lastname,applicant_mobileno,applicant_gender,applicant_dob,applicant_relation,applicant_occupation,applicant_passportno,applicant_passprotType,province_id, fathername,mothername) values ('$applicantid','$firstname','$lastname','$phone','$gender','$dob','$relation','$occupation','$passportno','$passporttype','$province','$fathername','$mothername')";
    //echo $query;
    if (mysqli_query($connection, $query))
        echo "true";
    else
        echo "false";
}
if (isset($_POST['actionString']) && $_POST['actionString'] == 'updatePOC') {
    $firstname = $_POST['firstname'];
    $secondname = $_POST['secondname'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $nid = $_POST['nid'];
    $email = $_POST['email'];
    $query = "UPDATE point_of_contact 
   set poc_firstname='$firstname',
   poc_lastname='$secondname',
   poc_mobileno1='$phone1', email='$email',
   poc_mobileno2='$phone2' where 
   poc_nid='$nid'
  ";
    if (mysqli_query($connection, $query))
        echo "true";
    else
        echo "false";
}


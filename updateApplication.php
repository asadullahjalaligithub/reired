<?php require("login-authentication.php");
   require('Database.php');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require("header-links.php"); ?>
    <style>
    h4 {
        color: red;
    }

    .error {
        border-color: red;
    }

    .inputError {
        border: solid 1px red;
    }
    </style>
    <script>


    </script>
</head>

<body>
    <div class="container-fluid">

        <?php require("header.php"); ?>
        <!-- left menus -->

        <div class="row">
            <?php require("left-menus.php");?>
            <!-- right contents -->
            <div class="col-lg-10 col-md-9 col-sm-8 second-column">
                <?php 
                if(isset($_POST['application_no']) && isset($_POST['invoiceno']))
                {
        $query1="select application.* from application where application_invoice_no=".$_POST['invoiceno'];
                $result1=mysqli_query($connection,$query1);
                if(mysqli_num_rows($result1)>1)
                    {
                $query ="delete from application where application_no=".$_POST['application_no'];    
                    mysqli_query($connection,$query);
                }
                }
                ?>
                <!--
                <?php /* if(isset($_POST['invoiceno'])) {
            $invoiceno=$_POST['invoiceno'];
    $query="select invoice.*, application.application_referenceno,
    application.application_feestatus from invoice inner join application on
    application.application_invoice_no=invoice.invoice_no where invoice.invoice_no=".$invoiceno;
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
            ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Invoice : <?php echo $invoiceno ?></h4>
                    </div>
                    <form>
                        <input type="hidden" value="<?php echo $invoiceno ?>" name="invoiceno">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" name="applicationreferenceno" value="<?php echo $row['application_referenceno']; ?>" placeholder="ApplicationReferenceNO"> </div>
                                    <div class="form-group col-lg-8"> <input type="text" class="form-control" name="odocuments" value="<?php echo $row['original_documents']; ?>" placeholder="Original Documents"> </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4"> <input type="text" class="form-control" name="rdocuments" value="<?php echo $row['related_documents']; ?>" placeholder="Related Documents"> </div>
                                    <div class="form-group col-lg-4"> <input type="text" class="form-control" name="sdocuments" value="<?php echo $row['supportive_documents']; ?>" placeholder="Supportive Documents"> </div>
                                    <div class="form-group col-lg-2" style="text-align: left;">
                                        <input class="btn btn-primary" name="saveapplication" type="button" value="Update" onclick="updateReferenceDocument(this.form)">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
                <?php 
    if($row['application_feestatus']!='paid')
    {
    $query="SELECT applicant.applicant_firstname, application.application_no, invoice.*
FROM invoice
    inner JOIN application ON application.application_Invoice_no = invoice.invoice_no
    inner JOIN applicant ON application.application_applicant_id = applicant.applicant_id where invoice.invoice_no=".$invoiceno;
    $result=mysqli_query($connection,$query);
    $count=mysqli_num_rows($result);
    while($row=mysqli_fetch_assoc($result))
    {
                ?>
                <div class="card">

                    <form>
                        <input type="hidden" name="applicationno" value="<?php echo $row['application_no'];?>" name="applicationid">
                        <div class="card-header">
                            <h4 align="center">Applicant Name : <?php echo  $row['applicant_firstname']; ?></h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="form-group col-lg-3"> <label for="embassy">Embassy Charges</label> <select class="form-control" id="embassy" name="embassycharges">
                                                <option value="60">60</option>
                                                <option value="200">120</option>
                                                <option value="0">200</option>>
                                                <option value="0">190</option>>
                                                <option value="0">0</option>>
                                            </select> </div>
                                        <div class="form-group col-lg-3"> <label for="tvac">TVAC Charges</label> <select class="form-control" id="tvac" name="tvaccharges">
                                                <option value="30">30</option>
                                                <option value="50">50</option>
                                                <option value="0">0</option>
                                            </select> </div>
                                        <div class="form-group col-lg-3"> <label for="type">Visa Type</label> <select class="form-control" id="type" name="visatype">
                                                <option value="Tourstic">Touristic</option>
                                                <option value="Business">Business</option>
                                                <option value="Student / Education">Student / Education</option>
                                                <option value="Medical / Treatment">Medical / Treatment</option>
                                                <option value="Work">Work</option>
                                                <option value="Transit">Transit</option>
                                                <option value="Conference / Seminar">Conference / Semeinar</option>
                                                <option value="Training">Training</option>
                                                <option value="Official Medical">Official Medical</option>
                                                <option value="Turky ScholarShip Student">Turky Scholarship Student</option>
                                                <option value="Some Special Meetings / Visit">Some Special Meetings / Visit</option>
												<option value="Festival/Fare/Exhibition Visa">Festival/Fare/Exhibition Visa</option>
                                                <option value="Other Scholarship Situation">Other Scholarship Situation</option>
                                            </select> </div>
                                        <div class="form-group col-lg-3"> <label for="entrytype">Entry Type</label> <select class="form-control" id="entrytype" name="entrytype">
                                                <option value="Single Entry"> Single Entry</option>
                                                <option value="Double Entry">Double Entry</option>
                                                <option value="Transit">Transit</option>
                                                <option value="Double Transit">Double Transit</option>
                                            </select> </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group" style="margin-top:25px;">
                                            <input type="button" class="btn btn-primary" onclick="updateApplicationCharges(this.form)" value="Update">
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </form>
                </div>


                <?php  } } } */ ?> -->

                <?php if(isset($_POST['invoiceno'])) {
            $invoiceno=$_POST['invoiceno'];
    $query="select invoice.*,point_of_contact.*, application.application_referenceno,
    application.application_feestatus from application 
    inner join invoice on
    application.application_invoice_no=invoice.invoice_no
    inner join point_of_contact on
    application.application_poc_id=point_of_contact.poc_id
    where invoice.invoice_no='".$invoiceno."'";
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
            ?>

                <div class="card">

                    <div class="card-header">
                        <span style="color:red;">Invoice Number </span>
                        <input class="form-inline-control" size="7" disabled type="text" id="invoiceno"
                            value=" <?php echo $invoiceno ?>">
                    </div>
                    <form>
                        <input type="hidden" name="invoiceno" value="<?php echo $invoiceno ?>" name="invoiceno">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" name="applicationreferenceno"
                                            value="<?php echo $row['application_referenceno']; ?>"
                                            placeholder="ApplicationReferenceNO">
                                    </div>
                                    <div class="form-group col-lg-8">
                                        <input type="text" class="form-control" name="odocuments"
                                            value="<?php echo $row['original_documents']; ?>"
                                            placeholder="Original Documents">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <input type="text" class="form-control" name="rdocuments"
                                            value="<?php echo $row['related_documents']; ?>"
                                            placeholder="Original Relative Documents">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <input type="text" class="form-control" name="sdocuments"
                                            value="<?php echo $row['supportive_documents']; ?>"
                                            placeholder="Supportive Documents">
                                    </div>
                                    <div class="form-group col-lg-2" style="text-align: left;">
                                        <input class="btn btn-primary" name="saveapplication" type="button"
                                            value="Update" onclick="updateReferenceDocument(this.form)">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>

                <?php 
    if($row['application_feestatus']!='paid')
    { ?>
                <div class="card">
                    <div class="card-header">
                        Point of Contact
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <form id="point_of_contact_form">
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <input type="search" id="searchnidpoc" class="form-control"
                                            placeholder="SearchBasedOnNIDNumber">
                                        <input type="hidden" name="pocid" id="pocid"
                                            value="<?php echo $row['poc_id']; ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" id="firstnamepoc"
                                            placeholder="FirstName" value="<?php echo $row['poc_firstname']; ?>">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" id="secondnamepoc"
                                            placeholder="SecondName" value="<?php echo $row['poc_lastname']; ?>">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <input type="text" value="<?php echo $row['poc_mobileno1']; ?>"
                                            class="form-control" id="phone1poc" placeholder="Phone1">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <input type="text" value="<?php echo $row['poc_mobileno2']; ?>"
                                            class="form-control" id="phone2poc" placeholder="Phone2">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <input type="text" class="form-control" value="<?php echo $row['poc_nid']; ?>"
                                            id="nidpoc" placeholder="NID">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <input type="email" class="form-control" id="emailPOC" placeholder="Email">
                                    </div>
                                    <div class="form-group col-lg-9 buttons">
                                        <input type="button" class="btn btn-primary" id="newbuttonpoc"
                                            onclick="clearPOC()" value="New">
                                        <input type="button" class="btn btn-primary" id="savebuttonpoc"
                                            onclick="insertDataPOC()" value="save">
                                        <input type="button" class="btn btn-primary" id="updatebuttonpoc" value="update"
                                            onclick="updateDataPOC()" disabled>
                                        <input type="button" class="btn btn-primary" id="selectbuttonpoc" value="select"
                                            onclick="selectPOC()" disabled>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <?php
    $query="SELECT applicant.*, application.*
FROM application inner JOIN applicant ON
application.application_applicant_id = applicant.applicant_id
where application_invoice_no=".$invoiceno;
    $result=mysqli_query($connection,$query);
    $count=mysqli_num_rows($result);
    while($row=mysqli_fetch_assoc($result))
    {
                ?>
                <div class="card card-design">
                    <div class="card-header applicant-title">
                        <h4>Applicant</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <form>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input type="hidden" name="applicantid">
                                        <input type="search" class="form-control"
                                            placeholder="SearchBasedOnPassportNumber" name="applicantsearchbox"
                                            onkeyup="searchApplicant(this.form,event)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" placeholder="FirstName"
                                            value="<?php echo $row['applicant_firstname']; ?>" name="firstname">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" placeholder="LastName" name="lastname"
                                            value="<?php echo $row['applicant_lastname']; ?>">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" placeholder="Phone" name="phone"
                                            value="<?php echo $row['applicant_mobileno']; ?>">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" placeholder="PassportNo"
                                            name="passportno" value="<?php echo $row['applicant_passportno']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="zone">Zone</label>
                                        <select class="form-control" id="zone" name="zone"
                                            onchange="loadProvince(this.form)">
                                            <option value="201">kabul</option>
                                            <option value="202">herat</option>
                                            <option value="203">kandahar</option>
                                            <option value="204">Mazare-sharif</option>
                                            <option value="205">other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="province">Province</label>
                                        <select class="form-control" id="province" name="province">
                                            <option value="01">kabul</option>
                                            <option value="20">khost</option>
                                            <option value="21">kunar</option>
                                            <option value="22">Laghman</option>
                                            <option value="23">Logar</option>
                                            <option value="24">Nangarhar</option>
                                            <option value="25">Nuristan</option>
                                            <option value="26">Paktia</option>
                                            <option value="27">Paktika</option>
                                            <option value="28">Panjshir</option>
                                            <option value="29">Parwan</option>
                                            <option value="30">Wardak</option>
                                            <option value="31">Bameyan</option>
                                            <option value="32">Daikundi</option>
                                            <option value="33">Ghazni</option>
                                            <option value="34">Kapisa</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" id="dob" class="form-control" name="dateofbirth">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="passporttype">PassportType</label>
                                        <select class="form-control" id="passporttype" name="passporttype">
                                            <option value="Special">Special</option>
                                            <option value="Ordinary">Ordinary</option>
                                            <option value="Service">Service</option>
                                            <option value="Student">Student</option>
                                            <option value="UN Blue">UN Blue</option>
                                            <option value="Business">Business</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <select class="form-control" placeholder="Occupation" name="occupation"
                                            id="occupation">
                                            <option value="Agriculture">Agriculture</option>
                                            <option value="Armed/Security Force">Armed/Security Force</option>
                                            <option value="Artist/Performer">Artis/Performer</option>
                                            <option value="Business">Business</option>
                                            <option value="Caregiver and Babysitter">Caregiver and Babysitter</option>
                                            <option value="Construction">Construction</option>
                                            <option value="Culinary/Cookery">Culinary/Cookery</option>
                                            <option value="Driver/Lorry">Driver/Lorry</option>
                                            <option value="Education and Training">Education and Training</option>
                                            <option value="Engineer">Engineer</option>
                                            <option value="Finance and Banking">Finance and Banking</option>
                                            <option value="Governament">Governament</option>
                                            <option value="Health/Medical">Health/Medical</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Legal Professional">Legal Professional</option>
                                            <option value="Press/Media">Press/Media</option>
                                            <option value="Professional Sportsperson">Professional Sportsperson</option>
                                            <option value="Religious Functionary">Religious Functionary</option>
                                            <option value="Researcher/Scienctist">Researcher/Scienctist</option>
                                            <option value="Retired">Retired</option>
                                            <option value="Seafarer">Seafarer</option>
                                            <option value="Self-Employed">Self-Employed</option>
                                            <option value="Service Sector">Service Sector</option>
                                            <option value="Student/Trainee">Student/Trainee</option>
                                            <option value="Tourism">Tourism</option>
                                            <option value="Unemployed">Unemployed</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" placeholder="Relation" name="relation">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="male">Male</label>
                                        <input type="radio" checked name="gender" value="male" id="male">
                                        <label for="female">Female</label>
                                        <input type="radio" name="gender" value="female" id="female">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" placeholder="Father Name"
                                            name="fathername">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" placeholder="Mother Name"
                                            name="mothername">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3"> </div>
                                    <div class="form-group col-lg-12 buttons">
                                        <input type="button" name="newbutton" class="btn btn-primary"
                                            onclick="newDataApplicant(this.form)" value="New">
                                        <input type="button" name="savebutton" class="btn btn-primary" value="save"
                                            onclick="insertDataApplicant(this.form)">
                                        <input disabled type="button" class="btn btn-primary"
                                            onclick="updateDataApplicant(this.form)" name="updatebutton" value="update">
                                        <input type="button" class="btn btn-primary" disabled value="Select"
                                            name="selectbutton" onclick="selectApplicant(this.form)">
                                    </div>
                                </div>

                            <li class="list-group-item application-title">
                                <h5>Application</h5>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <input class="btn btn-primary" name="saveapplication" type="button"
                                            value="Send To Cashier" disabled onclick="insertApplication(this.form)">
                                        <input type="hidden" name="application_no" class='application_no'
                                            value="<?php echo $row['application_no']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="embassy">Embassy Charges
                                        </label>
                                        <input type='text' class="form-control" id="embassy" name="embassycharges"
                                            value="<?php echo $row['application_embassycharges']; ?>">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="tvac">TVAC Charges</label>
                                        <input class="form-control" id="tvac" name="tvaccharges" type='text'
                                            value="<?php echo $row['application_TVACcharges'];?>">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="type">Visa Type</label>
                                        <select class="form-control" id="type" name="visatype">

                                            <?php 
                        $echarges=array("Touristic","Business","Student / Education","Medical / Treatment","Work"
                                       ,"Transit","Conference / Seminar","Training","Official Medical",
                                       "Turkey ScholarShip Student","Some Special Meeting / Visit",
                                       "Other Scholarship Situation");
                        foreach($echarges as $value)
                                        {
                        if($value==$row['application_visaType'])
                        echo "<option value='$value' selected='selected'>$value</option>";
                        else 
                        echo "<option value='$value'>$value</option>";
                                        }
                                        ?>
                                            <!--    
                                            <option value="Tourstic">Touristic</option>
                                            <option value="Business">Business</option>
                                            <option value="Student / Education">Student / Education</option>
                                            <option value="Medical / Treatment">Medical / Treatment</option>
                                            <option value="Work">Work</option>
                                            <option value="Transit">Transit</option>
                                            <option value="Conference / Seminar">Conference / Semeinar</option>
                                            <option value="Training">Training</option>
                                            <option value="Official Medical">Official Medical</option>
                                            <option value="Turkey ScholarShip Student">Turkey Scholarship Student</option>
											<option value="Festival/Fare/Exhibition Visa">Festival/Fare/Exhibition Visa</option>
											<<option value="Sportive Activity Visa">Sportive Activity Visa</option>
											<option value="Cultural Artist Activity Visa">Cultural Artist Activity Visa</option>
                                            <option value="Some Special Meetings / Visit">Some Special Meetings / Visit</option>
											
                                            <option value="Other Scholarship Situation">Other Scholarship Situation</option>-->
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="entrytype">Entry Type</label>
                                        <select class="form-control" id="entrytype" name="entrytype">
                                            <?php 
                        $echarges=array("Single Entry","Multiple Entry","Transit","Double Transit");
                        foreach($echarges as $value)
                                        {
                        if($value==$row['application_entrytype'])
                        echo "<option value='$value' selected='selected'>$value</option>";
                        else 
                        echo "<option value='$value'>$value</option>";
                                        }
                                        ?>
                                            <!--
                                            <option value="Single Entry"> Single Entry</option>
                                            <option value="Multiple Entry">Multiple Entry</option>
                                            <option value="Transit">Transit</option>
                                            <option value="Double Transit">Double Transit</option>
                                            -->
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </form>
                    </ul>
                </div>
                <?php  } ?>
                <!-- generate dynamic form -->
                <div class="card text-center extra">
                    <div class="card-header">
                        Generate Forms
                    </div>
                    <div class="card-body">

                        <p class="card-text"></p>
                        <form action="" id="needs-validation" novalidate>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <h4 class="card-title"> Number of Applicants</h4>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number" name="" class="input form-control myinput"
                                        id="generateforminput" placeholder="Enter number of Applicants" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-primary addform" id="generatebutton"
                                            type="submit">Generate</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>

                    <div class="card text-center extra dynamic-form">
                        <div class="card-body">
                            <div class="newforms">
                            </div>
                        </div>
                    </div>

                </div>


                <?php
        $invoiceno=$_POST['invoiceno']; 
   // $invoiceno=55555;
$query1='SELECT invoice.*, application.*, applicant.*
FROM invoice
    inner JOIN application ON application.application_Invoice_no = invoice.invoice_no
    inner JOIN applicant ON application.application_applicant_id = applicant.applicant_id
where invoice.invoice_no='.$invoiceno;
     ?>
                <table class="table tabel-stripped">
                    <tr>

                        <th>Applicants Name</th>
                        <th>Visa Type</th>
                        <th>PassportType</th>
                        <th>Type of Entry</th>
                        <th>FeeStatus</th>
                        <th>Status</th>
                        <th>P.P</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    $result=mysqli_query($connection,$query1);
                    $i=1;
                    $sum1=0;
                    $sum2=0;
                    while($row2=mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>

                        <td>
                            <?php echo $row2['applicant_firstname'].' '.$row2['applicant_lastname']; ?>
                        </td>
                        <td>
                            <?php echo $row2['application_visaType']; ?>
                        </td>
                        <td>
                            <?php echo $row2['applicant_passprotType']; ?>
                        </td>
                        <td>
                            <?php echo $row2['application_entrytype']; ?>
                        </td>
                        <td>
                            <?php echo $row2['application_feestatus']; ?>
                        </td>
                        <td>
                            <?php echo $row2['application_approvestatus']; ?>
                        </td>
                        <td>
                            <?php echo $row2['applicant_passportno']; ?>
                        </td>
                        <td>
                            <form method="post" action="updateApplication.php">
                                <input type="submit" class="btn btn-danger" value="Delete">
                                <input type="hidden" name="invoiceno" value="<?php echo $invoiceno; ?>">
                                <input type="hidden" value="<?php echo $row2['application_no'];?>"
                                    name="application_no">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <?php
                } }?>
                <!-- new dynamic form-->







                <div class=" modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel" id="modal-title">Message</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="btn btn-primary" id="close-button">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php require("footer.php"); ?>

    </div>

    <!-- the last bootstrap file-->
    <?php require("footer-links.php"); ?>
    <script>
    // document inserting
    var searchnid = document.getElementById("searchnidpoc");
    var firstname = document.getElementById("firstnamepoc");
    var secondname = document.getElementById("secondnamepoc");
    var phone1 = document.getElementById("phone1poc");
    var phone2 = document.getElementById("phone2poc");
    var nid = document.getElementById("nidpoc");
    var emailPOC = document.getElementById("emailPOC");
    var formPOC = document.getElementById("point_of_contact_form");
    var invoiceform = document.getElementById("invoiceform");
    var newbutton = document.getElementById("newbuttonpoc")
    var updatebutton = document.getElementById("updatebuttonpoc");
    var savebutton = document.getElementById("savebuttonpoc");
    var selectbutton = document.getElementById("selectbuttonpoc");
    //   var newPOC = document.getElementById("newPOC");
    var generatebutton = document.getElementById("generatebutton");
    var generateforminput = document.getElementById("generateforminput");
    var invoiceusage = "false";
    var pocid;
    var applicantid;
    var i;

    /*    function insertDocuments() {
             var rd = document.getElementById('rdocuments');
             var sd = document.getElementById('sdocuments');
             var od = document.getElementById("odocuments");
             var invoiceno = document.getElementById("invoiceno");
             //  od.classList.remove("error");
             //if (od.value == "")
             //  od.classList.add("error");
             //else
             $.ajax({
                 url: 'application-php.php',
                 type: 'POST',
                 data: {
                     invoiceno: invoiceno.value,
                     odocuments: od.value,
                     rdocuments: rd.value,
                     sdocuments: sd.value,
                     actionString: "insertDocuments"
                 },
                 success: function(response) {
                     $('#myModal').modal('show');
                     $('#modal-body').text("Documents Added");
                 }
             });
         }
         */
    //application insertion
    function cleanApplicationForm(formid) {
        for (var i = 0; i < formid.length; i++)
            formid.elements[i].classList.remove("error");
    }

    function addApplication(formid) {
        //   var applicationreferenceno = formid.applicationreferenceno;
        pocid = $('#pocid').val();
        //  console.log(pocid);
        var tvaccharges = formid.tvaccharges;
        var embassycharges = formid.embassycharges;
        var visatype = formid.visatype;
        var invoice = $("#invoiceno").val();
        var aid = applicantid;
        var entrytype = formid.entrytype;
        tvaccharges.classList.remove('inputError');
        embassycharges.classList.remove('inputError');
        if (checkValues(tvaccharges.value) == false)
            tvaccharges.classList.add('inputError');
        else if (checkValues(embassycharges.value) == false)
            embassycharges.classList.add('inputError');
        else {
            //  var application_no = formid.application_no;
            $.ajax({
                url: 'updateApplication-php.php',
                type: 'POST',
                //    dataType: 'json',
                data: {
                    //  applicationreferenceno: applicationreferenceno.value,
                    tvaccharges: tvaccharges.value,
                    embassycharges: embassycharges.value,
                    visatype: visatype.value,
                    pocid: pocid,
                    applicantid: aid,
                    //   application_no: application_no.value,
                    invoiceno: $('#invoiceno').val(),
                    entrytype: entrytype.value,
                    //  invoiceusage: invoiceusage,
                    actionString: "addApplication"
                },
                success: function(response) {
                    //   if (response[0].invoiceno == 'duplicate') {
                    //     $('#myModal').modal('show');
                    //      $('#modal-body').text("Duplicate ApplicationReferenceNo is not allowed");
                    //   } else {
                    $('#myModal').modal('show');
                    $('#modal-body').text("ApplicationSavedSuccessfully");
                    for (var i = 0; i < formid.length; i++)
                        formid.elements[i].disabled = true;
                    //  invoiceusage = "true";
                    $('#cashier').prop('disabled', false);
                    //  $('#invoiceno').val(response[0].invoiceno);
                }
            });
        }
    }

    function checkValues(value) {
        if (value == "" || isNaN(value) == true)
            return false;
        else
            return true;
    }

    function insertApplication(formid) {
        //   var applicationreferenceno = formid.applicationreferenceno;
        pocid = $('#pocid').val();
        // console.log(pocid);
        var tvaccharges = formid.tvaccharges;
        var embassycharges = formid.embassycharges;
        var visatype = formid.visatype;
        var invoice = $("#invoiceno").val();
        var aid = applicantid;
        var entrytype = formid.entrytype;
        // var application_no = formid.application_no;
        // var application_no = $('.application_no').val();

        var application_no = formid.application_no;
        //  console.log(application_no);
        tvaccharges.classList.remove('inputError');
        embassycharges.classList.remove('inputError');
        if (checkValues(tvaccharges.value) == false)
            tvaccharges.classList.add('inputError');
        else if (checkValues(embassycharges.value) == false)
            embassycharges.classList.add('inputError');
        else {
            $.ajax({
                url: 'updateApplication-php.php',
                type: 'POST',
                //    dataType: 'json',
                data: {
                    //  applicationreferenceno: applicationreferenceno.value,
                    tvaccharges: tvaccharges.value,
                    embassycharges: embassycharges.value,
                    visatype: visatype.value,
                    pocid: pocid,
                    applicantid: aid,
                    application_no: application_no.value,
                    invoiceno: $('#invoiceno').val(),
                    entrytype: entrytype.value,
                    invoiceusage: invoiceusage,
                    actionString: "insertApplicationData"
                },
                success: function(response) {
                    if (response[0].invoiceno == 'duplicate') {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Duplicate ApplicationReferenceNo is not allowed");
                    } else {
                        $('#myModal').modal('show');
                        $('#modal-body').text("ApplicationSavedSuccessfully");
                        for (var i = 0; i < formid.length; i++)
                            formid.elements[i].disabled = true;
                        //  invoiceusage = "true";
                        $('#cashier').prop('disabled', false);
                        //  $('#invoiceno').val(response[0].invoiceno);
                    }
                }
            });
        }
    }

    // point of contact methods

    /*       function defaultPage() {
               var invoice = document.getElementById("invoiceno").value;
               for (i = 0; i <= 9; i++) {
                   formPOC.elements[i].disabled = false;
                   if (i >= 0 && i <= 7)
                       formPOC.elements[i].value = "";
               }
               generateforminput.disabled = true;
               //    newPOC.disabled = true;
               invoiceform.elements[0].value = "";
               invoiceform.elements[1].value = "";
               invoiceform.elements[2].value = "";
               invoiceform.elements[3].value = "";
               invoiceform.elements[4].disabled = true;
               generatebutton.disabled = true;
               document.getElementsByClassName("newforms")[0].innerHTML = "";
               if (invoiceusage == "false") {
                    $.ajax({
                        url: 'application-php.php',
                        type: 'POST',
                        data: {
                            actionString: "deleteInvoiceno",
                            invoiceno: invoice
                        },
                        success: function (response) {
                            if (response.trim() == 'false') {
                                $('#myModal').modal('show');
                                $('#modal-body').text("couldn't delete the invoice number");
                            } else {
                                $('#myModal').modal('show');
                                $('#modal-body').text("generated invoice number deleted");
                            }
                        }
                    });

                }
    invoiceusage = "false";
    }*/

    function clearPOC() {
        for (i = 0; i <= 7; i++) {
            formPOC.elements[i].value = "";
            formPOC.elements[i].className = formPOC.elements[i].className.replace("error", "");
        }
        formPOC.elements[6].disabled = false;
        formPOC.elements[10].disabled = true;
        formPOC.elements[11].disabled = true;
    }

    function selectPOC() {
        for (i = 0; i < formPOC.elements.length; i++)
            formPOC.elements[i].disabled = true;
        //    newPOC.disabled = false;
        /*    $.ajax({
                url: 'application-php.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    actionString: "generateInvoiceNumber"
                },
                success: function(response) {
                    if (response == 'false') {
                        $('#myModal').modal('show');
                        $('#modal-body').text("the Invoice Number has exceed its limitation");
                    } else {
                        $("#invoiceno").val(response[0].invoiceno);
                        generatebutton.disabled = false;
                        generateforminput.disabled = false;
                        pocid = $('#pocid').val();
                    }
                }
            });*/
        //  generatebutton.disabled = false;
        //  generateforminput.disabled = false;
        pocid = $('#pocid').val();

    }


    function selectApplicant(formid) {
        if (formid.selectbutton.value == "Select") {
            for (var i = 0; i < 17; i++)
                formid.elements[i].disabled = true;
            applicantid = formid.applicantid.value;
            formid.selectbutton.value = "Deselect";
            formid.selectbutton.disabled = false;
            formid.saveapplication.disabled = false;
        } else {
            for (var i = 0; i < 17; i++)
                formid.elements[i].disabled = false;
            formid.selectbutton.value = "Select";
            applicantid = "";
            formid.saveapplication.disabled = true;
        }
    }
    searchnid.addEventListener("keyup", function(event) {

        if (event.keyCode === 13) {
            event.preventDefault();
            var key = $(this).val();
            $(this).removeClass('error');
            clearPOC();
            if (key == "") {
                $('#myModal').modal('show');
                $('#modal-body').text("Please Enter an NID");
            } else $.ajax({
                url: 'application-php.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    key: key,
                    actionString: "searchnid"
                },
                success: function(response) {
                    if (response == false) {
                        $('#myModal').modal('show');
                        $('#modal-body').text("No Record with this NID");
                    } else {
                        //    pocid = response[0].pocid;
                        firstname.value = response[0].firstname;
                        secondname.value = response[0].secondname;
                        phone1.value = response[0].phone1;
                        phone2.value = response[0].phone2;
                        nid.value = response[0].nid;
                        emailPOC.value = response[0].email;
                        document.getElementById("pocid").value = response[0].pocid;
                        nid.disabled = true;
                        updatebutton.disabled = false;
                        selectbutton.disabled = false;
                    }
                }
            });

        }
    });
    /*    $(document).on("keyup", "searchid", function(e) {
            if (e.which == 13) {
                var inputVal = $(this).val();
                alert("You've entered: " + inputVal);
            }
        });*/
    //   }
    function updateDataPOC() {
        var actionString = "updatePOC";
        $('#firstnamepoc').removeClass('error');
        $('#secondnamepoc').removeClass('error');
        $('#phone1poc').removeClass('error');
        $('#nidpoc').removeClass('error');
        if (firstname.value == "") {
            $('#firstnamepoc').addClass('error');
        } else if (secondname.value == "") {
            $('#secondnamepoc').addClass('error');
        } else if (phone1.value == "") {
            $('#phone1poc').addClass('error');
        } else if (nid.value == "") {
            $('#nidpoc').addClass('error');
        } else
            $.ajax({
                url: 'application-php.php',
                type: 'POST',
                data: {
                    firstname: firstname.value,
                    secondname: secondname.value,
                    phone1: phone1.value,
                    phone2: phone2.value,
                    nid: nid.value,
                    email: emailPOC.value,
                    actionString: actionString
                },
                success: function(response) {
                    if (response.trim() == "true") {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Record updated Successfully");
                        //   $('#myModal').on('hidden.bs.modal', function (e) {

                        //   });
                        //  clearPOC();
                    } else {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Failed to update the record");
                    }


                }

            });
    }
    // applicant


    function loadProvince(formid) {
        var zonebox = formid.zone;
        var provincebox = formid.province;
        var selectedvalue = zonebox.options[zonebox.selectedIndex].value;
        var actionString = "loadProvince";
        $.ajax({
            url: 'application-php.php',
            type: 'POST',
            dataType: 'json',
            data: {
                selectedvalue: selectedvalue,
                actionString: actionString
            },
            success: function(response) {

                displayProvince(response, provincebox);
            }
        });
    }

    function displayProvince(response, provincebox) {
        provincebox.innerHTML = "";
        for (var i = 0; i < response.length; i++) {
            var option = document.createElement("option");
            option.setAttribute('value', response[i].province_id);
            option.appendChild(document.createTextNode(response[i].province_name));
            provincebox.appendChild(option);
        }
    }

    function cleanApplicantForm(formid) {
        for (var i = 0; i < 12; i++)
            formid.elements[i].classList.remove("error");
        formid.passportno.disabled = false;

    }

    function clearApplicantForm(formid) {
        formid.reset();
        formid.updatebutton.disabled = true;
        formid.selectbutton.disabled = true;
    }

    function checkEmptyValuesApplicantForm(formid) {

        for (var i = 2; i < 12; i++)
            if (formid.elements[i].value == "") {
                if (i == 4) continue;
                formid.elements[i].classList.add("error");
                return true;
            }
        return false;
    }


    function updateDataApplicant(formid) {
        var firstname = formid.firstname;
        var lastname = formid.lastname;
        var phone = formid.phone;
        var passportno = formid.passportno;
        var zone = formid.zone;
        var province = formid.province;
        var dob = formid.dateofbirth;
        var passporttype = formid.passporttype;
        var occupation = formid.occupation;
        var relation = formid.relation;
        var gender = formid.gender;
        var fathername = formid.fathername;
        var mothername = formid.mothername;
        cleanApplicantForm(formid);
        if (checkEmptyValuesApplicantForm(formid)) {
            return;
        } else {
            $.ajax({
                url: 'application-php.php',
                type: 'POST',
                data: {
                    firstname: firstname.value,
                    lastname: lastname.value,
                    phone: phone.value,
                    passportno: passportno.value,
                    zone: zone.value,
                    province: province.value,
                    dob: dob.value,
                    passporttype: passporttype.value,
                    occupation: occupation.value,
                    relation: relation.value,
                    gender: gender.value,
                    fathername: fathername.value,
                    mothername: mothername.value,
                    actionString: "updateDataApplicant"
                },
                success: function(response) {

                    $('#myModal').modal('show');
                    $('#modal-body').text("Record updated Successfully");
                    //  clearApplicantForm(formid);
                    // cleanApplicantForm(formid);
                }
            });


        }
    }

    function newDataApplicant(formid) {
        clearApplicantForm(formid);
        cleanApplicantForm(formid);

    }

    function searchApplicant(formid, event) {
        var searchbox = formid.applicantsearchbox;
        if (event.keyCode === 13) {
            event.preventDefault();
            var key = searchbox.value;
            searchbox.classList.remove("error");
            cleanApplicantForm(formid);
            if (key == "") {
                $('#myModal').modal('show');
                $('#modal-body').text("Please Enter a PassportNo");
            } else $.ajax({
                url: 'application-php.php',
                type: 'post',
                dataType: 'json',
                data: {
                    key: key,
                    actionString: "searchpassportnumber"
                },
                success: function(response) {
                    if (response == false) {
                        $('#myModal').modal('show');
                        $('#modal-body').text("No Record with this Passport Number");
                    } else {
                        formid.firstname.value = response[0].firstname;
                        formid.lastname.value = response[0].lastname;
                        formid.phone.value = response[0].mobileno;
                        formid.passportno.value = response[0].passportno;
                        formid.dateofbirth.value = response[0].dob;
                        formid.fathername.value = response[0].fathername;
                        formid.mothername.value = response[0].mothername;
                        //    formid.occupation.value = response[0].occupation;
                        for (var i = 0; i < formid.occupation.options.length; i++)
                            if (response[0].occupation == formid.occupation.options[i].value)
                                formid.occupation.options[i].selected = true;
                        formid.relation.value = response[0].relation;
                        formid.applicantid.value = response[0].applicantid;
                        (response[0].gender == "male") ? formid.gender[0].checked = true: formid.gender[
                                1]
                            .checked = true;
                        //   var selectedvalue = zonebox.options[zonebox.selectedIndex].value;

                        for (var i = 0; i < formid.zone.options.length; i++)
                            if (response[0].zone == formid.zone.options[i].value)
                                formid.zone.options[i].selected = true;
                        displayProvince(response, formid.province);
                        for (var i = 0; i < formid.passporttype.options.length; i++)
                            if (response[0].passportType == formid.passporttype.options[i].value) formid
                                .passporttype.options[i].selected =
                                true; //formid.passporttype.options[1].selected = true;
                        formid.passportno.disabled = true;
                        formid.updatebutton.disabled = false;
                        formid.selectbutton.disabled = false;
                    }
                }
            });
        }
    }

    function insertDataApplicant(formid) {
        var firstname = formid.firstname;
        var lastname = formid.lastname;
        var phone = formid.phone;
        var passportno = formid.passportno;
        var zone = formid.zone;
        var province = formid.province;
        var dob = formid.dateofbirth;
        var passporttype = formid.passporttype;
        var occupation = formid.occupation;
        var relation = formid.relation;
        var gender = formid.gender;
        var fathername = formid.fathername;
        var mothername = formid.mothername;
        cleanApplicantForm(formid);
        if (checkEmptyValuesApplicantForm(formid)) {
            return;
        } else {
            $.ajax({
                url: 'application-php.php',
                type: 'POST',
                data: {
                    firstname: firstname.value,
                    lastname: lastname.value,
                    phone: phone.value,
                    passportno: passportno.value,
                    zone: zone.value,
                    province: province.value,
                    dob: dob.value,
                    passporttype: passporttype.value,
                    occupation: occupation.value,
                    relation: relation.value,
                    gender: gender.value,
                    fathername: fathername.value,
                    mothername: mothername.value,
                    actionString: "insertApplicantData"
                },
                success: function(response) {
                    if (response.trim() == 'false') {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Duplicate PassportNumber is not allowed");
                    } else {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Record Inserted Successfully");
                        $('#myModal').on('hidden.bs.modal', function(e) {
                            // clearApplicantForm(formid);
                        })

                    }
                }
            });

        }

    }

    function insertDataPOC() {
        var actionString = "insertPOC";
        $('#firstnamepoc').removeClass('error');
        $('#secondnamepoc').removeClass('error');
        $('#phone1poc').removeClass('error');
        $('#nidpoc').removeClass('error');
        if (firstname.value == "") {
            $('#firstnamepoc').addClass('error');
        } else if (secondname.value == "") {
            $('#secondnamepoc').addClass('error');
        } else if (phone1.value == "") {
            $('#phone1poc').addClass('error');
        } else if (nid.value == "") {
            $('#nidpoc').addClass('error');
        } else
            $.ajax({
                url: 'application-php.php',
                type: 'POST',
                data: {
                    firstname: firstname.value,
                    secondname: secondname.value,
                    phone1: phone1.value,
                    phone2: phone2.value,
                    nid: nid.value,
                    email: emailPOC.value,
                    actionString: actionString
                },
                success: function(response) {
                    if (response.trim() == 'false') {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Duplicate NID is not allowed");
                    } else {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Record Inserted Successfully");
                        $('#myModal').on('hidden.bs.modal', function(e) {
                            //          clearPOC();
                        })

                    }
                }
            });
    }
    $(document).ready(function() {
        $('.extra').css('margin-top', 30);
        $('.addform').click(function(e) {
            e.preventDefault();
            let input = $('.myinput').val();
            let temp_html = '';
            for (i = 0; i < input; i++) {
                temp_html +=
                    ' <br> <h3 style="text-align:left;color:red;">New Applicant</h3> <div class="card card-design"> <div class="card-header applicant-title"> <h4>Applicant</h4> </div> <ul class="list-group list-group-flush"> <form> <li class="list-group-item"> <div class="row"> <div class="form-group col-lg-6"><input type="hidden" name="applicantid"> <input type="search" class="form-control" placeholder="SearchBasedOnPassportNumber" name="applicantsearchbox" onkeyup="searchApplicant(this.form,event)"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="FirstName" name="firstname"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="LastName" name="lastname"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Phone" name="phone"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="PassportNo" name="passportno"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <label for="zone">Zone</label> <select class="form-control" id="zone" name="zone" onchange="loadProvince(this.form)"> <option value="201">kabul</option> <option value="202">herat</option> <option value="203">kandahar</option> <option value="204">Mazare-sharif</option> <option value="205">Other</option> </select> </div> <div class="form-group col-lg-3"> <label for="province">Province</label> <select class="form-control" id="province" name="province"> <option value="01">kabul</option> <option value="20">khost</option> <option value="21">kunar</option> <option value="22">Laghman</option> <option value="23">Logar</option> <option value="24">Nangarhar</option> <option value="25">Nuristan</option> <option value="26">Paktia</option> <option value="27">Paktika</option> <option value="28">Panjshir</option> <option value="29">Parwan</option> <option value="30">Wardak</option> <option value="31">Bameyan</option> <option value="32">Daikundi</option> <option value="33">Ghazni</option> <option value="34">Kapisa</option> </select> </div> <div class="form-group col-lg-3"> <label for="dob">Date of Birth</label> <input type="date" id="dob" class="form-control" name="dateofbirth"> </div> <div class="form-group col-lg-3"> <label for="passporttype">PassportType</label> <select class="form-control" id="passporttype" name="passporttype"> <option value="Special">Special</option> <option value="Ordinary">Ordinary</option> <option value="Service">Service</option> <option value="Student">Student</option> <option value="UN Blue">UN Blue</option> <option value="Business">Business</option> </select> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <select class="form-control" placeholder="Occupation" name="occupation" id="occupation"> <option value="Agriculture">Agriculture</option> <option value="Armed/Security Force">Armed/Security Force</option> <option value="Artist/Performer">Artis/Performer</option> <option value="Business">Business</option> <option value="Caregiver and Babysitter">Caregiver and Babysitter</option> <option value="Construction">Construction</option> <option value="Culinary/Cookery">Culinary/Cookery</option> <option value="Driver/Lorry">Driver/Lorry</option> <option value="Education and Training">Education and Training</option> <option value="Engineer">Engineer</option> <option value="Finance and Banking">Finance and Banking</option> <option value="Governament">Governament</option> <option value="Health/Medical">Health/Medical</option> <option value="Information Technology">Information Technology</option> <option value="Legal Professional">Legal Professional</option> <option value="Press/Media">Press/Media</option> <option value="Professional Sportsperson">Professional Sportsperson</option> <option value="Religious Functionary">Religious Functionary</option> <option value="Researcher/Scienctist">Researcher/Scienctist</option> <option value="Retired">Retired</option> <option value="Seafarer">Seafarer</option> <option value="Self-Employed">Self-Employed</option> <option value="Service Sector">Service Sector</option> <option value="Student/Trainee">Student/Trainee</option> <option value="Tourism">Tourism</option> <option value="Unemployed">Unemployed</option> <option value="Other">Other</option> </select> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Relation" name="relation"> </div> <div class="form-group col-lg-3"> <label for="male">Male</label> <input type="radio" checked name="gender" value="male" id="male"> <label for="female">Female</label> <input type="radio" name="gender" value="female" id="female"> </div> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Father Name" name="fathername"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Mother Name" name="mothername"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> </div> <div class="form-group col-lg-12 buttons"> <input type="button" name="newbutton" class="btn btn-primary" onclick="newDataApplicant(this.form)" value="New"> <input type="button" name="savebutton" class="btn btn-primary" value="save" onclick="insertDataApplicant(this.form)"> <input disabled type="button" class="btn btn-primary" onclick="updateDataApplicant(this.form)" name="updatebutton" value="update"> <input type="button" class="btn btn-primary" disabled value="Select" name="selectbutton" onclick="selectApplicant(this.form)"> </div> </div> </li> <li class="list-group-item application-title"> <h5>Application</h5> </li> <li class="list-group-item"> <div class="row"> <div class="form-group col-lg-3"> <input type="text" class="form-control" name="applicationreferenceno" placeholder="ApplicationReferenceNO"> </div> <div class="form-group col-lg-9" style="text-align: right;"> <input class="btn btn-primary" name="saveapplication" type="button" value="Send To Cashier" disabled onclick="addApplication(this.form)"> </div> </div> <div class="row"> <div class="form-group col-lg-3"> <label for="embassy">Embassy Charges</label><input type="text" id="embassy" class="form-control" name="embassycharges"> </div> <div class="form-group col-lg-3"> <label for="tvac">TVAC Charges</label> <input type="text" class="form-control" id="tvac" name="tvaccharges"> </div> <div class="form-group col-lg-3"> <label for="type">Visa Type</label> <select class="form-control" id="type" name="visatype"> <option value="Touristic">Touristic</option> <option value="Business">Business</option> <option value="Student / Education">Student / Education</option> <option value="Medical / Treatment">Medical / Treatment</option> <option value="Work">Work</option> <option value="Transit">Transit</option> <option value="Conference / Seminar">Conference / Semeinar</option> <option value="Training">Training</option> <option value="Official Medical">Official Medical</option> <option value="Turkey ScholarShip Student">Turkey Scholarship Student</option> <option value="Some Special Meetings / Visit">Some Special Meetings / Visit</option> <option value="Festival/Fare/Exhibition Visa">Festival/Fare/Exhibition Visa</option> <option value="Sportive Activity Visa">Sportive Activity Visa</option> <option value="Cultural Artist Activity Visa">Cultural Artist Activity Visa</option>  <option value="Other Scholarship Situation">Other Scholarship Situation</option> </select> </div> <div class="form-group col-lg-3"> <label for="entrytype">Entry Type</label> <select class="form-control" id="entrytype" name="entrytype"> <option value="Single Entry"> Single Entry</option> <option value="Multiple Entry">Multiple Entry</option> <option value="Transit">Transit</option> <option value="Double Transit">Double Transit</option> </select> </div> </div> </li> </form> </ul> </div>';
            }
            $('.newforms').append(temp_html);
        });
    });



    /*   function updateApplicationCharges(formid) {
            var applicationno = formid.applicationno
            var embassycharges = formid.embassycharges
            var tvaccharges = formid.tvaccharges
            var visatype = formid.visatype
            var entrytype = formid.entrytype
            $.ajax({
                url: 'updateApplication-php.php',
                type: 'POST',
                data: {
                    aplicationno: applicationno.value,
                    embassycharges: embassycharges.value,
                    tvaccharges: tvaccharges.value,
                    visatype: visatype.value,
                    entrytype: entrytype.value,
                    actionString: "updateApplicationCharges"
                },
                success: function(response) {

                    $('#myModal').modal('show');
                    $('#modal-body').text("Application Updated Successfully ");

                }
            });
        }
*/
    function updateReferenceDocument(formid) {
        var no = formid.applicationreferenceno;
        var od = formid.odocuments;
        var rd = formid.rdocuments;
        var sd = formid.sdocuments;
        //   console.log(formid.invoiceno.value);
        no.classList.remove("error");
        // od.classList.remove("error");
        if (no.value == "")
            no.classList.add("error");
        //else if (od.value == "")
        //  od.classList.add("error");
        else
            $.ajax({
                url: 'updateApplication-php.php',
                type: 'POST',
                data: {
                    invoiceno: formid.invoiceno.value,
                    odocuments: od.value,
                    rdocuments: rd.value,
                    sdocuments: sd.value,
                    applicationreferenceno: no.value,
                    actionString: "updateApplicationsReferenceno"
                },
                success: function(response) {
                    if (response.trim() == 'true') {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Documents Added");
                    } else {
                        $('#myModal').modal('show');
                        $('#modal-body').text("Duplicate Reference Number is now allowed");
                    }
                }
            });

    }
    </script>
</body>

</html>
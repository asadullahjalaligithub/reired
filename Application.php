<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require ($documentroot . "login-authentication.php");

if ($_SESSION['role'] == 'view') {
    header('location:index.php?logout=true');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require ($documentroot . "header-links.php"); ?>
    <style>
        .dynamic-form {

            position: relative;
            top: 100px;


        }

        #close-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }



        .btn {
            font-weight: bold;
            background-color: #005ab7;
        }

        .buttons {
            text-align: right;
        }

        .application-title h5 {
            text-align: center;

        }

        .applicant-title {
            background-color: #027DFB;
            color: white;
            width: 100%;
            font-weight: bolder;
        }

        .card-design {

            margin-top: 10px;
            padding: 10px;
        }

        .error {
            border-color: red;
        }

        .inputError {
            border: solid 1px red;
        }

        .card-header {
            position: relative;
            padding: 20px;
        }

        .newbutton {
            position: absolute;
            right: 20px;
        }

        input[type='date'] {
            width: 150px;
            padding: 0px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php require ($documentroot . "header.php"); ?>
        <!-- left menus -->

        <div class="row">
            <?php require ($documentroot . "left-menus.php"); ?>
            <!-- right contents -->
            <div class="col-lg-10 col-md-9 col-sm-8 second-column">

                <div class="card">
                    <div class="card-header">
                        Point of Contact
                        <button class="btn btn-primary newbutton" onclick="defaultPage()" id="newPOC" disabled>New
                            Entry</button>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <form id="point_of_contact_form">
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <input type="search" id="searchnidpoc" class="form-control"
                                            placeholder="SearchBasedOnNIDNumber">
                                        <input type="hidden" name="pocid" id="pocid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" id="firstnamepoc"
                                            placeholder="FirstName">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" class="form-control" id="secondnamepoc"
                                            placeholder="SecondName">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <input type="text" class="form-control" id="phone1poc" placeholder="Phone1">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <input type="text" class="form-control" id="phone2poc" placeholder="Phone2">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <input type="text" class="form-control" id="nidpoc" placeholder="NID">
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
                <!-- dynamic created form  documents-->



                <!-- dynamic form 
                <div class="card card-design">
                    <div class="card-header applicant-title">Applicant </div>
                    <ul class="list-group list-group-flush">
                        <form>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-lg-6"><input type="hidden" name="applicantid"> <input type="search" class="form-control" placeholder="SearchBasedOnPassportNumber" name="applicantsearchbox" onkeyup="searchApplicant(this.form,event)"> </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="FirstName" name="firstname"> </div>
                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="LastName" name="lastname"> </div>
                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Phone" name="phone"> </div>
                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="PassportNo" name="passportno"> </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3"> <label for="zone">Zone</label> <select class="form-control" id="zone" name="zone" onchange="loadProvince(this.form)">
                                            <option value="201">kabul</option>
                                            <option value="202">herat</option>
                                            <option value="203">kandahar</option>
                                            <option value="204">Mazare-sharif</option>
                                        </select> </div>
                                    <div class="form-group col-lg-3"> <label for="province">Province</label> <select class="form-control" id="province" name="province">
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
                                        </select> </div>
                                    <div class="form-group col-lg-3">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" id="dob" class="form-control" name="dateofbirth"> </div>

                                    <div class="form-group col-lg-3"> <label for="passporttype">PassportType</label>
                                        <select class="form-control" id="passporttype" name="passporttype">
                                            <option value="single">Special</option>
                                            <option value="Ordinary">Ordinary</option>
                                            <option value="Service">Service</option>
                                            <option value="Student">Student</option>
                                            <option value="UN Blue">UN Blue</option>
                                            <option value="Business">Business</option>
                                        </select> </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Occupation" name="occupation"> </div>
                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" placeholder="Relation" name="relation"> </div>
                                    <div class="form-group col-lg-3"> <label for="male">Male</label> <input type="radio" checked name="gender" value="male" id="male"> <label for="female">Female</label> <input type="radio" name="gender" value="female" id="female"> </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3">

                                    </div>
                                    <div class="form-group col-lg-12 buttons">
                                        <input type="button" name="newbutton" class="btn btn-primary" onclick="newDataApplicant(this.form)" value="New">
                                        <input type="button" name="savebutton" class="btn btn-primary" value="save" onclick="insertDataApplicant(this.form)"> <input disabled type="button" class="btn btn-primary" onclick="updateDataApplicant(this.form)" name="updatebutton" value="update"> <input type="button" class="btn btn-primary" disabled value="Select" name="selectbutton" onclick="selectApplicant(this.form)"> </div>
                                </div>

                            </li>
                            <li class="list-group-item application-title">
                                <h5>Application</h5>
                            </li>
                            <li class="list-group-item">

                                <div class="row">

                                    <div class="form-group col-lg-3"> <input type="text" class="form-control" name="applicationreferenceno" placeholder="ApplicationReferenceNO"> </div>
                                    <div class="form-group col-lg-9" style="text-align: right;">
                                        <input class="btn btn-primary" name="saveapplication" type="button" value="Send To Cashier" disabled onclick="insertApplication(this.form)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3"> <label for="embassy">Embassy Charges</label> <select class="form-control" id="embassy" name="embassycharges">
                                            <option value="60">60</option>
                                            <option value="200">200</option>
                                            <option value="0">0</option>
                                        </select> </div>
                                    <div class="form-group col-lg-3"> <label for="tvac">TVAC Charges</label> <select class="form-control" id="tvac" name="tvaccharges">
                                            <option value="30">30</option>
<option value="120">120</option>
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
                                            <option value="Sportive Activity Visa">Sportive Activity Visa</option>
                                            <option value="Cultural Artist Activity Visa">Cultural Artist Activity Visa</option>
                                            <option value="Other Scholarship Situation">Other Scholarship Situation</option>
                                        </select> </div>
                                    <div class="form-group col-lg-3"> <label for="entrytype">Entry Type</label> <select class="form-control" id="entrytype" name="entrytype">
                                            <option value="Single Entry"> Single Entry</option>
                                            <option value="Double Entry">Double Entry</option>
                                            <option value="Transit">Transit</option>
                                            <option value="Double Transit">Double Transit</option>
                                        </select> </div>
                                </div>

                            </li>
                        </form>
                    </ul>
                </div>

-->


                <!-- dynamic created form closed -->
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
                                        <button class="btn btn-sm btn-primary addform" disabled id="generatebutton"
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
                <div class="row" style="margin-top:80px;"></div>
                <div class="card card-design">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <form id="invoiceform">
                                <div class="row">
                                    <div class="form-group col-lg-2"> <input type="text" id="invoiceno"
                                            class="form-control" placeholder="InvoiceNumber" disabled> </div>

                                    <div class="form-group col-lg-8">
                                        <input type="text" placeholder="Original  Documents" id="odocuments"
                                            class="form-control" name="odocuments">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <input type="text" placeholder="Original Relative Documents" id="rdocuments"
                                            class="form-control" name="rdocuments">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <input type="text" placeholder="Supportive Documents" id="sdocuments"
                                            class="form-control" name="sdocuments">
                                    </div>
                                    <div class="form-group col-2">
                                        <input type="button" class="btn btn-primary" onclick="insertDocuments()"
                                            id="cashier" disabled value="Save Documents">
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        <!-- footer -->
        <?php require ($documentroot . "footer.php"); ?>
    </div>

    <!-- the last bootstrap file-->
    <?php require ($documentroot . "footer-links.php"); ?>

    <script src="application-javascript.js">
    </script>
</body>

</html>
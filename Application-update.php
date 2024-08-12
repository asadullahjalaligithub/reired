<?php
$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require ($documentroot . "login-authentication.php");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require ($documentroot . "header-links.php"); ?>
    <style>
        .buttons {
            text-align: right;
        }

        .application-title h5 {
            text-align: center;

        }

        .applicant-title {
            background-color: #027DFB;
            color: white;
            font-weight: bolder;
        }

        .card-design {
            border: solid 1px #027DFB;
            margin-bottom: 10px;
            margin-top: 20px;
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
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <form>
                                <div class="row">
                                    <div class="form-group col-5">
                                        <input type="search" class="form-control" placeholder="SearchBasedOnNIDNumber">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="FirstName">
                                    </div>
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="SecondName">
                                    </div>
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="Phone1">
                                    </div>
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="Phone2">
                                    </div>
                                    <div class="form-group col">
                                        <input type="text" class="form-control" placeholder="NID">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col buttons">

                                        <input type="button" class="btn btn-primary" value="update">

                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="card card-design">
                        <div class="card-header applicant-title">Applicant </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <form>
                                    <div class="row">
                                        <div class="form-group col-5"> <input type="search" class="form-control"
                                                placeholder="SearchBasedOnPassportNumber"> </div>
                                        <div class="form-group col-5"> <input type="search" class="form-control"
                                                placeholder="InvoidNumber"> </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col"> <input type="text" class="form-control"
                                                placeholder="FirstName"> </div>
                                        <div class="form-group col"> <input type="text" class="form-control"
                                                placeholder="LastName"> </div>
                                        <div class="form-group col"> <input type="text" class="form-control"
                                                placeholder="Phone"> </div>
                                        <div class="form-group col"> <input type="text" class="form-control"
                                                placeholder="PassportNo"> </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col"> <label for="province">Province</label> <select
                                                class="form-control" id="province">
                                                <option>Kabul</option>
                                                <option>Herat</option>
                                                <option>Ghazni</option>
                                                <option>Mazar</option>
                                            </select> </div>
                                        <div class="form-group col"> <label for="dob">Date of Birth</label> <input
                                                type="date" id="dob" class="form-control"> </div>
                                        <div class="form-group col"> <label for="zone">Zone</label> <select
                                                class="form-control" id="zone">
                                                <option>First</option>
                                                <option>Second</option>
                                                <option>Third</option>
                                                <option>Fourth</option>
                                            </select> </div>
                                        <div class="form-group col"> <label for="passporttype">PassportType</label>
                                            <select class="form-control" id="passporttype">
                                                <option>Single</option>
                                                <option>Multiple</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-3"> <input type="text" class="form-control"
                                                placeholder="phone"> </div>
                                        <div class="form-group col-3"> <input type="text" class="form-control"
                                                placeholder="Occupation"> </div>
                                        <div class="form-group col-3"> <input type="text" class="form-control"
                                                placeholder="Relation"> </div>
                                        <div class="form-group col-3"> <label for="male">Male</label> <input
                                                type="radio" name="gender" id="male"> <label for="female">Female</label>
                                            <input type="radio" name="gender" id="female">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-3"> <label for="documents">Documents</label> <select
                                                class="form-control" multiple>
                                                <option>Marriage Certificate</option>
                                                <option>Tazkira</option>
                                                <option>House Documents</option>
                                            </select> </div>
                                        <div class="form-group col buttons">
                                            <input type="button" class="btn btn-primary" value="update">
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li class="list-group-item application-title">
                                <h5>Application</h5>
                            </li>
                            <li class="list-group-item">
                                <form>
                                    <div class="row">
                                        <div class="form-group col"> <input type="text" class="form-control"
                                                placeholder="ApplicationNumber"> </div>
                                        <div class="form-group col"> <input type="text" class="form-control"
                                                placeholder="ApplicationReferenceNO"> </div>
                                        <div class="form-group col" style="text-align: right;"> <input
                                                class="btn btn-primary" type="button" value="Update"> </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col"> <label for="embassy">Embassy Charges</label>
                                            <select class="form-control" id="embassy">
                                                <option value="60">60</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                        <div class="form-group col"> <label for="tvac">TVAC Charges</label> <select
                                                class="form-control" id="tvac">
                                                <option value="30">30</option>
                                                <option value="40">40</option>
                                            </select> </div>
                                        <div class="form-group col"> <label for="type">Visa Type</label> <select
                                                class="form-control" id="type">
                                                <option>Tourist</option>
                                                <option>Student</option>
                                            </select> </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>



            </div>


        </div>

        <!-- footer -->
        <?php require ($documentroot . "footer.php"); ?>
    </div>

    <!-- the last bootstrap file-->
    <script src="jquery/jquery.js"></script>
    <script src="jquery/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>

    </script>
</body>

</html>
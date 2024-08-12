<?php require("login-authentication.php"); 
if($_SESSION['role']=='user' || $_SESSION['role']=='view' || $_SESSION['role']=='finance') {
    header('location:index.php?logout=true');
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require("header-links.php"); ?>
    <style>
.myCard,.secondCard {
            border: solid 1px #cccccc;
            padding: 10px;
            border-radius: 5px;
        }

        .myCard .card-title ,.secondCard .card-title{
            border: solid 1px #cccccc;
            background-color: rgb(216, 26, 26);
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .myCard .card-body,.secondCard .card-body {
            padding: 20px;
        }

        label {
            padding: 10px;
            width: 100px;

        }

        label,
        input,
        span {
            float: left;
        }

        input[type='date'] {
            padding: 0px;
            width: 150px;
            text-align: center;
        }

        input[type='button'] {
            margin-left: 30px;
        }

        .error {
            border-color: red;
        }

        .form-group {
            border: solid;
        }

        .card-title h4 {
            text-align: center;
        }
        .secondCard .card-title {
            background-color:darkred;
        }
        .secondCard .btn-danger {
            background-color:darkred;
        }
          
    </style>
</head>

<body>
    <div class="container-fluid">

        <?php require("header.php"); ?>
        <!-- left menus -->

        <div class="row">
            <?php require("left-menus.php");?>
            <!-- right contents -->
            <div class="col-lg-10 col-md-9 col-sm-8 second-column">
                <div class="row">
                    <div class="card myCard col-lg-10">
                        <div class="card-title">
                            <h4>Generate General Report</h4>
                        </div>
                        <div class="card-body">

                            <form>
                                <label for="startdate" class="element ">Start Date</label>
                                <input type="date" id="startdate" class="form-control">
                                <label style="padding-left:30px;">To</label>
                                <label for="startdate" class="element">End Date</label>
                                <input type="date" id="enddate" class="form-control">
                                <input type="button" class="btn btn-danger generatebutton" onclick="generateReport()" value="Generate">
                            </form>
                        </div>
                    </div>
                </div>
                <br><br>
                 <!-- right contents -->
               <div class="row">
                    <div class="card secondCard col-lg-10">
                        <div class="card-title">
                            <h4>Generate Applicants Report</h4>
                        </div>
                        <div class="card-body">

                            <form>
                                <label for="startdate2" class="element ">Start Date</label>
                                <input type="date" id="startdate2" class="form-control">
                                <label style="padding-left:30px;">To</label>
                                <label for="enddate2" class="element">End Date</label>
                                <input type="date" id="enddate2" class="form-control">
                                <input type="button" class="btn btn-danger generateApplicantReport" onclick="generateApplicantReport()" value="Generate">
                            </form>
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
        function generateApplicantReport(){
            var s = $('#startdate2');
            var e = $('#enddate2');
            s.removeClass('error');
            e.removeClass('error');
            if (s.val() == '')
                s.addClass('error');
            else if (e.val() == '')
                e.addClass('error');
            else
                window.open('applicantReport.php?s=' + s.val() + '&e=' + e.val());
        }
        function generateReport() {
            var s = $('#startdate');
            var e = $('#enddate');
            s.removeClass('error');
            e.removeClass('error');
            if (s.val() == '')
                s.addClass('error');
            else if (e.val() == '')
                e.addClass('error');
            else
                window.open('generalReport.php?s=' + s.val() + '&e=' + e.val(), '_blank ');
        }

    </script>
</body>

</html>

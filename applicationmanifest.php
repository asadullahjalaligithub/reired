<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";

require ($documentroot . "login-authentication.php");
if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'view') {
    header('location:index.php?logout=true');
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require ($documentroot . "header-links.php"); ?>
    <style>
        .card {
            border: solid 1px #cccccc;
            padding: 10px;
            border-radius: 5px;
        }

        .card-title {
            border: solid 1px #cccccc;
            background-color: #317BB9;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .card-body {
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
            width: 150px;
            padding: 0px;
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
                <div class="row">
                    <div class="card col-lg-10">
                        <div class="card-title">
                            <h4>Generate Report</h4>
                        </div>
                        <div class="card-body">


                            <label for="startdate" class="element">Start Date</label>
                            <input type="date" id="startdate" class="form-control">
                            <label style="padding-left:30px;">To</label>
                            <label for="startdate" class="element">End Date</label>
                            <input type="date" id="enddate" class="form-control">
                            <input type="button" class="btn btn-primary" onclick="generateReport()" value="Generate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php require ($documentroot . "footer.php"); ?>

    </div>

    <!-- the last bootstrap file-->
    <?php require ($documentroot . "footer-links.php"); ?>
    <script>
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
                window.open('manifestReport.php?s=' + s.val() + '&e=' + e.val(), '_blank ');
        }

    </script>
</body>

</html>
<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require $documentroot . "login-authentication.php";
require $documentroot . "Database.php";

?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require $documentroot . "header-links.php"; ?>
    <style>
        .paid {
            color: green;
            font-weight: bold;
        }

        .due {
            color: red;
            font-weight: bold;
        }

        .total {
            color: blue;
            font-weight: bold;
        }

        .survey {
            margin-top: 100px;
        }

        * {
            box-sizing: border-box;
        }

        .box {
            border-radius: 10px;
            padding: 20px;
            width: 30%;
            margin-left: 10px;
            float: left;
            box-shadow: 1px 1px 5px gray;
        }

        .title {
            color: red;
            font-weight: bold;
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

                <h1 align="center"> Welcome to <span style="color:blue; font-weight:bold;">REI</span><span
                        style="color:red;font-weight:bold;">RED</span> Toursim Services</h1>
                <div class="row survey">
                    <?php
                    $query = "select count(DISTINCT application_Invoice_no) from application where application_entrydate=current_date() and application_feestatus='paid';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result);
                    $paidinvoice = $row[0];

                    $query = "select count(DISTINCT application_Invoice_no) from application where application_entrydate=current_date() and application_feestatus='due';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result);
                    $dueinvoice = $row[0];
                    $totalinvoice = $paidinvoice + $dueinvoice;

                    $query = "select * from application where application_entrydate>=current_date()";
                    $result = mysqli_query($connection, $query);
                    $damount = 0;
                    $pamount = 0;
                    $paidcount = 0;
                    $duecount = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        // $invoicecount++;
                        if ($row['application_feestatus'] == 'due') {
                            $damount += $row['application_TVACcharges'] + $row['application_embassycharges'];
                            $duecount++;
                        }
                        if ($row['application_feestatus'] == 'paid') {
                            $pamount += $row['application_TVACcharges'] + $row['application_embassycharges'];
                            $paidcount++;
                        }
                    }
                    ?>
                    <div class="box ">
                        <table class="table table-stripped table-bordered">
                            <tr>
                                <th colspan="3" class="title">Today's Invoice</th>
                            </tr>
                            <tr>
                                <th>Invoice</th>
                                <th>Count</th>
                                <th>Amount</th>
                            </tr>
                            <tr class="paid">
                                <td>Paid</td>
                                <td><?php echo $paidinvoice; ?></td>
                                <td><?php echo $pamount; ?></td>
                            </tr>
                            <tr class="due">
                                <td>Due</td>
                                <td><?php echo $dueinvoice ?></td>
                                <td><?php echo $damount; ?></td>
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <td><?php echo $totalinvoice; ?></td>
                                <td><?php echo $pamount + $damount; ?></td>
                            </tr>
                        </table>
                    </div> <?php
                    $query = "select count(DISTINCT application_Invoice_no) from application where application_entrydate>=(current_date()-7) and application_feestatus='paid';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result);
                    $paidinvoice = $row[0];

                    $query = "select count(DISTINCT application_Invoice_no) from application where application_entrydate>=current_date()-7 and application_feestatus='due';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result);
                    $dueinvoice = $row[0];
                    $totalinvoice = $paidinvoice + $dueinvoice;
                    $query = "select * from application where application_entrydate>=current_date()-7";
                    $result = mysqli_query($connection, $query);
                    $damount = 0;
                    $pamount = 0;
                    //    $invoicecount=0;
                    $paidcount = 0;
                    $duecount = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        //  $invoicecount++;
                        if ($row['application_feestatus'] == 'due') {
                            $damount += $row['application_TVACcharges'] + $row['application_embassycharges'];
                            $duecount++;
                        }
                        if ($row['application_feestatus'] == 'paid') {
                            $pamount += $row['application_TVACcharges'] + $row['application_embassycharges'];
                            $paidcount++;
                        }
                    }
                    ?>
                    <div class="box">
                        <table class="table table-stripped table-bordered">
                            <tr>
                                <th colspan="3" class="title">Last 7 day's Invoice</th>
                            </tr>
                            <tr>
                                <th>Invoice</th>
                                <th>Count</th>
                                <th>Amount</th>
                            </tr>
                            <tr class="paid">
                                <td>Paid</td>
                                <td><?php echo $paidinvoice; ?></td>
                                <td><?php echo $pamount; ?></td>
                            </tr>
                            <tr class="due">
                                <td>Due</td>
                                <td><?php echo $dueinvoice; ?></td>
                                <td><?php echo $damount; ?></td>
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <td><?php echo $totalinvoice ?></td>
                                <td><?php echo $pamount + $damount; ?></td>
                            </tr>
                        </table>
                    </div> <?php
                    $query = "select count(DISTINCT application_Invoice_no) from application where application_entrydate>=current_date()-30 and application_feestatus='paid';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result);
                    $paidinvoice = $row[0];

                    $query = "select count(DISTINCT application_Invoice_no) from application where application_entrydate>=current_date()-30 and application_feestatus='due';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($result);
                    $dueinvoice = $row[0];
                    $totalinvoice = $paidinvoice + $dueinvoice;
                    $query = "select * from application where application_entrydate>=current_date()-30";
                    $result = mysqli_query($connection, $query);
                    $damount = 0;
                    $pamount = 0;
                    // $invoicecount=0;
                    $paidcount = 0;
                    $duecount = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        // $invoicecount++;
                        if ($row['application_feestatus'] == 'due') {
                            $damount += $row['application_TVACcharges'] + $row['application_embassycharges'];
                            $duecount++;
                        }
                        if ($row['application_feestatus'] == 'paid') {
                            $pamount += $row['application_TVACcharges'] + $row['application_embassycharges'];
                            $paidcount++;
                        }
                    }
                    ?>
                    <div class="box">
                        <table class="table table-stripped table-bordered">
                            <tr>
                                <th colspan="3" class="title">Last 30 day's Invoice</th>
                            </tr>
                            <tr>
                                <th>Invoice</th>
                                <th>Count</th>
                                <th>Amount</th>
                            </tr>
                            <tr class="paid">
                                <td>Paid</td>
                                <td><?php echo $paidinvoice; ?></td>
                                <td><?php echo $pamount; ?></td>
                            </tr>
                            <tr class="due">
                                <td>Due</td>
                                <td><?php echo $dueinvoice; ?></td>
                                <td><?php echo $damount; ?></td>
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <td><?php echo $totalinvoice ?></td>
                                <td><?php echo $pamount + $damount; ?></td>
                            </tr>
                        </table>
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

    </script>
</body>

</html>
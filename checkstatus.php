<?php

$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
require ($documentroot . "login-authentication.php");

if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'finance') {
    header("location:index.php?logout=true");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require ($documentroot . "header-links.php"); ?>
    <style>
        h4 {
            color: white;
            border-radius: 5px;
            padding: 10px;
            background-color: #317BB9;
        }

        .error {
            border-color: red;
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

                <div class="row col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Check Invoice Status</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-lg-7">
                                        <input type="text" id="invoiceno" class="form-control"
                                            placeholder="Invoice Number">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="button" class="btn btn-primary" value="check"
                                            onclick="viewStatus()">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Invoice Date</th>
                                <th>Customer Name</th>
                                <th>User</th>
                                <th>Application Status</th>
                                <th>Charges</th>
                                <th>Fee Status</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                    </table>
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
    <script>
        function viewStatus() {
            var invoiceno = document.getElementById('invoiceno');
            invoiceno.classList.remove('error');
            if (invoiceno.value == '')
                invoiceno.classList.add('error');
            else
                $.ajax({
                    url: 'checkslip.php',
                    type: 'POST',
                    data: {
                        invoiceno: invoiceno.value,
                        actionString: "checkInvoice"
                    },
                    success: function (response) {
                        if (response.trim() == 'false') {
                            $('#myModal').modal('show');
                            $('#modal-body').text("No Recrods for this Invoice Number");
                        } else {
                            //   window.open("printSlip.php?filename=" + invoiceno.value, '_blank');
                            $('#result').html(response);
                        }
                    }
                });
        }

    </script>
</body>

</html>
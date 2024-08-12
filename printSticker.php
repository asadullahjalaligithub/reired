<?php require("login-authentication.php") ;

if($_SESSION['role']=='user' || $_SESSION['role']=='finance') {
    header("location:index.php?logout=true");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require("header-links.php"); ?>
    <style>
      .card-header  h3 {
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

        <?php require("header.php"); ?>
        <!-- left menus -->

        <div class="row">
            <?php require("left-menus.php");?>
            <!-- right contents -->
            <div class="col-lg-10 col-md-9 col-sm-8 second-column">

                <div class="row col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h3> print slip</h3>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="form-group col-lg-7">
                                        <input type="text" id="invoiceno" class="form-control" placeholder="Invoice Number">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="button" class="btn btn-primary" value="Generate"  onclick="generateSlip()">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title bg-warning text-danger" id="exampleModalLabel" id="modal-title">Message</span>
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
        <?php require("footer.php"); ?>

    </div>

    <!-- the last bootstrap file-->
    <?php require("footer-links.php"); ?>
    <script>
        $(document).ready(function(){
            $('#invoiceno').keypress(function(e){
            if(e.keyCode==13)
            {
                generateSlip();
            }
            });
        });
        function generateSlip() {
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
                    success: function(response) {
                        if (response.trim() == 'false') {
                            $('#myModal').modal('show');
                            $('#modal-body').text("No Recrods for this Invoice Number");
                        } else {
                            window.open("printSlip.php?filename=" + invoiceno.value, '_blank');
                        }
                    }
                });
        }

    </script>
</body>

</html>

<?php


$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";

require ($documentroot . "login-authentication.php");
if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'view' || $_SESSION['role'] == 'finance') {
    header('location:index.php?logout=true');
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require ($documentroot . "header-links.php"); ?>
    <style>
        .myCard,
        .secondCard {
            border: solid 1px #cccccc;
            padding: 10px;
            border-radius: 5px;
        }

        .myCard .card-title,
        .secondCard .card-title {
            border: solid 1px #cccccc;
            background-color: green;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .myCard .card-body,
        .secondCard .card-body {
            padding: 20px;
        }



        .error {
            border-color: red;
        }

        .form-group {
            border: solid;
        }

        h4 {
            font-size: 20px;
            text-align: justify;
            line-height: 30px;
        }


        label {
            display: block;
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
                    <div class="card myCard col-lg-10 ">
                        <div class="card-title first-title">
                            <h2 class="text-center">Download Biometric</h2 class="text-center">
                        </div>
                        <div class="card-body">

                            <form>
                                <label for="downloadButton">
                                    <h4>You can download all the available biometric data after pressing the below
                                        Button, you can find the downloaded xml files in
                                        C:\xampp\htdocs\reired\downloadBiometric\download directory.</h4>
                                </label>
                                <input type="button" id="downloadButton"
                                    class="btn btn-success  btn-lg downloadBiometricButton"
                                    onclick="downloadBiometric()" value="Generate">
                            </form>
                        </div>
                    </div>
                </div>
                <br><br>
                <!-- right contents -->
                <div class="row">
                    <div class="card myCard col-lg-10 ">
                        <div class="card-title" style="background-color:darkred;">
                            <h2 class="text-center">Biometric Deletion</h2 class="text-center">
                        </div>
                        <div class="card-body">

                            <form>
                                <label for="de">
                                    <h4>You can delete all the biometric data from you biometric data based by clicking
                                        the below button.<br>
                                        Warning: Be carefull to first download the biometric using the above button
                                        because once data deleted can not be recovered!</h4>
                                </label>
                                <input type="button" id="downloadButton" class="btn btn-danger  btn-lg deleteButton"
                                    value="Delete">
                            </form>
                        </div>
                    </div>
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
                        <h4>Have you downloaded your biometric Data?</h4>
                        <h4>Are you Sure you want to delete the biometric data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning deleteBiometricButton">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <h4>Your Biometric Data successfully donwloaded.</h4>
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
        function downloadBiometric() {
            window.open('downloadAllBiometric/BiometricDownload.php');
        }

        $(document).ready(function () {

            $('.deleteButton').click(function () {
                $('#myModal').modal('show');
            });

            $(".deleteBiometricButton").click(function () {
                $.ajax({
                    url: 'deleteBiometric-php.php',
                    type: 'post',
                    data: {
                        actionString: 'deleteBiometricData'
                    },
                    success: function (response) {
                        if (response == 'true') {
                            $('#myModal').modal('hide');
                            $('#messageModal').modal('show');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
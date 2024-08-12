<?php


if (isset($_GET['logout']) && $_GET['logout'] == true) {
    session_start();
    session_unset();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->
    <?php require ("header-links.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
    <style>
        .container-fluid {
            min-height: 700px;
        }
    </style>

</head>

<body>
    <div class="container-fluid">

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->

                <!-- Icon -->
                <div class="fadeIn first">
                    <img src="images/smalllogo.jpg" style="width:30%" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form method="post" action="<?php $_PHP_SELF; ?>">
                    <input type="text" id="login" required class="fadeIn second" name="username" placeholder="login">
                    <input type="password" id="password" required class="fadeIn third" name="password"
                        placeholder="password">
                    <input type="button" class="fadeIn fourth" onclick="checkUser();" name="loginbutton"
                        id="loginbutton" value="login">
                </form>
                <div id="result">

                </div>
                <!-- Remind Passowrd 
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>
-->
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="btn btn-primary">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Wrong Username Or Password
                    </div>

                </div>
            </div>
        </div>
        <!-- footer -->
        <?php require ("footer.php"); ?>
        <?php require ("footer-links.php"); ?>
    </div>

    <!-- the last bootstrap file-->

    <script>

        var username = document.getElementById("login");
        var password = document.getElementById("password");
        var actionString = document.getElementById("loginbutton");
        function checkUser() {
            $.ajax({
                url: 'checkuser.php',
                type: 'POST',
                data: {
                    username: username.value,
                    password: password.value,
                    actionString: actionString.value
                },
                success: function (response) {
                    console.log('Response:', response);
                    if (response.trim() == 'false') {
                        $('#myModal').modal('show');
                        $('#myModal').on('hidden.bs.modal', function (e) {
                            username.value = "";
                            password.value = "";
                        })
                    } else if (response.trim() == 'true') {
                        window.location.replace("dashboard.php");
                    }
                }
            });
        }


    </script>

</body>

</html>
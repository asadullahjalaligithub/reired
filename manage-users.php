<?php

require ("login-authentication.php");
if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'finance') {
    header('location:index.php?logout=true');
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->

    <?php require ("header-links.php"); ?>
    <style>
        table th,
        table td {
            font-weight: 500;
            font-size: 15px;
            text-align: center;
        }

        #close-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .error {
            border-color: red;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php require ("header.php"); ?>
        <!-- left menus -->
        <div class="row">
            <?php require ("left-menus.php"); ?>
            <!-- right contents -->
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-2">
                        <input type="button" class="btn btn-primary" id="addNewUser" value="Add New User">
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>username</th>
                                <th>full name</th>
                                <th>password</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userResult">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="modal fade" id="userUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 style="text-align:center;" class="modal-title" id="exampleModalLabel">Add User</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" id="close-button">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" id="userUpdateForm">
                                <div class="form-group col-lg-3">

                                    <input type="text" id="newUsername" disabled class="form-control">
                                </div>
                                <div class="form-group col-lg-3">
                                    <input type="text" id="newPassword" class="form-control" placeholder="password">
                                </div>
                                <div class="form-group col-lg-3">
                                    <input type="text" id="newFullname" class="form-control" placeholder="fullname">
                                </div>

                                <button type="button" class="btn btn-primary" id="updateUser">Update</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 style="text-align:center;" class="modal-title" id="exampleModalLabel">Add User</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" id="close-button">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" id="userform">
                                <div class="form-group col-lg-3">
                                    <input type="text" id="username" class="form-control" placeholder="username">
                                </div>
                                <div class="form-group col-lg-3">
                                    <input type="text" id="password" class="form-control" placeholder="password">
                                </div>
                                <div class="form-group col-lg-3">
                                    <input type="text" id="fullname" class="form-control" placeholder="fullname">
                                </div>
                                <div class="form-group col-lg-2">
                                    <select class="form-control" id="role">
                                        <option value="01">Admin</option>
                                        <option value="02">User</option>
                                        <option value="04">Finance</option>
                                        <option value="03">View</option>
                                    </select>
                                </div>

                                <button type="button" class="btn btn-primary" id="saveUser">Save</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php require ("footer.php"); ?>
    </div>
    <!-- the last bootstrap file-->
    <?php require ("footer-links.php"); ?>
    <script>
        $(document).ready(function () {
            // Editing a user
            $('#userResult').on('click', '.editUser', function () {
                $('#userUpdateModal').modal('show');
                $('#newUsername').val($(this).attr('id'));

            });
            $('#updateUser').on('click', function () {
                var username = $('#newUsername');
                var password = $('#newPassword');
                var fullname = $('#newFullname');
                $('#userUpdateForm').find("input").each(function () {
                    $(this).removeClass('error');
                });
                if (password.val().trim() == "")
                    password.addClass('error');
                else if (fullname.val().trim() == "")
                    fullname.addClass("error");
                else $('#userResult').load("manage-users-php.php", {
                    username: username.val(),
                    password: password.val(),
                    fullname: fullname.val(),
                    actionString: 'updateUser'
                },
                    function (response, status, xhr) {
                        if (response.trim() == 'true') {
                            $('#userUpdateForm').trigger('reset');
                            $('#userUpdateModal').modal('hide');
                            $('#userResult').load('manage-users-php.php');
                        }
                    }
                );
            });


            // loading users
            $('#userResult').load('manage-users-php.php');


            // add new user modal display
            $('#addNewUser').on('click', function () {
                $('#usermodal').modal('show');
            });

            // save button request of add new user modal
            $('#saveUser').on('click', function () {
                var username = $('#username');
                var password = $('#password');
                var fullname = $('#fullname');
                var role = $('#role').find(":selected");
                $('#userform').find("input").each(function () {
                    $(this).removeClass('error');
                });
                if (username.val().trim() == "")
                    username.addClass('error');
                else if (password.val().trim() == "")
                    password.addClass('error');
                else if (fullname.val().trim() == "")
                    fullname.addClass("error");
                else
                    $('#userResult').load("manage-users-php.php", {
                        username: username.val(),
                        password: password.val(),
                        fullname: fullname.val(),
                        role: role.val(),
                        actionString: 'createUser'
                    },
                        function (response, status, xhr) {
                            if (response.trim() == 'false') {
                                $('#userform').trigger('reset');
                                $('#usermodal').modal('hide');
                                $('#myModal').modal('show');
                                $('#modal-body').text("Duplicate Username are not Allowed");
                                $("#userResult").load('manage-users-php.php');
                            } else if (response.trim() == 'true') {
                                $('#userform').trigger('reset');
                                $('#usermodal').modal('hide');
                                $('#userResult').load('manage-users-php.php');
                            }
                        });

            });
        });

    </script>
</body>

</html>
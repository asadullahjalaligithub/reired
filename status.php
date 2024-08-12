<?php


require ("login-authentication.php");
include ("Database.php");
$role = $_SESSION['role'];
$results = mysqli_query($connection, "select count(*) from view1 ");
$get_total_rows = mysqli_fetch_array($results); //total records

//break total records into pages
$pages = ceil($get_total_rows[0] / $record_per_page);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- header files of javascript -->

    <?php require ("header-links.php"); ?>
    <style>
        .approverejecttable tr td,
        .approverejecttable tr th {
            width: 100px;
        }

        .paid {
            color: green;
        }

        .due {
            color: red;
        }

        .action-buttons {
            text-align: center;
        }

        .action-buttons .btn {
            margin-top: 3px;
        }

        #close-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .error {
            border-color: red;
        }

        tr.background {
            transition: background-color 0.05s ease-in-out;
        }

        input[type='date'] {
            width: 150px;
            padding: 0px;
            text-align: center;
        }

        input[type='checkbox'] {
            border: solid 1px #cccccc;
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
            <div class="col-lg-10 col-md-9 col-sm-8 second-column">
                <div class="row">
                    <?php if ($role == 'finance' || $role == 'admin') { ?>
                        <button class="btn btn-success" id="markpaid">Mark as Paid</button>



                        <button class="btn btn-warning" id="markdue">Mark as Due</button>
                    <?php }

                    if ($role == 'admin') { ?>
                        <button class="btn btn-danger" id="delete">Delete</button>

                        <button class="btn btn-info" id="sendtoconsulate">Send to Consulate</button>

                        <button class="btn btn-info" id="recievedfromconsulate">Recieved from Consulate</button>
                    <?php } ?>
                    <button class="btn btn-info" id="deliveredtocustomer">Delivered to Customer</button>

                </div>
                <table class="table  table-hover">
                    <thead>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>InvoiceNo</th>
                            <th>InvoiceDate</th>
                            <th>ApplicantName</th>
                            <th>Entry By</th>
                            <th>Application Status</th>
                            <th>Charges</th>
                            <th>Fee Status</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                        <tr>

                            <td>
                                <input type="checkbox" id="checkAll">
                            </td>
                            <td width="20px">
                                <input type="text" id="invoicenumber" class="form-control">
                            </td>
                            <td>
                                <input type="date" class="form-control" value='yyyy-mm-dd' id="datepicker">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="firstname">
                            </td>
                            <td>
                                <select id="userlist" class="form-control">
                                    <option selected>--select user--</option>
                                    <?php
                                    $result = mysqli_query($connection, "select userinfo_username from userinfo");
                                    while ($row = mysqli_fetch_array($result))
                                        echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="results">

                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                    </ul>
                </nav>
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

            <div class="modal fade" id="approveRejectModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 style="text-align:center;" class="modal-title" id="exampleModalLabel">Approved/Reject
                                Applications</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" id="close-button">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <!-- Confirm dialog box -->
            <div class="modal fade" id="deleteconfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel" style="color:red">Warning</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you Sure to delete the record, after deletion you won't be able to retrive the data of
                            the concerned invoice number!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="yesbutton" value="yes">Yes</button>
                            <button type="button" class="btn btn-info" id="nobutton" value="no">No</button>
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
        var page_number = "1";
        var actionString = "default";
        var user = "";
        var firstname = "";
        var date = "";
        var searchinvoicenumber = "";
        // automatic refereshng the page in two minutes
        $(document).ready(function () {
            var usertype = '<?php echo $_SESSION["role"]; ?>';
            if (usertype == 'user' || usertype == 'finance') {
                setTimeout(function () {
                    location = 'status.php'
                }, 60000);
            }
            //  console.log($(document).find('tr').length);
            // search based on invoice date
            $('#datepicker').on('change', function () {

                if ($(this).val() == '') {
                    $("#results").load('status-php.php');
                } else {
                    actionString = "searchDate";
                    date = $(this).val();
                    $("#results").load("status-php.php", {
                        'page': 1,
                        'date': $(this).val(),
                        'actionString': 'searchDate'
                    }, function (response, status, xhr) {
                        if (response.trim() == 'false') {
                            $('#myModal').modal('show');
                            $('#modal-body').text("No Record Found for this Date");
                            actionString = "default";
                            $("#results").load('status-php.php', {
                                'actionString': "default"
                            });
                        }
                    });
                }
            });

            // search based on user
            $('#userlist').on('change', function (event) {
                var selectedVal = $(this).find(':selected').val();
                var selectedText = $(this).find(':selected').text();
                if (selectedText == '--select user--') {
                    $("#results").load('status-php.php');
                } else {
                    actionString = "searchUser";
                    user = selectedVal;
                    $("#results").load("status-php.php", {
                        'page': 1,
                        'user': selectedVal,
                        'actionString': 'searchUser'
                    }, function (response, status, xhr) {
                        if (response.trim() == 'false') {
                            $('#myModal').modal('show');
                            $('#modal-body').text("No Record Found for this user");
                            actionString = "default";
                            $("#results").load('status-php.php', {
                                'actionString': "default"
                            });
                        }
                    });

                }
            });
            // search based on invoice numbernumber
            $('#invoicenumber').on('keyup', function (event) {
                $(this).removeClass('error');
                if (event.keyCode === 8) {
                    if ($(this).val().trim() == "") {
                        $("#results").load('status-php.php');
                    }
                } else if (event.keyCode === 13) {
                    event.preventDefault();
                    if ($(this).val().trim() == "") {
                        $(this).addClass('error');
                        $('#myModal').modal('show');
                        $('#modal-body').text("Please enter an invoice number");
                    } else {
                        searchinvoicenumber = $(this).val();
                        actionString = "searchInvoiceNumber";
                        $("#results").load("status-php.php", {
                            'page': 1,
                            'invoicenumber': $(this).val(),
                            'actionString': 'searchInvoiceNumber'
                        }, function (response, status, xhr) {
                            if (response.trim() == 'false') {
                                $('#myModal').modal('show');
                                actionString = "default";
                                $('#modal-body').text("No Record Found with this keyword");
                                $("#results").load('status-php.php', {
                                    'actionString': "default"
                                });
                            }
                        });
                        /*   $.ajax({
                               type: 'post',
                               url: 'status-php.php',
                               data: {
                                   firstname: $(this).val(),
                                   actionString: 'searchFirstname'
                               },
                               success: function(response) {
                                   $('#result').html(response);
                               }

                           });*/
                    }
                }
            });
            // search based on firstname
            $('#firstname').on('keyup', function (event) {
                $(this).removeClass('error');
                if (event.keyCode === 8) {
                    if ($(this).val().trim() == "") {
                        $("#results").load('status-php.php');
                    }
                } else if (event.keyCode === 13) {
                    event.preventDefault();
                    if ($(this).val().trim() == "") {
                        $(this).addClass('error');
                        $('#myModal').modal('show');
                        $('#modal-body').text("Please enter a name");
                    } else {
                        actionString = "searchFirstname";
                        firstname = $(this).val();
                        $("#results").load("status-php.php", {
                            'page': 1,
                            'firstname': $(this).val(),
                            'actionString': 'searchFirstname'
                        }, function (response, status, xhr) {
                            if (response.trim() == 'false') {
                                $('#myModal').modal('show');
                                $('#modal-body').text("No Record Found with this keyword");
                                actionString = "default";
                                $("#results").load('status-php.php', {
                                    'actionString': "default"
                                });
                            }
                        });
                        /*   $.ajax({
                               type: 'post',
                               url: 'status-php.php',
                               data: {
                                   firstname: $(this).val(),
                                   actionString: 'searchFirstname'
                               },
                               success: function(response) {
                                   $('#result').html(response);
                               }

                           });*/
                    }
                }
            });
            // print slip dyanimc model
            /*  $(document).on('click', '.printSlip', function() {
                  $.ajax({
                      type: 'post',
                      url: 'status-php2.php',
                      data: {
                          invoiceno: $(this).attr('value'),
                          actionString: 'printSlipApplication'
                      },
                      success: function(response) {
                          $('#approveRejectModal').modal('show');
                          $('#approveRejectModal').find('.modal-body').html(response);
                      }

                  });

              });*/
            // aprove reject dynamic modal
            $(document).on('click', '.approveRejectButton', function () {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceno: $(this).attr('value'),
                        actionString: 'approveRejectApplication'
                    },
                    success: function (response) {
                        $('#approveRejectModal').modal('show');
                        $('#approveRejectModal').find('.modal-body').html(response);
                    }

                });

            });
            // adding rejections remarks button ajax request
            $("#approveRejectModal").on('click', '.rejectButton', function (event) {
                var application_no = $(this).attr('id');
                //  var currentRow = $(this).parents('tr.background');
                var inputbox = $(this).parents('form:first').find('.rejectreason');
                // inputbox.removeClass('error');
                var invoiceno = $(this).parents('form:first').find('.invoiceno');
                // if (inputbox.val().trim() == "")
                //     inputbox.addClass('error');
                // else
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        application_no: application_no,
                        remark: inputbox.val(),
                        invoiceno: invoiceno.val(),
                        actionString: 'InsertRejectReason'
                    },
                    success: function (response) {
                        //   if (response.trim() == "true") {
                        inputbox.prop('disabled', true);
                        $('#approveRejectModal').find('.modal-body').html(response);
                        // } else {
                        //   $('#approveRejectModal').find('.modal-body').html("<h3>Duplicate  Reference Number not Allowed</h3>");
                        //   }

                    }

                });

            });
            // approving an application ajax request
            $(document).on('click', '.approveButton', function () {
                var application_no = $(this).attr('id');
                //  var currentRow = $(this).parents('tr.background');
                //  var inputbox = $(this).parents('form:first').find('.rejectreason');
                //   inputbox.removeClass('error');
                var invoiceno = $(this).parents('form:first').find('.invoiceno');
                //   if (inputbox.val().trim() == "")
                //      inputbox.addClass('error');
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceno: invoiceno.val(),
                        application_no: $(this).attr('id'),
                        actionString: 'approveApplication'
                    },
                    success: function (response) {
                        $('#approveRejectModal').find('.modal-body').html(response);
                    }

                });

            });
            // rejecting an application ajax request
            /*       $(document).on('click', '.rejectButton', function() {

                       $.ajax({
                           type: 'post',
                           url: 'status-php2.php',
                           data: {
                               invoice_no: $(this).attr('value'),
                               application_no: $(this).attr('id'),
                               actionString: 'rejectApplication'
                           },
                           success: function(response) {
                               $('#approveRejectModal').find('.modal-body').html(response);
                           }

                       });

                   });*/
            // view button ajax request
            $(document).on('click', '.viewButton', function () {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceno: $(this).attr('value'),
                        actionString: 'viewApplication'
                    },
                    success: function (response) {
                        $('#approveRejectModal').modal('show');
                        $('#approveRejectModal').find('h3').html("View Invoice Contents");
                        $('#approveRejectModal').find('.modal-body').html(response);
                    }

                });

            });
            $(document).on('click', '.xmlButton', function () {

                var passportnumber = $(this).attr('value')
                window.location.replace("final_xml.php?passportnumber=" + passportnumber);

            });
            // update Reference number modal load ajax request
            /*
                        $(document).on('click', '.updateReferenceNo', function() {
                            $.ajax({
                                type: 'post',
                                url: 'status-php2.php',
                                data: {
                                    invoiceno: $(this).attr('value'),
                                    actionString: 'updateApplicationReferenceNos'
                                },
                                success: function(response) {
                                    $('#approveRejectModal').modal('show');
                                    $('#approveRejectModal').find('.modal-body').html(response);
                                }

                            });

                        });*/

            $("#results").load("status-php.php"); //initial page number to load
            $(".pagination").bootpag({
                total: <?= $pages ?>,
                page: 1,
                maxVisible: 6,
                leaps: true,
                firstLastUse: true,
                first: '←',
                last: '→',
                wrapClass: 'pagination',
                activeClass: 'active',
                disabledClass: 'disabled',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last',
                firstClass: 'first'
            }).on("page", function (e, num) {
                e.preventDefault();
                //   $("#results").prepend('<div class="loading-indication"><img src="images/ajax-loader.gif" /> Loading...</div>');
                page_number = num;
                $("#results").load("status-php.php", {
                    'page': num,
                    'actionString': actionString,
                    'user': user,
                    'firstname': firstname,
                    'date': date,
                    'invoicenumber': searchinvoicenumber
                });
            });


            $('#checkAll').click(function () {
                if (this.checked) {
                    $('.checkboxes').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkboxes').each(function () {
                        this.checked = false;
                    });
                }
            });

            // mark paid ajax request
            $('#markpaid').click(function () {
                var invoiceArray = new Array();
                if ($('input:checkbox:checked').length > 0) {

                    $('input:checkbox:checked').each(function () {
                        invoiceArray.push($(this).attr('id'));

                    });
                    sendMarkPaid(invoiceArray);

                } else {
                    $('#myModal').modal('show');
                    $('#modal-body').text("Please Select invoice numbers");
                }
            });
            function markPaidSms(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'sms.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'markPaidSms'
                    },
                    success: function (response) {
                        if (response.trim() != 'true') {
                            //  $('#myModal').modal('show');
                            // $('#modal-body').text("Cant send SMS to the Client, it seems there is a problem with the phone number");
                        }
                    }
                });
            }
            function markPaidEmail(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'email.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'markPaidEmail'
                    },
                    success: function (response) {
                        if (response.trim() != 'true') {
                            //  $('#myModal').modal('show');
                            // $('#modal-body').text("Cant send SMS to the Client, it seems there is a problem with the phone number");
                        }
                    }
                });
            }
            function sendMarkPaid(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'markPaid'
                    },
                    success: function (response) {
                        if (response.trim() == "true") {
                            markPaidSms(invoiceArray);
                            markPaidEmail(invoiceArray);
                            $("#results").load("status-php.php", {
                                'page': page_number,
                                'actionString': actionString,
                                'user': user,
                                'date': date,
                                'invoicenumber': searchinvoicenumber,
                                'firstname': firstname
                            });
                        } // else {
                        //   $('#myModal').modal('show');
                        //   $('#modal-body').text("Please Update the Reference Number");
                        //   $("#results").load("status-php.php", {
                        //       'page': page_number
                        //   });
                        //  }
                    }
                });
            }
            // markdue ajax request
            $('#markdue').click(function () {
                var invoiceArray = new Array();
                if ($('input:checkbox:checked').length > 0) {

                    $('input:checkbox:checked').each(function () {
                        invoiceArray.push($(this).attr('id'));

                    });
                    sendMarkDue(invoiceArray);

                } else {
                    $('#myModal').modal('show');
                    $('#modal-body').text("Please Select invoice numbers");
                }
            });

            function sendMarkDue(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'markdue'
                    },
                    success: function (response) {
                        if (response.trim() == "true") {
                            $("#results").load("status-php.php", {
                                'page': page_number,
                                'actionString': actionString,
                                'user': user,
                                'date': date,
                                'invoicenumber': searchinvoicenumber,
                                'firstname': firstname
                            });
                        }
                    }
                });
            }
            // delete ajax request
            $('#delete').click(function () {
                var invoiceArray = new Array();
                if ($('input:checkbox:checked').length > 0) {
                    $('input:checkbox:checked').each(function () {
                        invoiceArray.push($(this).attr('id'));
                    });
                    $('#deleteconfirm').modal('show');
                    $('#deleteconfirm').on('click', '#yesbutton', function (e) {
                        $('#deleteconfirm').modal('hide');
                        sendDelete(invoiceArray);
                    })
                    $('#deleteconfirm').on('click', '#nobutton', function (e) {
                        $('#deleteconfirm').modal('hide');
                    })
                } else {
                    $('#myModal').modal('show');
                    $('#modal-body').text("Please Select invoice numbers");
                }
            });

            function sendDelete(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'delete'
                    },
                    success: function (response) {
                        if (response.trim() == "true") {
                            $("#results").load("status-php.php", {
                                'page': page_number,
                                'actionString': actionString,
                                'user': user,
                                'date': date,
                                'invoicenumber': searchinvoicenumber,
                                'firstname': firstname
                            });
                        } else {
                            $('#myModal').modal('show');
                            $('#modal-body').text("Can't Delete a Paid Invoice");
                            $("#results").load("status-php.php", {
                                'page': page_number
                            });
                        }
                    }
                });
            }
            // send to consulate ajax request
            $('#sendtoconsulate').click(function () {
                var invoiceArray = new Array();
                if ($('input:checkbox:checked').length > 0) {

                    $('input:checkbox:checked').each(function () {
                        invoiceArray.push($(this).attr('id'));

                    });
                    sendSendToConsulate(invoiceArray);

                } else {
                    $('#myModal').modal('show');
                    $('#modal-body').text("Please Select invoice numbers");
                }
            });
            function sendToConsulateSms(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'sms.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'sendToConsulateSms'
                    },
                    success: function (response) {
                        if (response.trim() != 'true') {
                            //   $('#myModal').modal('show');
                            // $('#moda-body').text('Failed to send the sms');
                        }
                    }
                });
            }
            function sendToConsulateEmail(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'email.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'sendToConsulateEmail'
                    },
                    success: function (response) {
                        if (response.trim() != 'true') {
                            //   $('#myModal').modal('show');
                            // $('#moda-body').text('Failed to send the sms');
                        }
                    }
                });
            }
            function sendSendToConsulate(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'sendtoconsulate'
                    },
                    success: function (response) {
                        if (response.trim() == "true") {
                            sendToConsulateEmail(invoiceArray);
                            sendToConsulateSms(invoiceArray);
                            $("#results").load("status-php.php", {
                                'page': page_number,
                                'actionString': actionString,
                                'user': user,
                                'date': date,
                                'invoicenumber': searchinvoicenumber,
                                'firstname': firstname
                            });
                        } else {
                            $('#myModal').modal('show');
                            $('#modal-body').text("Cant send due Invoice to Consulate");
                            $("#results").load("status-php.php", {
                                'page': page_number
                            });
                        }
                    }
                });
            }
            // recieved from consulate ajax request
            $('#recievedfromconsulate').click(function () {
                var invoiceArray = new Array();
                if ($('input:checkbox:checked').length > 0) {

                    $('input:checkbox:checked').each(function () {
                        invoiceArray.push($(this).attr('id'));

                    });
                    sendRecieveFromConsulate(invoiceArray);

                } else {
                    $('#myModal').modal('show');
                    $('#modal-body').text("Please Select invoice numbers");
                }
            });

            function receiveFromConsulateSms(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'sms.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'receiveFromConsulateSms'
                    },
                    success: function (response) {
                        if (response.trim() != 'true') {
                            //   $('#myModal').modal('show');
                            // $('#moda-body').text('Failed to send the sms');
                        }
                    }
                });
            }
            function receiveFromConsulateEmail(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'email.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'receiveFromConsulateEmail'
                    },
                    success: function (response) {
                        if (response.trim() != 'true') {
                            //   $('#myModal').modal('show');
                            // $('#moda-body').text('Failed to send the sms');
                        }
                    }
                });
            }

            function sendRecieveFromConsulate(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'recieveFromConsulate'
                    },
                    success: function (response) {
                        if (response.trim() == "true") {
                            receiveFromConsulateEmail(invoiceArray);
                            receiveFromConsulateSms(invoiceArray);
                            $("#results").load("status-php.php", {
                                'page': page_number,
                                'actionString': actionString,
                                'user': user,
                                'date': date,
                                'invoicenumber': searchinvoicenumber,
                                'firstname': firstname
                            });
                        } else if (response.trim() == "false") {
                            $('#myModal').modal('show');
                            $('#modal-body').html("Can't recieve the Application because <ul><li>Maybe the application has not been send to Consulate</li><li>Maybe the application has already been recieved from Consulate</li></ul>");
                        }
                    }
                });
            }
            // delivered to customer ajax request
            $('#deliveredtocustomer').click(function () {
                var invoiceArray = new Array();
                if ($('input:checkbox:checked').length > 0) {

                    $('input:checkbox:checked').each(function () {
                        invoiceArray.push($(this).attr('id'));

                    });
                    sendDeliveredToCustomer(invoiceArray);

                } else {
                    $('#myModal').modal('show');
                    $('#modal-body').text("Please Select invoice numbers");
                }
            });
            function deliverToCustomerEmail(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'email.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'deliverToCustomerEmail'
                    },
                    success: function (response) {
                        if (response.trim() != 'true') {
                            //   $('#myModal').modal('show');
                            // $('#moda-body').text('Failed to send the sms');
                        }
                    }
                });
            }
            function sendDeliveredToCustomer(invoiceArray) {
                $.ajax({
                    type: 'post',
                    url: 'status-php2.php',
                    data: {
                        invoiceArray: invoiceArray,
                        actionString: 'deliveredToCustomer'
                    },
                    success: function (response) {
                        if (response.trim() == "true") {
                            deliverToCustomerEmail(invoiceArray);
                            $("#results").load("status-php.php", {
                                'page': page_number,
                                'actionString': actionString,
                                'user': user,
                                'date': date,
                                'invoicenumber': searchinvoicenumber,
                                'firstname': firstname
                            });
                        } else if (response.trim() == "false") {
                            $('#myModal').modal('show');
                            $('#modal-body').html("Can't Deliver the Application because <br><ul><li>Maybe the application has not been send to Consulate</li><li>Maybe the application has not been recieved from Consulate</li><li>Maybe the Application has already been delivered  to Customer</li></ul>");
                        }
                        /*else if (response.trim() == "false") {
                                            $('#myModal').modal('show');
                                            $('#modal-body').html("Can't Deliver the Application because <br><ul><li>Maybe the application has not been send to Consulate</li><li>Maybe the application has not been recieved from Consulate</li><li>Maybe the Application has already been delivered  to Customer</li></ul>");*/
                    }
                });
            }
        });

    </script>

</body>

</html>
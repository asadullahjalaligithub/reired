<?php 
$role=$_SESSION['role'];
?>
<div class="col-lg-2 col-md-3 col-sm-4 first-column">

    <div class="card left-menus">
        <ul class="list-group list-group-flush">

            <li class="list-group-item"><a href="dashboard.php">DashBoard</a></li>

            <?php if($role=='finance' || $role=='admin' || $role=='user' ) { ?>
            <li class="list-group-item"><a href="Application.php">Application</a></li>
            <li class="list-group-item"><a href="status.php">Status</a></li>
            <?php } 
            if($role=='admin' || $role=='view')
            { ?>
            <li class="list-group-item"><a href="checkstatus.php">Check Status</a></li>
            <?php } if($role=='finance' || $role=='admin'){ ?>
            <li class="list-group-item"><a href="applicationmanifest.php">Application Manifest</a></li>
            <?php } ?>
            <?php if($role=='admin') { ?>
            <li class="list-group-item"><a href="printSticker.php">Print Slip</a></li>
            <li class="list-group-item"><a href="reports.php">Report</a></li>
            <li class="list-group-item"><a href="manage-users.php">Manage Users</a></li>
            <li class="list-group-item"><a href="downloadDelete.php">Biometric Download / Deletion</a></li>
            <?php  } ?>
        </ul>
    </div>
</div>

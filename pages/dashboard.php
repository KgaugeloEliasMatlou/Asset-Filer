<?php
require_once('../include/Db.php');

// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonym ous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../stylesheets/styles.css" />
    <!--<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>-->
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="../js files/jquery.js"></script>
    <title>Dashboard</title>
</head>
<body>
    
<div class="m-0 ">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <div class="container-fluid">
          <h1 class="navbar-brand text-white fw-bold ">Asset Filer <i class="bi bi-folder"></i></h1>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a class="btn btn-outline-light mx-3" href="../forms/add_asset_form.php">New Asset</a>
                    <!--<button class="btn btn-outline-light mx-3" href="../forms/add_asset_form.php">New Asset <i class="bi bi-grid"></i></button>-->
                    <a href="../Authorization/logout.php" class="btn btn-outline-warning">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
</div>

    <div class="container my-3 py-5">
        <div class="container">
            <nav>
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    <button class="nav-link text-primary fw-bold active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">All</button>
                    <button class="nav-link text-primary fw-bold" id="nav-computers-tab" data-bs-toggle="tab" data-bs-target="#nav-computers" type="button" role="tab" aria-controls="nav-computers" aria-selected="false">Computers</button>
                    <button class="nav-link text-primary fw-bold" id="nav-pheripherals-tab" data-bs-toggle="tab" data-bs-target="#nav-pheripherals" type="button" role="tab" aria-controls="nav-pheripherals" aria-selected="false">Pheripherals</button>
                    <button class="nav-link text-primary fw-bold" id="nav-communication_devices-tab" data-bs-toggle="tab" data-bs-target="#nav-communication_devices" type="button" role="tab" aria-controls="nav-communication_devices" aria-selected="false">Communications</button>                    
                    <button class="nav-link text-primary fw-bold" id="nav-office_equip_furniture-tab" data-bs-toggle="tab" data-bs-target="#nav-office_equip_furniture" type="button" role="tab" aria-controls="nav-office_equip_furniture" aria-selected="false">Office Equipments/furniture</button>
                    <button class="nav-link text-primary fw-bold" id="nav-appliances-tab" data-bs-toggle="tab" data-bs-target="#nav-appliances" type="button" role="tab" aria-controls="nav-appliances" aria-selected="false">Appliances</button>
                    <button class="nav-link text-primary fw-bold" id="nav-servers-tab" data-bs-toggle="tab" data-bs-target="#nav-servers" type="button" role="tab" aria-controls="nav-servers" aria-selected="false">Servers</button>
                    <button class="nav-link text-primary fw-bold" id="nav-networkdevices-tab" data-bs-toggle="tab" data-bs-target="#nav-networkdevices" type="button" role="tab" aria-controls="nav-networkdevices" aria-selected="false">Network Devices</button>
                    <button class="nav-link text-primary fw-bold" id="nav-others-tab" data-bs-toggle="tab" data-bs-target="#nav-others" type="button" role="tab" aria-controls="nav-others" aria-selected="false">Others</button>
                </div>
            </nav>
            <div class="tab-content w-auto" id="nav-tabContent">
                <div class="tab-pane fade show active " id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <div class="container my-3">

                        <div class=" container ">
                                    <?php
                                        require('../include/Db.php');
                                        // Attempt select query execution
                                        $sql = "SELECT * FROM assets_management_db.Assets;";
                                        if($result = mysqli_query($mysqlconnect, $sql))
                                        {
                                            if(mysqli_num_rows($result) > 0)
                                            {
                                                    echo '<table id="assettable" class="table table-sm table-striped border rounded border-primary ">';
                                                        echo "<thead class='table-primary'>";
                                                            echo "<tr class='text-primary'>";

                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                            echo "</tr>";
                                                        echo "</thead>";
                                                            echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                            
                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                            echo "</tbody>";
                                                    echo "</table>";
                                                    // Free result set
                                                    mysqli_free_result($result);
                                            }else
                                            {
                                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                            }

                                        }else{
                                            echo "Oops! Something went wrong. Please try again later.";
                                            }
                                            // Close connection
                                            mysqli_close($mysqlconnect);
                                    ?>
        
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-computers" role="tabpanel" aria-labelledby="nav-computers-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM assets_management_db.Assets where a_category IN ('computer box','laptops','all in one computer');";
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable2" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                             

                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-communication_devices" role="tabpanel" aria-labelledby="nav-communication_devices-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM assets_management_db.Assets where a_category IN ('mobile phones','tablet','telephones');";
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable3" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";

                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                                     

                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-pheripherals" role="tabpanel" aria-labelledby="nav-pheripherals-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM assets_management_db.Assets where a_category IN ('display devices','computer pheripherals','cables');";                                   
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable4" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                             

                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-office_equip_furniture" role="tabpanel" aria-labelledby="nav-office_equip_furniture-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM assets_management_db.Assets where a_category IN ('chairs','desks','curtains','drawers','closets','printers');";                                     
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable5" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                            

                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-appliances" role="tabpanel" aria-labelledby="nav-appliances-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM assets_management_db.Assets where a_category IN ('refregirator','kettles','plugs and adapters','aircon');";                                   
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable6" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                             

                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-servers" role="tabpanel" aria-labelledby="nav-servers-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution

                                    $sql = "SELECT * FROM assets_management_db.Assets where a_category IN ('servers');";                                                                     
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable8" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                             
                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-networkdevices" role="tabpanel" aria-labelledby="nav-networkdevices-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM assets_management_db.Assets where a_category IN ('router','switches','network cables');";
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable9" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                             
                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>

                    </div>

                </div>
                <div class="tab-pane fade" id="nav-others" role="tabpanel" aria-labelledby="nav-others-tab">
                    <div class="container my-3">

                        <div class=" container">
                            <?php
                                    require('../include/Db.php');
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM assets_management_db.Assets where not a_category  in ('all in one computer', 'computer box' , 'laptops', 'display devices','computer pheripherals','mobile phones','telephones','printers','servers','switches','cables','chairs','desks','curtains','drawers','closets','refregirator','kettles','aircon','plugs and adapters','truck','bus','private car','van','trailer','network cables');";                                    
                                    if($result = mysqli_query($mysqlconnect, $sql))
                                    {
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                                echo '<table id="assettable10" class="table table-sm table-striped border rounded border-primary ">';
                                                    echo "<thead class='table-primary'>";
                                                        echo "<tr class='text-primary'>";
                                                                echo "<th scope='col'>ID</th>";
                                                                echo "<th scope='col'>Name</th>";
                                                                echo "<th scope='col'>Model</th>";
                                                                echo "<th scope='col'>Code/Number</th>";
                                                                echo "<th scope='col'>Category</th>";
                                                                echo "<th scope='col'>Cost(R)</th>";
                                                                echo "<th scope='col'>AssignedTo</th>";
                                                                echo "<th scope='col'>Status</th>";
                                                                echo "<th scope='col'>Company</th>";
                                                                echo "<th scope='col'>Floor</th>";
                                                                echo "<th scope='col'>Vendor</th>";
                                                                echo "<th scope='col'>Received</th>";
                                                                echo "<th scope='col'>Issued</th>";
                                                                echo "<th scope='col'>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                        echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                    echo "<tr>";
                                                                        echo "<td>" . $row['a_id'] . "</td>";
                                                                        echo "<td>" . $row['a_name'] . "</td>";
                                                                        echo "<td>" . $row['a_model'] . "</td>";
                                                                        echo "<td>" . $row['a_uniquecode'] . "</td>";
                                                                        echo "<td>" . $row['a_category'] . "</td>";
                                                                        echo "<td>" . $row['a_cost'] . "</td>";
                                                                        echo "<td>" . $row['a_assignedto'] . "</td>";
                                                                        echo "<td>" . $row['a_status'] . "</td>";
                                                                        echo "<td>" . $row['a_company'] . "</td>";
                                                                        echo "<td>" . $row['a_sitefloor'] . "</td>";
                                                                        echo "<td>" . $row['a_vendor'] . "</td>";
                                                                        echo "<td>" . $row['a_datereceived'] . "</td>";
                                                                        echo "<td>" . $row['a_dateissued'] . "</td>";
                                                                        echo "<td>";
                                                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                                                    echo '<a href="../forms/update_asset.php?id='.$row['a_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                                                    echo '<a href="../php/assetdelete.php?id='.$row['a_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></a>';                                                                             
                                                                            echo "</div>";
                                                                        echo "</td>";
                                                                    echo "</tr>";
                                                                    }
                                                        echo "</tbody>";
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                        }else
                                        {
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }

                                    }else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($mysqlconnect);
                                ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<div class="fixed-footer bg-primary ">
    <div id="flex-container" class="container navbar-nav bg-primary  ">
            <nav>
                <a class="text-white fw-bold m-3" href="employees.php">Employees <i class="bi bi-people-fill"></i></a>
                <a class="text-white fw-bold m-3" href="vendors.php">Vendors <i class="bi bi-buildings"></i></a>
                <a class="text-white fw-bold m-3" href="companysites.php">Company Sites <i class="bi bi-building"></i></a>
                <a class="text-white fw-bold m-3" href="../Authorization/adminlogin.php">Admin <i class="bi bi-person-circle"></i></a>
            </nav>
      
      	</div>        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
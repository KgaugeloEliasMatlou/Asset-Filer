<?php

require_once('../include/Db.php');
require_once('../php/create_asset.php');
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
    <title>Add New Asset</title>
</head>

<body>
    
<div class="m-0 py-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <div class="container-fluid">
          <h1 class="navbar-brand text-white fw-bold ">Add New Asset <i class="bi bi-grid"></i></h1>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="../Authorization/logout.php" class="btn btn-outline-warning">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container py-5 mt-5 d-flex justify-content-center border " style="background-color : #f2f2f2">
<?php
$color = $_SESSION['bootstrapclass'];
echo "<h7 class='$color'>".$_SESSION['status']."</h7>";
unset($_SESSION['status']);
unset($_SESSION['bootstrapclass']);
?>
<div class="container w-75 ">
                        <form action="../php/create_asset.php" method="post">
                            <div class="container">
                                <h4 class="<?php echo (!empty($_SESSION['bootstrapclass_blank'])) ?  $_SESSION['bootstrapclass_blank'] :'';
                                    unset($_SESSION['bootstrapclass_blank']);
                                ?>">
                                <?php echo (!empty($_SESSION['inputerror'])) ?  $_SESSION['inputerror'] :''; 
                                    unset($_SESSION['inputerror']);
                                ?></h4>
                                <div class="row row-cols-2">
                                    <div class="col mb-3">
                                        <label for="assetnameinput" class="form-label text-primary fw-bold">Asset
                                            Name</label>
                                        <input type="text" class="form-control form-control-sm" name="assetname" placeholder="" value="<?php echo (!empty($_POST['assetname'])) ?  $_POST['assetname'] :''; ?>">
                                        <p class="<?php echo (!empty($_SESSION['bootstrapclass_name'])) ?  $_SESSION['bootstrapclass_name'] :''; 
                                            unset($_SESSION['bootstrapclass_name']);

                                        ?>"><?php echo (!empty($_SESSION['asseterr'])) ?  $_SESSION['asseterr'] :''; 
                                            unset($_SESSION['asseterr']);
                                        ?></p>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="modelinput" class="form-label text-primary fw-bold">Model</label>
                                        <input type="text" class="form-control form-control-sm" name="model" placeholder="" value="<?php echo (!empty($_POST['model'])) ?  $_POST['model'] :''; ?>">
                                        <p class="<?php echo (!empty($_SESSION['bootstrapclass_model'])) ?  $_SESSION['bootstrapclass_model'] :''; 
                                            unset($_SESSION['bootstrapclass_model']);
                                        ?>"><?php echo (!empty($_SESSION['model'])) ?  $_SESSION['model'] :''; 
                                            unset($_SESSION['model']);
                                        ?></p>
                                    </div>
                                </div>
                                    <div class="col mb-3">
                                        <label for="categorydropdwn" class="form-label text-primary fw-bold">Category</label>
                                        <div class="row">
                                            <div class="col">
                                                <select name="category" id="dropdown" onchange="showtext()">
                                                    <option value="<?php echo (!empty($_POST['category'])) ?  $_POST['category'] :''; ?>"><?php echo (!empty($_POST['status'])) ?  $_POST['status'] :''; ?></option>
                                                    <option value="all in one computer">All in one Computer</option>
                                                    <option value="computer box">Computer Box</option>
                                                    <option value="laptops">Laptops</option>
                                                    <option value="display devices">Display Devices</option>
                                                    <option value="computer pheripherals">Computer Pheripherals</option>
                                                    <option value="mobile phones">Mobile Phones</option>
                                                    <option value="tablet">Tablet</option>                                                    
                                                    <option value="telephones">Telephones</option>
                                                    <option value="printers">Printers</option>
                                                    <option value="servers">Servers</option>
                                                    <option value="switches">Switches</option>
                                                    <option value="router">Router</option>
                                                    <option value="cables">Cables</option>
                                                    <option value="network cables">Network Cables</option>
                                                    <option value="chairs">Chairs</option>
                                                    <option value="desks">Desks</option>
                                                    <option value="curtains">Curtains</option>
                                                    <option value="drawers">Drawers</option>
                                                    <option value="closets">Closets</option>
                                                    <option value="refregirator">Refregirator</option>
                                                    <option value="kettles">kettles</option>
                                                    <option value="aircon">Air Con</option>
                                                    <option value="plugs and adapters">Plugs And Adapters</option>
                                                    <option value="stationary">Stationary</option>
                                                    <option value="uniform">Uniforms</option>
                                                    <option value="truck">Truck</option>
                                                    <option value="bus">Bus</option>
                                                    <option value="private car">Private Car</option>
                                                    <option value="van">Van</option>
                                                    <option value="trailer">Trailers</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </div>

                                        </div>
                                </div>
                                <div class="row row-cols-2 mb-3">
                                    <div class="col mb-3">
                                        <label id="uniquecodelabel" for="uniquecodeinput" class="form-label text-primary fw-bold">Serial Number</label>
                                        <input type="text" class="form-control form-control-sm" name="uniquecode" placeholder="" value="<?php echo (!empty($_POST['uniquecode'])) ?  $_POST['uniquecode'] :''; ?>">
                                        <p class="<?php echo (!empty($_SESSION['bootstrapclass_code'])) ?  $_SESSION['bootstrapclass_code'] :'';
                                            unset($_SESSION['bootstrapclass_code']);
                                        ?>"><?php echo (!empty($_SESSION['code'])) ?  $_SESSION['code'] :''; 
                                            unset($_SESSION['code']);
                                        ?></p>
                                    </div>
                                    <div class="col mb-3">
                                        <label id="costlabel" for="costinput" class="form-label text-primary fw-bold">Cost Of Asset</label>
                                        <input type="number" class="form-control form-control-sm" name="Cost" placeholder="10000.00" value="<?php echo (!empty($_POST['Cost'])) ?  $_POST['Cost'] :''; ?>">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                        
                                    <div class="col mb-3">
                                        <label for="assignedtoinput" class="form-label text-primary fw-bold">Assigned To</label>
                                        <div class="row">
                                            <div class="col">
                                                <select name="assignedto" id="dropdown">
                                                <option value="<?php echo (!empty($_POST['assignedto'])) ?  $_POST['assignedto'] :'not assigned'; ?>"><?php echo (!empty($_POST['assignedto'])) ?  $_POST['assignedto'] :'Not Assigned'; ?></option>
                                                <?php

                                                $getval = "select CONCAT(e_firstname, ' ', e_last_name) as 'e_name'from employees";
                                                $results = mysqli_query($mysqlconnect, $getval);
                                                
                                                while ($row = mysqli_fetch_array($results)) {
                                                ?>
                                                <option value="<?php echo $row['e_name']; ?>">
                                                    <?php echo $row['e_name']; ?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="col col-2 h-25 w-25">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col mb-3">
                                        <label for="statusdropdown" class="form-label text-primary fw-bold">Status</label>

                                        <select name="status" id="dropdown">
                                            <option value="<?php echo (!empty($_POST['status'])) ?  $_POST['status'] :''; ?>"><?php echo (!empty($_POST['status'])) ?  $_POST['status'] :''; ?></option>
                                            <option value="A"> Assigned</option>
                                            <option value="S"> In-Stock</option>
                                            <option value="D"> Damaged</option>

                                        </select>
                                    </div>
                                </div>

                                <div class=" mb-3">
                                    <label for="company" class="form-label text-primary fw-bold">Company</label>
                                    <div class="row">
                                        <div class="col">
                                            <select class="company" name="company" id="dropdown">
                                                <option value="<?php echo (!empty($_POST['company'])) ?  $_POST['company'] :''; ?>"><?php echo (!empty($_POST['company'])) ?  $_POST['company'] :''; ?></option>
                                                <?php
                                                $getval = "select sl_name from site_locations";
                                                $results = mysqli_query($mysqlconnect, $getval);

                                                while ($row = mysqli_fetch_array($results)) {
                                                ?>
                                                <option value="<?php echo $row['sl_name']; ?>">
                                                    <?php echo $row['sl_name']; ?></option>
                                                    <?php } ?>
                                            </select>
                                            <div class="col col-2 h-25 w-25">
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="row row-cols-2">
                                    <div class="col mb-3">
                                            <label for="sitefloor" class="form-label text-primary fw-bold">Site
                                                Floor</label>
                                        <div class="row">
                                            <div class="col">
                                                <select name="sitefloor" id="dropdown">
                                                    <option value="<?php echo (!empty($_POST['sitefloor'])) ?  $_POST['sitefloor'] :''; ?>"><?php echo (!empty($_POST['sitefloor'])) ?  $_POST['sitefloor'] :''; ?></option>
                                                    <?php
                                                    $getval = "select sf_site_floor from site_floors";
                                                    $results = mysqli_query($mysqlconnect, $getval);

                                                    while ($row = mysqli_fetch_array($results)) {
                                                    ?>
                                                    <option value="<?php echo $row['sf_site_floor']; ?>">
                                                        <?php echo $row['sf_site_floor']; ?></option>
                                                        <?php } ?>
                                                </select>
                                                <div class="col col-2 h-25 w-25">
                                                </div>
                                            </div>
                                        </div>            
                                    </div>
                                    <div class="col mb-3">
                                        <label for="vendor" class="form-label text-primary fw-bold">Vendor</label>
                                        <div class="row">
                                            <div class="col">
                                                    <select name="vendor" id="dropdown">
                                                        <option value="<?php echo (!empty($_POST['vendor'])) ?  $_POST['vendor'] :''; ?>"><?php echo (!empty($_POST['vendor'])) ?  $_POST['vendor'] :''; ?></option>
                                                        <?php
                                                        $getval = "select v_name from vendor";
                                                        $results = mysqli_query($mysqlconnect, $getval);

                                                        while ($row = mysqli_fetch_array($results)) {
                                                        ?>
                                                        <option value="<?php echo $row['v_name']; ?>">
                                                            <?php echo $row['v_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="col col-2 h-25 w-25">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col mb-3">
                                        <label for="daterecieved" class="form-label text-primary fw-bold">Date
                                            Recieved</label>
                                        <input type="date" class="form-control form-control-sm" name="datereceived" value="<?php echo (!empty($_POST['datereceived'])) ?  $_POST['datereceived'] :''; ?>">
                                    </div>
                                    <div class="col mb-3">
                                        <label for="dateissued" class="form-label text-primary fw-bold">Date
                                            Issued</label>
                                        <input type="date" class="form-control form-control-sm" name="dateissued" value="<?php echo (!empty($_POST['dateissued'])) ?  $_POST['dateissued'] :''; ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" name="btnsubmit" class="btn btn-outline-primary">Save
                                        Asset</button>
                                </div>
                            </div>
                        </form>
                    </div>
</div>
<div class="fixed-footer bg-primary ">
    <div id="flex-container" class="container navbar-nav bg-primary  ">
            <nav>
                <a class="text-white fw-bold m-3" href="../pages/dashboard.php">Dashboard <i class="bi bi-table"></i></a>
                <a class="text-white fw-bold m-3" href="../pages/employees.php">Employees <i class="bi bi-people-fill"></i></a>
                <a class="text-white fw-bold m-3" href="../pages/vendors.php">Vendors <i class="bi bi-buildings"></i></a>
                <a class="text-white fw-bold m-3" href="../pages/companysites.php">Company Sites <i class="bi bi-building"></i></a>
                <a class="text-white fw-bold m-3" href="../pages/admin.php">Admin <i class="bi bi-person-circle"></i></a>
            </nav>
      
      	</div>        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
<?php

//require_once('../include/Db.php');
require_once('../php/add_companysite.php');

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
    <title>Add Category</title>
</head>

<body>
    
<div class="m-0 py-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <div class="container-fluid">
          <h1 class="navbar-brand text-white fw-bold ">Add New Company Site <i class="bi bi-building"></i></h1>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="../Authorization/logout.php" class="btn btn-outline-warning">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container py-5 mt-5 d-flex justify-content-center border " style="background-color : #f2f2f2">

    <div class="container">
                    <?php   $color = $_SESSION['bootstrapclass'];
                        echo "<h7 class='$color'>".$_SESSION['status']."</h7>";
                        unset($_SESSION['status']);
                        unset($_SESSION['bootstrapclass']);
                    ?>
            <form action="../php/add_companysite.php" method="post">
                <div class="container w-50">
                    <div class="container">
                            <div class="container">
                                <label for="companysitename" class="form-label text-primary fw-bold">Company Site Name</label>
                                <input type="text" class="form-control form-control-sm" name="companysitename" placeholder="Site Name...">
                            </div>
                            <div class="container">
                                <label for="companysiteaddress" class="form-label text-primary fw-bold">Company Site Address</label>
                                <input type="text" class="form-control form-control-sm" name="companysiteAddress" placeholder="Site Address...">
                            </div>
                            <div class="container mb-2 py-2">
                                <button type="submit" name="btnsubmit" class="btn btn-outline-primary">Save </button>
                            </div>
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
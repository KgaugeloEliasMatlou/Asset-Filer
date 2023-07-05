<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
//require_once('../forms/update_companysite.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Company Sites</title>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="m-0 ">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <div class="container-fluid">
          <h1 class="navbar-brand text-white fw-bold ">Company Sites <i class="bi bi-building"></i></h1>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a class="btn btn-outline-light mx-3" href="../forms/add_companysite_form.php">Add Company Site</a>
                    <a href="../Authorization/logout.php" class="btn btn-outline-warning">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container py-3 m-5">
    <div class="container">
        <?php   $color = $_SESSION['savedbootstrapclass'];
            echo "<h7 class='$color'>".$_SESSION['savedstatus']."</h7>";
            unset($_SESSION['savedstatus']);
            unset($_SESSION['savedbootstrapclass']);
                    
    
        require('../include/Db.php');
        // Attempt select query execution
        $sql = "SELECT sl_id,sl_name,sl_address FROM assets_management_db.site_locations;";
        if($result = mysqli_query($mysqlconnect, $sql))
        {
            if(mysqli_num_rows($result) > 0)
            {
                    echo '<table id="assettable" class="table table-sm table-striped border rounded border-primary ">';
                        echo "<thead class='table-primary'>";
                            echo "<tr class='text-primary'>";
                                echo "<th scope='col'>ID</th>";
                                echo "<th scope='col'>Name</th>";
                                echo "<th scope='col'>Address</th>";
                                echo "<th scope='col'>Action</th>";
                            echo "</tr>";
                        echo "</thead>";
                            echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['sl_id'] . "</td>";
                                        echo "<td>" . $row['sl_name'] . "</td>";
                                        echo "<td>" . $row['sl_address'] . "</td>";
                                        echo "<td>";
                                            echo"<div class ='container my-1 d-flex justify-content-start'>";
                                                echo '<a href="../forms/update_companysite.php?id='.$row['sl_id'].'" class="btn btn-outline-primary w-auto btn-sm"><i class="bi bi-pencil"></i></a>';
                                                //echo "<button type='button' class='btn btn-outline-dark w-auto btn-sm mx-1'data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='bi bi-trash3-fill'></i></button>";
                                                echo '<a href="../php/companysitedelete.php?id='.$row['sl_id'].'" class="btn btn-outline-dark w-auto btn-sm mx-1"><i class="bi bi-trash3-fill"></i></>';
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
                echo '<div class="container"><em><b>No records were found.</b></em></div>';
            }
        }else{
            echo "Oops! Something went wrong. Please try again later.";
            }
        // Close connection
        mysqli_close($mysqlconnect);
    echo "</div>";
echo "</div>";
?>

<div class="fixed-footer bg-primary ">
    <div id="flex-container" class="container navbar-nav bg-primary  ">
            <nav>
                <a class="text-white fw-bold m-3" href="dashboard.php">Dashboard <i class="bi bi-table"></i></a>
                <a class="text-white fw-bold m-3" href="employees.php">Employees <i class="bi bi-people-fill"></i></a>
                <a class="text-white fw-bold m-3" href="vendors.php">Vendors <i class="bi bi-buildings"></i></a>
            </nav>
    </div>        
</div>
</body>
</html>
<?php
require_once('../include/Db.php');
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}

// Define variables and initialize with empty values
$v_name = $v_address =$v_contact="";
 
// Processing form data when form is submitted
if(isset($_POST["btnsubmit"])&&!empty($_GET['id']))
{
        if(preg_match('/^[a-z A-Z]+$/',$_POST['vendorname'])&& preg_match('/^[a-zA-Z 0-9,]+$/',$_POST['vendoraddress'])&& preg_match('/^[0-9]+$/', trim($_POST['vendornumber'])))
        {
            //insert into the database 
            $sql = "UPDATE assets_management_db.vendor SET  v_name=?,v_contact=?,v_address =? WHERE v_id=?";

            if($stmt = mysqli_prepare($mysqlconnect, $sql))
            {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssi", $param_v_name,$param_v_contact,$param_v_address,$param_v_id);

                    // Set parameters
                    $param_v_name = $_POST["vendorname"];
                    $param_v_contact = $_POST["vendornumber"];
                    $param_v_address = $_POST["vendoraddress"];
                    $param_v_id = $_POST['id'];

                    // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) 
                {
                    // Redirect to the form page
                    $success = "Saved ";
                    $_SESSION['savedbootstrapclass'] = "text-success";
                    $_SESSION['savedstatus'] = $success;

                    header("location:../pages/vendors.php");
                    exit();
                }
                else 
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                    // Close statement
                    mysqli_stmt_close($stmt);
            }
            else
            {
                    echo "Error Occurred contact the Developer";
            }
        } 
        else 
        {
                    $error =  "Please Enter Correct Details.".'</br>'."No Characters and Underscores Allowed.".'</br>'."No Blanks Allowed.";
                    $_SESSION['errorstatus'] = $error;
                    $_SESSION['bootstrapclass'] = "text-danger";
                    $id = $_GET['id'];
                    header("location:../forms/update_vendor.php?id=$id");
                    exit();
        }
}
elseif(empty($_GET['id']))
{
                    header("location:../pages/vendors.php");
                    exit();
}
else
{
                    // Check existence of id parameter before processing further
                    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
                        // Get URL parameter
                        $id =  trim($_GET["id"]);
                        
                        // Prepare a select statement
                        $sql = "SELECT * FROM assets_management_db.vendor WHERE v_id = ?";
                        if($stmt = mysqli_prepare($mysqlconnect, $sql))
                        {

                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "i", $param_id);
                            
                            // Set parameters
                            $param_id = $id;
                            
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                $result = mysqli_stmt_get_result($stmt);
                    
                                if(mysqli_num_rows($result) == 1){
                                    /* Fetch result row as an associative array. Since the result set
                                    contains only one row, we don't need to use while loop */
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    
                                    // Retrieve individual field value 
                                    $v_name = $row["v_name"];
                                    $v_address= $row["v_address"];
                                    $v_contact = $row["v_contact"];
                                                                        
                                } else{
                                    // URL doesn't contain valid id. Redirect to error page
                                    //header("location: error.php");
                                    //exit();
                                }
                                
                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                        
                        // Close connection
                        mysqli_close($mysqlconnect);
                    }  else{
                        // URL doesn't contain id parameter. Redirect to error page
                        //header("location: error.php");
                        //exit();
                    }
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
    <title>Add New Vendor</title>
</head>

<body>
    
<div class="m-0 py-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
        <div class="container-fluid">
          <h1 class="navbar-brand text-white fw-bold ">Edit Vendor <i class="bi bi-buildings"></i></h1>
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
                        echo "<h7 class='$color'>".$_SESSION['errorstatus']."</h7>";
                        unset($_SESSION['errorstatus']);
                        unset($_SESSION['bootstrapclass']);
                ?>

                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="container w-50">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                            <div class="container">
                                <label for="vendorname" class="form-label text-primary fw-bold">Vendor Name</label>
                                <input type="text" class="form-control form-control-sm" name="vendorname" placeholder="Store Name..." value="<?php  echo $v_name; ?>" >
                            </div>
                            <div class="container">
                                <label for="vendorcontact" class="form-label text-primary fw-bold">Vendor contact</label>
                                <input type="number" class="form-control form-control-sm" name="vendornumber" placeholder="(011) 000 0000" value="<?php  echo $v_contact; ?>">
                            </div>
                            <div class="container">
                                <label for="vendoraddress" class="form-label text-primary fw-bold">Vendor Address</label>
                                <input type="text" class="form-control form-control-sm" name="vendoraddress" placeholder="Address..." value="<?php  echo $v_address; ?>">
                            </div>
                            <div class="container mb-2 py-2">
                                <button type="submit" name="btnsubmit" class="btn btn-outline-primary">Save</button>
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
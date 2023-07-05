<?php
require('../include/Db.php');


if(!empty($_GET['id'])){
    if(isset($_POST['delete']))
    {
        $id = $_GET['id'];

        // Prepare a delete statement
        $sql = "DELETE FROM assets_management_db.vendor where v_id = ?";

        if($stmt = mysqli_prepare($mysqlconnect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records deleted successfully. Redirect to landing page
                header("location:../pages/vendors.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($mysqlconnect);
        }
        
    }
    elseif(isset($_POST['cancel']))
    {
        header("location:../pages/vendors.php");
    }
}
else{
    header("location:../pages/vendors.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Sign in Form with Circular Social Buttons</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	font-family: 'Varela Round', sans-serif;
    background : #1E90FF;
}

.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {
	border-radius: 50px;
	outline: none !important;
}
.signin-form {
	width: 590px;
	margin: 0 auto;
	padding: 200px 0;
}
.signin-form form {
	border-radius: 5px;
	margin-bottom: 20px;
	background: #FFFFF0;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 40px;
}
.signin-form a {
	color: #5cb85c;
}    

.signin-form .hint-text {
	color: #999;
	text-align: center;
	margin-bottom: 20px;
}
.signin-form .form-group {
	margin-bottom: 20px;
}
.signin-form .btn {        
	font-size: 18px;
	line-height: 26px;        
	font-weight: bold;
	text-align: center;
}
.signin-form .small {
	font-size: 13px;
}


.social-btn .btn {
	color: #fff;
	margin: 10px 0 0 30px;
	font-size: 15px;
	width: 80px;
	height: 70px;
	line-height: 45px;
	border-radius: 50%;
	font-weight: normal;
	text-align: center;
	border: none;
	transition: all 0.4s;
}	
.social-btn .btn:first-child {
	margin-left: 0;
}
.social-btn .btn:hover {
	opacity: 0.8;
}

</style>
</head>
<body>
<div class="signin-form">
    <form action="../php/vendordelete.php?id=<?php echo $_GET['id'];?>" method="post">
        <h4 class="text-danger">This Vendor Will Be Deleted Permanently. <i class=" bi bi-emoji-frown text-primary"></i></h4>
		<div class="social-btn text-center">
			<button type="submit" name="cancel" class="btn btn-primary btn-lg" title="cancel">Cancel</button>
			<button type="submit" name="delete" class="btn btn-danger btn-lg" title="delete">Delete</button>
		</div>
	
    </form>
</div>
</body>
</html>
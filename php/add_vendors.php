<?Php
require_once('../include/Db.php');
session_start();
if(isset($_POST['btnsubmit']))
{

        if(preg_match('/^[a-z A-Z]+$/',$_POST['vendorname'])&& preg_match('/^[a-zA-Z 0-9,]+$/',$_POST['vendoraddress'])&& preg_match('/^[0-9]+$/', trim($_POST['vendornumber']))) {

            // Prepare a select statement
            $sql = "SELECT v_id FROM vendor WHERE v_name = ?";

                if ($stmt = mysqli_prepare($mysqlconnect, $sql)) 
                {
                    // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_vendorname);

                    // Set parameters
                    $param_vendorname = $_POST["vendorname"];
                    $param_vendornumber = $_POST["vendornumber"];
                    $param_vendoraddress = $_POST["vendoraddress"];

                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) 
                    {
                        /* store result */
                        mysqli_stmt_store_result($stmt);

                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            $vendor_err = "This Vendor Already Exits..";
                            $_SESSION['status'] = $vendor_err;
                            header("location: ../forms/add_vendor_form.php");
                            exit();
                        } 
                        else {

                            //insert into the database
                            $insertsql = "INSERT INTO vendor (v_name,v_contact,v_address) VALUES (?,?,?)";
                            if($stmt = mysqli_prepare($mysqlconnect, $insertsql))
                            {
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "sis", $param_vendorname, $param_vendornumber,$param_vendoraddress);

                                    // Set parameters
                                    $param_vendorname = $_POST["vendorname"];
                                    $param_vendornumber = $_POST["vendornumber"];
                                    $param_vendoraddress = $_POST["vendoraddress"];

                                    // Attempt to execute the prepared statement
                                    if (mysqli_stmt_execute($stmt)) {
                                    // Redirect to the form page
                                    $success = "Added Successfully";
                                    $_SESSION['bootstrapclass'] = "text-success";
                                    $_SESSION['status'] = $success;
                                    
                                    header("location:../forms/add_vendor_form.php");
                                    exit();
                                    } else {
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
                    } 
                    else {

                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }



        }
        else{

                $error =  "Please Enter Correct Details.".'</br>'."No Characters and Underscores Allowed.".'</br>'."No Blanks Allowed.";
                $_SESSION['status'] = $error;
                $_SESSION['bootstrapclass'] = "text-danger";
                header("location:../forms/add_vendor_form.php");
                exit();
                

        }
}

?>

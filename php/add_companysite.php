<?Php
require_once('../include/Db.php');
session_start();
if(isset($_POST['btnsubmit']))
{

        if(preg_match('/^[a-z A-Z]+$/',$_POST['companysitename'])&& preg_match('/^[a-zA-Z 0-9,]+$/',$_POST['companysiteAddress'])) 
        {

                // Prepare a select statement
                $sql = "SELECT sl_id FROM site_locations WHERE sl_name = ?";

                if ($stmt = mysqli_prepare($mysqlconnect, $sql)) 
                {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_companysite_name);

                    // Set parameters
                    $param_companysite_name = $_POST["companysitename"];
                    $param_companysite_address = $_POST["companysiteAddress"];

                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) 
                    {
                        /* store result */
                        mysqli_stmt_store_result($stmt);

                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            $site_err = "This Site Location Already Exits..";
                            $_SESSION['status'] = $site_err;
                            header("location: ../forms/add_companysite_form.php");
                            exit();
                        } 
                        else {

                            //insert into the database
                            $insertsql = "INSERT INTO site_locations (sl_name,sl_address) VALUES (?,?)";
                            if($stmt = mysqli_prepare($mysqlconnect, $insertsql))
                            {
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "ss", $param_companysite_name,$param_companysite_address);

                                    // Set parameters
                                    $param_companysite_name = $_POST["companysitename"];
                                    $param_companysite_address = $_POST["companysiteAddress"];

                                    // Attempt to execute the prepared statement
                                    if (mysqli_stmt_execute($stmt)) {
                                    // Redirect to the form page
                                    $success = "Added Successfully";
                                    $_SESSION['bootstrapclass'] = "text-success";
                                    $_SESSION['status'] = $success;
                                    
                                    header("location:../forms/add_companysite_form.php");
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
                header("location:../forms/add_companysite_form.php");
                exit();
                

        }
}

?>
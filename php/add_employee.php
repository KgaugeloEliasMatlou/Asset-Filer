<?Php
require_once('../include/Db.php');
session_start();
if(isset($_POST['btnsubmit']))
{

        if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['empnumber'])&& preg_match('/^[a-z A-Z]+$/',$_POST['empfirstname'])&& preg_match('/^[a-z A-Z]+$/', $_POST['emplastname'])) {

                // Prepare a select statement
                $sql = "SELECT e_id FROM employees WHERE e_firstname = ?";

                if ($stmt = mysqli_prepare($mysqlconnect, $sql)) 
                {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_e_firstname);

                    // Set parameters
                    $param_e_number = $_POST["empnumber"];
                    $param_e_firstname = $_POST["empfirstname"];
                    $param_e_lastname = $_POST["emplastname"];
                    

                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) 
                    {
                        /* store result */
                        mysqli_stmt_store_result($stmt);

                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            $employee_err = "This Employee Already Exits..";
                            $_SESSION['status'] = $employee_err;
                            $_SESSION['bootstrapclass'] = "text-danger";
                            header("location: ../forms/add_employee_form.php");
                            exit();
                        } 
                        else {
                            //insert into the database
                            $insertsql = "INSERT INTO employees (e_firstname,e_last_name,e_emp_number) VALUES (?,?,?)";
                            if($stmt = mysqli_prepare($mysqlconnect, $insertsql))
                            {
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "sss",$param_e_firstname,$param_e_lastname,$param_e_number);

                                    // Set parameters
                                    $param_e_number = $_POST["empnumber"];
                                    $param_e_firstname = $_POST["empfirstname"];
                                    $param_e_lastname = $_POST["emplastname"];

                                    // Attempt to execute the prepared statement
                                    if (mysqli_stmt_execute($stmt)) {
                                    // Redirect to the form page
                                    $success = "Added Successfully";
                                    $_SESSION['bootstrapclass'] = "text-success";
                                    $_SESSION['status'] = $success;
                                    
                                    header("location:../forms/add_employee_form.php");
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
                header("location:../forms/add_employee_form.php");
                exit();

                

        }
}

?>
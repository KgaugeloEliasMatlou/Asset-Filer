<?php
require_once('../include/Db.php');

session_start();

if (isset($_POST['btnsubmit'])) 
{

    if(!empty($_POST['assetname'])&&!empty($_POST['model'])&&!empty($_POST['category'])&&!empty($_POST['uniquecode'])
        &&!empty($_POST['Cost'])&&!empty($_POST['assignedto'])&&!empty($_POST['status'])&&!empty($_POST['company'])
        &&!empty($_POST['sitefloor'])&&!empty($_POST['vendor'])&&!empty($_POST['datereceived'])&&!empty($_POST['dateissued']))
    {
    
        if(preg_match('/^[a-zA-Z ]+$/',trim($_POST['assetname'])))
        {
            //echo "assetname";

            $a_name = $_POST['assetname'];
        }
        else{

            $bootstrapclass_name = "font-monospace text-danger fs-6";
            $asset_err = "Enter a Proper Name.";
            $_SESSION['asseterr'] = $asset_err;
            $_SESSION['bootstrapclass_name'] = $bootstrapclass_name;

        }
        
        if(preg_match('/^[a-zA-Z0-9- ]+$/',trim($_POST['model'])))
        {
            //echo ".....model";

            $a_model = $_POST['model'];
        }

        else{

            $bootstrapclass_model = "font-monospace text-danger fs-6";
            $model_err = "Enter a Proper Model Name. Only letters(A-Z), Numbers (0-9), Hyphen (-).";
            $_SESSION['model'] = $model_err;
            $_SESSION['bootstrapclass_model'] = $bootstrapclass_model;

        }

        if(preg_match('/^[a-zA-Z0-9-]+$/',trim($_POST['uniquecode'])))
        {
            //echo ".....serial";

            $a_uniquecode = $_POST['uniquecode'];
        }

        else{
            
            $bootstrapclass_code = "font-monospace text-danger fs-6";
            $serial_err = "Enter Only letters(A-Z), Numbers (0-9), Hyphen (-).";
            $_SESSION['code'] = $serial_err;
            $_SESSION['bootstrapclass_code'] = $bootstrapclass_code;
        }

        if(!empty($a_name)&&!empty($a_model)&&!empty($a_uniquecode))
        {

            //echo $a_name.' '.$a_model.' '.$a_uniquecode.' '.$_POST['Cost'].' '.$_POST['datereceived'].' '.$_POST['dateissued'];

            // Prepare a select statement
            $sql = "SELECT a_id FROM Assets WHERE a_uniquecode  = ?";

            if ($stmt = mysqli_prepare($mysqlconnect, $sql)) 
            {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_a_uniquecode);

                // Set parameters
                $param_a_uniquecode = $_POST["uniquecode"];

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) 
                {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) 
                    {

                        $input_error = "Asset already exists...";
                        $bootstrapclass_blank = "text-danger fs-6";
                        $_SESSION['inputerror']=$input_error;
                        $_SESSION['bootstrapclass_blank'] = $bootstrapclass_blank;
                        header("location: ../forms/add_asset_form.php");

                        exit();
                    } 
                    else 
                    {


                        //insert into the database
                        $insertsql = "INSERT INTO Assets (a_name,a_model,a_uniquecode,a_category,a_cost,a_assignedto,a_status,a_company,a_sitefloor,a_vendor,a_datereceived,a_dateissued) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                        if($stmt = mysqli_prepare($mysqlconnect, $insertsql))
                        {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ssssdsssssss",$a_name,$a_model,$a_uniquecode,$a_category,$a_cost,$a_assignedto,$a_status,$a_company,$a_sitefloor,$a_vendor,$a_datereceived,$a_dateissued );

                            // Set parameters

                            $a_name = $_POST['assetname'];
                            $a_model = $_POST['model'];
                            $a_uniquecode = $_POST['uniquecode'];
                            $a_category = $_POST['category'];
                            $a_cost = $_POST['Cost'];
                            $a_assignedto = $_POST['assignedto'];
                            $a_status = $_POST['status'];
                            $a_company = $_POST['company'];
                            $a_sitefloor = $_POST['sitefloor'];
                            $a_vendor = $_POST['vendor'];
                            $a_datereceived = $_POST['datereceived'];
                            $a_dateissued = $_POST['dateissued'];

                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) 
                            {
                                // Redirect to the form 
                                $input_error = "Asset successfully added...";
                                $bootstrapclass_blank = "text-success fs-6";
                                $_SESSION['inputerror']=$input_error;
                                $_SESSION['bootstrapclass_blank'] = $bootstrapclass_blank;

                                header("location:../forms/add_asset_form.php");
                            } 
                            else 
                            {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                                // Close statement
                                mysqli_stmt_close($stmt);
                        }

                    }
                }
            }
        }
    }
    else
    {
        $input_error = "Please Fill All Fields";
        $bootstrapclass_blank = "text-danger fs-6";
        $_SESSION['inputerror']=$input_error;
        $_SESSION['bootstrapclass_blank'] = $bootstrapclass_blank;
        header("location: ../forms/add_asset_form.php");
    }
}


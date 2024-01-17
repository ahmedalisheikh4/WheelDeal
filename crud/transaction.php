<?php
include("../config/connection.php");
if(isset($_POST['submit']))
    {
        $vehicle_id = $_POST['vehicle_id'];
        $buyer_id = $_POST['buyer_id'];
        $seller_id = $_POST['seller_id'];
        $sex = $_POST['sex'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        $comment = $_POST['comment'];
        
        $insert = $con->prepare("INSERT INTO `transaction_list`(`vehicle_id`,`buyer_id`,`seller_id`,`sex`,`dob`,`contact`,`comment`) VALUES (?,?,?,?,?,?,?);");
        $insert->bind_param('iiisdis', $vehicle_id, $buyer_id, $seller_id, $sex, $dob, $contact, $comment);
        $insert->execute();

        if($insert)
        {
            header("location:../pages/cars.php?status=sold");
        }
        else
        {
            echo "ERROR: " . $con->error;
        }

        $insert->close();
    }
// Extract vehicle_id from the URL
$vehicle_id = isset($_GET['vehicle_id']) ? $_GET['vehicle_id'] : null;

// Fetch vehicle details
if ($vehicle_id) {
    $vehicle_query = "SELECT v.*, b.brand_name as `brand_name`, ct.type_name as `type_name`, m.model_name as `model_name`, m.engine_type as 'engine_type', m.transmission_type as 'transmission_type'
                      FROM vehicle_list v
                      JOIN model_list m ON v.model_id = m.model_id
                      JOIN brand_list b ON m.brand_id = b.brand_id
                      JOIN car_type_list ct ON m.type_id = ct.type_id
                      WHERE v.vehicle_id = '{$vehicle_id}'";

    $vehicle_result = $con->query($vehicle_query);

    if ($vehicle_result->num_rows > 0) {
        $vehicle = $vehicle_result->fetch_assoc();
    }
}

// Fetch transaction details if available
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $transaction_query = "SELECT * FROM transaction_list WHERE transaction_id = '{$id}'";
    $transaction_result = $con->query($transaction_query);

    if ($transaction_result->num_rows > 0) {
        $transaction = $transaction_result->fetch_assoc();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Genius, Ocean, Sea, Etc">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listing</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/front/images/favicon.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/front/css/bootstrap.min.css">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="../assets/front/css/plugin.css">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../assets/front/css/style.css">
    <!-- Responsive -->
    <link rel="stylesheet" href="../assets/front/css/responsive.css">
    <!-- Custom -->
    <link rel="stylesheet" href="../assets/front/css/custom.css">
    <!-- Base color -->
    <link rel="stylesheet" href="../assets/front/css/styles8353.css?color=ff5328">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-T5AUBrMYMlUxBlCO5VwYRk3vFYJ91v5LPRG8qD9cHJREURZ1vnUcFN2NjBE+3JNE" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iKt6qtjeE6Mk9Gm230I4OmROByBfB9B9vFf73iKllFd-JY7d2Sr9aJ9M" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .content {
            background-color: #004080;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }

        h4 {
            margin: 0;
            font-size: 1.8em;
        }

        .card {
            margin-top: 20px;
        }

        .card-title {
            font-size: 1.5em;
            color: #004080;
        }

        .card-header {
            background-color: #004080;
            color: #ffffff;
        }

        .card-body,
        .card-footer {
            background-color: #ffffff;
        }

        .row {
            margin: 20px 0;
        }

        label {
            font-weight: bold;
        }

        .btn-navy {
            background-color: #004080;
            color: #ffffff;
        }

        .btn-light {
            background-color: #f8f9fa;
            border: 1px solid #004080;
            color: #004080;
        }

        .btn-light:hover {
            background-color: #e2e6ea;
        }
        .bg-gradient-secondary {
            background: #6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="content py-5" style="background: #001f3f linear-gradient(180deg, #26415c, #001f3f) repeat-x !important;">
        <h4 class="font-weight-bolder" style="color: #fff;">Transaction Form</h4>
    </div>

    <div class="row align-items-center justify-content-center flex-column">
        <div class="col-lg-10 col-md-11 col-sm-12 col-xs-12">
            <div class="card rounded-0 shadow">
                <div class="card-header py-2">
                    <div class="card-title" style="color:#fff;"><b>Car Details</b></div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- Car Details Content -->
                        <div class="d-flex w-100">
						    <div class="col-3 mb-0 border bg-gradient-secondary">Brand:</div>
						    <div class="col-9 mb-0 border"><?= isset($vehicle['brand_name']) ? $vehicle['brand_name']: '' ?></div>
					    </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Car Type:</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['type_name']) ? $vehicle['type_name']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Model:</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['model_name']) ? $vehicle['model_name']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Engine Type:</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['engine_type']) ? $vehicle['engine_type']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
						    <div class="col-3 mb-0 border bg-gradient-secondary">Transmission Type:</div>
						    <div class="col-9 mb-0 border"><?= isset($vehicle['transmission_type']) ? $vehicle['transmission_type'] : '' ?></div>
					    </div>
                        <div class="clear-fix" style="margin-top:10px;"></div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Plate Number</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['plate_number']) ? $vehicle['plate_number']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Variant</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['variant']) ? $vehicle['variant']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Mileage</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['mileage']) ? $vehicle['mileage']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Engine Number</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['engine_number']) ? $vehicle['engine_number']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Chasis Number</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['chasis_number']) ? $vehicle['chasis_number']: '' ?></div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="col-3 mb-0 border bg-gradient-secondary">Price</div>
                            <div class="col-9 mb-0 border"><?= isset($vehicle['price']) ? $vehicle['price']: '' ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded-0 shadow">
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- Customer Details Form -->
                        <h5><b>Customer Details</b></h5>
                        <form action="transaction.php" id="transaction-form" method="post" class="update-form" onsubmit="return confirmSubmission()">
                        <!-- <form action="transaction.php" id="transaction-form" method="post" class="update-form"> -->
                            <input type="hidden" name="_token" value="n302Yx2NxglF4pv5Ht2MzB5s9GizoBDTQo9luSjW">
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label for="vehicle_id" class="control-label">Vehicle_ID</label>
                                    <div class="input-group">
                                        <input type="text" name="vehicle_id" id="vehicle_id" placeholder="Enter Vehicle ID" class="form-control form-control-sm rounded-0" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-car" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="buyer_id" class="control-label">Buyer_ID</label>
                                    <div class="input-group">
                                        <input type="text" name="buyer_id" id="buyer_id" placeholder="Enter Buyer ID" class="form-control form-control-sm rounded-0" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="seller_id" class="control-label">Seller_ID</label>
                                    <div class="input-group">
                                        <input type="text" name="seller_id" id="seller_id" placeholder="Enter Seller ID" class="form-control form-control-sm rounded-0" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="sex" class="control-label">Sex</label>
                                    <div class="input-group">
                                        <select name="sex" id="sex" class="form-control form-control-sm rounded-0" required="required">
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="dob" class="control-label">Birthday</label>
                                    <div class="input-group">
                                        <input type="text" name="dob" id="dob" placeholder="yyyy/mm/dd" class="form-control form-control-sm rounded-0" required/>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-cake"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="contact" class="control-label">Contact #</label>
                                    <div class="input-group">
                                        <input type="tel" name="contact" id="contact" placeholder="xxxx-xxxxxxx" class="form-control form-control-sm rounded-0" required/>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="comment" class="control-label">Comment</label>
                                    <div class="input-group">
                                        <textarea rows="3" name="comment" id="comment" class="form-control form-control-sm rounded-0" required></textarea>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-comment"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-2 text-center">
                                <button type="submit" name="submit" class="submit-btn"><i class="fa fa-save"></i> Save</button>
                                <a class="btn btn-sm btn-light border" href="vehicle_list.php"><i class="fa fa-angle-left"></i> Cancel</a>
                            </div>       
					    </form> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script>
        function confirmSubmission() 
        {
            // Show a confirmation dialog
            var confirmResult = confirm("Do you want to proceed after saving the form?");
                                                
            // If the user clicks "OK," the form will be submitted; otherwise, the submission will be canceled
            return confirmResult;
        }
    </script>
</body>

</html>

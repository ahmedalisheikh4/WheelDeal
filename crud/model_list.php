<?php
session_start();
include("../config/connection.php");

// Function to fetch all models from the database
function getAllModels() {
    global $con;
    try {
        $result = $con->query("SELECT model_list.*, brand_list.brand_name, car_type_list.type_name FROM model_list
                                JOIN brand_list ON model_list.brand_id = brand_list.brand_id
                                JOIN car_type_list ON model_list.type_id = car_type_list.type_id");
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        // Log or display the error
        die("Error fetching models: " . $e->getMessage());
    }
}

// Function to get a specific model by ID
function getModelById($model_id) {
    global $con;
    try {
        $stmt = $con->prepare("SELECT seller_id FROM `model_list` WHERE model_id = ?");
        $stmt->bind_param("i", $model_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $model = $result->fetch_assoc();
        $stmt->close();
        return $model;
    } catch (Exception $e) {
        // Log or display the error
        die("Error fetching seller ID: " . $e->getMessage());
    }
}

// Function to add a new model to the database
function addModel($brand_id, $model_name, $engine_type, $transmission_type, $type_id, $seller_id, $status) {
    global $con;
    try {
        $stmt = $con->prepare("INSERT INTO `model_list` (brand_id, model_name, engine_type, transmission_type, type_id, seller_id, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiii", $brand_id, $model_name, $engine_type, $transmission_type, $type_id, $seller_id, $status);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        // Log or display the error
        die("Error adding model: " . $e->getMessage());
    }
}

// Function to update a model in the database
function updateModel($model_id, $brand_id, $model_name, $engine_type, $transmission_type, $type_id, $seller_id, $status ) {
    global $con;
    
    // Check if the user has permission to update the model
    if ($user_id == $model['seller_id']) {
        // Proceed with the update
        try {
            $stmt = $con->prepare("UPDATE `model_list` SET brand_id = ?, model_name = ?, engine_type = ?, transmission_type = ?, type_id = ?, status = ? WHERE model_id = ?");
            $stmt->bind_param("isssiii", $brand_id, $model_name, $engine_type, $transmission_type, $type_id, $status, $model_id);
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            // Log or display the error
            die("Error updating model: " . $e->getMessage());
        }
    } else {
        // Unauthorized access
        die("Unauthorized access.");
    }
}


// Function to delete a model from the database
function deleteModel($model_id) {
    global $con;
    try {
        $stmt = $con->prepare("DELETE FROM `model_list` WHERE model_id = ?");
        $stmt->bind_param("i", $model_id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        // Log or display the error
        die("Error deleting model: " . $e->getMessage());
    }
}

// Check if the form is submitted for adding a new Model 
if (isset($_POST['addModel'])) {
    // Process form data for adding a new model
    $brand_id = $_POST['brand_id'];
    $model_name = $_POST['model_name'];
    $engine_type = $_POST['engine_type'];
    $transmission_type = $_POST['transmission_type'];
    $type_id = $_POST['type_id'];
    $status = $_POST['status'];

    // Check if the seller_id key is set in the session
    if (isset($_SESSION['user_id'])) {
        $seller_id = $_SESSION['user_id'];

        // Call the function to add a new model
        addModel($brand_id, $model_name, $engine_type, $transmission_type, $type_id, $seller_id, $status);

        // Redirect to the model list page or perform other actions
        header("Location: model_list.php");
        exit();
    }else{
        // Seller ID not set in the session
        die("Seller ID not found.");
    }
}

// Check if the form is submitted for updating a model
if (isset($_POST['updateModel'])) {

    // Get user_id from your session
    $user_id = $_SESSION['user_id']; // Update this line with your actual session variable

    $model_id = $_POST['update_id'];
    // Retrieve the existing vehicle details to check the user ID
    $existingModel = getModelById($model_id);

    // Check if the user has permission to update the vehicle
    if ($user_id == $existingModel['seller_id']) {
        
        //$model_id = $_POST['update_id'];
        $brand_id = $_POST['update_brand_id'];
        $model_name = $_POST['update_model_name'];
        $engine_type = $_POST['update_engine_type'];
        $transmission_type = $_POST['update_transmission_type'];
        $type_id = $_POST['update_type_id'];
        $status = $_POST['update_status']; // Add this line for status

        // Corrected function call parameters
        updateModel($model_id, $brand_id, $model_name, $engine_type, $transmission_type, $type_id, $seller_id, $status);

        header("Location: model_list.php");
        exit();
    }else{
        // Unauthorized access
        die("UNAUTHORIZED ACCESS.");
    }
}

// Check if the form is submitted for deleting a Model
if (isset($_POST['deleteModel'])) {

    // Get user_id from your session
    $user_id = $_SESSION['user_id']; // Update this line with your actual session variable

    // Process form data for deleting an existing model
    $model_id = $_POST['delete_id'];

    // Retrieve the existing vehicle details to check the user ID
    $existingmodel = getModelById($model_id);

    if ($user_id == $existingmodel['seller_id']) {
        // Call the function to delete the model
        deleteModel($model_id);

        // Redirect to the model list page or perform other actions
        header("Location: model_list.php");
        exit();
    }else {
        // Unauthorized access
        die("UNAUTHORIZED ACCESS.");
    }
}

// // Fetch all models
// try {
//     $models = getAllModels();
// } catch (Exception $e) {
//     // Log or display the error
//     die("Error fetching models: " . $e->getMessage());
// }
// Function to get a specific vehicle by ID
// function getModelById($model_id) {
//     global $con;
//     try {
//         $stmt = $con->prepare("SELECT * FROM `model_list` WHERE model_id = ?");
//         $stmt->bind_param("i", $model_id);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $vehicle = $result->fetch_assoc();
//         $stmt->close();
//         return $models;
//     } catch (Exception $e) {
//         // Log or display the error
//         die("Error fetching vehicle: " . $e->getMessage());
//     }
// }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Genius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,Sea">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Type List CRUD</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/front/images/favicon.png" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- responsive -->
    <link rel="stylesheet" href="../assets/front/css/responsive.css">
    <!-- custom -->
    <link rel="stylesheet" href="../assets/front/css/custom.css">
    <!-- base color -->
    <link rel="stylesheet" href="../assets/front/css/styles8353.css?color=ff5328">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .update-input {
            width: 70%;
            padding: 8px;
            box-sizing: border-box;
        }

        .update-button,
        .delete-button {
            display: flex;
            align-items: center;
        }
        
    </style>
</head>
<body>
<div class="col-lg-12">
    <div class="card card-outline rounded-0 card-navy">
        <div class="card-header">
            <h1>Model List</h1>
            <a href="../pages/cars.php" class="mybtn ml-4">GO BACK</a>
            <!-- Form for adding a new car type -->
            <form action="model_list.php" method="post">
                <div class="form-group">
                    <label for="brand_id">Brand:</label>
                    <select name="brand_id" required>
                        <?php
                            $brandResult = $con->query("SELECT * FROM `brand_list`");
                            while ($brand = $brandResult->fetch_assoc()) 
                            {
                                echo "<option value='{$brand['brand_id']}'>{$brand['brand_name']}</option>";
                            }
                        ?>
                    </select>
                    <br>
                    <label for="model_name">Model Name:</label>
                    <input type="text" name="model_name" required>
                    <br>
                    <label for="engine_type">Engine Type:</label>
                    <input type="text" name="engine_type" required>
                    <br>
                    <label for="transmission_type">Transmission Type:</label>
                    <input type="text" name="transmission_type" required>
                    <br>
                    <label for="type_id">Car Type:</label>
                    <select name="type_id" required>
                        <?php
                            $carTypeResult = $con->query("SELECT * FROM `car_type_list`");
                            while ($carType = $carTypeResult->fetch_assoc()) 
                            {
                                echo "<option value='{$carType['type_id']}'>{$carType['type_name']}</option>";
                            }
                        ?>
                        <br>
                        <br>
                    </select>
                    <br>
                    <br>
                    <br>
                    <label for="seller_id">Seller_ID:</label>
                    <input type="text" name="seller_id" required>
                    <br>
                    <br>
                    <div class="form-group" style="margin-top:15px;">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                    </div>
                    <br>
                    <input type="submit" name="addModel" value="Add Model">
                </div>
            </form>

            <!-- Display the list of models -->
            <h2 class="mt-4">All Models</h2>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Model ID</th>
                        <th>Brand</th>
                        <th>Model Name</th>
                        <th>Engine Type</th>
                        <th>Transmission Type</th>
                        <th>Car Type</th>
                        <th>Seller_ID</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $models = getAllModels();foreach ($models as $model): ?>
                        <tr>
                            <td><?= $model['model_id'] ?></td>
                            <td><?= $model['brand_name'] ?></td>
                            <td><?= $model['model_name'] ?></td>
                            <td><?= $model['engine_type'] ?></td>
                            <td><?= $model['transmission_type'] ?></td>
                            <td><?= $model['type_name'] ?></td>
                            <td><?= $model['seller_id'] ?></td>
                            <td class="text-center">
                                            <?php if($model['status'] == 1): ?>
                                                <span class="badge badge-success px-3 rounded-pill">Active</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                            <td>
                                <form action="model_list.php" method="post" class="update-form">
                                    <input type="hidden" name="update_id" value="<?= $model['model_id'] ?>">
                                    <label for="update_brand_id">Brand:</label>
                                    <select name="update_brand_id" required>
                                        <?php
                                        $brandResult = $con->query("SELECT * FROM `brand_list`");
                                        while ($brand = $brandResult->fetch_assoc()) {
                                            $selected = ($brand['brand_id'] == $model['brand_id']) ? "selected" : "";
                                            echo "<option value='{$brand['brand_id']}' {$selected}>{$brand['brand_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <label for="update_model_name">Model Name:</label>
                                    <input type="text" name="update_model_name" value="<?= $model['model_name'] ?>" required>
                                    <br>
                                    <label for="update_engine_type">Engine Type:</label>
                                    <input type="text" name="update_engine_type" value="<?= $model['engine_type'] ?>" required>
                                    <br>
                                    <label for="update_transmission_type">Transmission Type:</label>
                                    <input type="text" name="update_transmission_type" value="<?= $model['transmission_type'] ?>" required>
                                    <br>
                                    <label for="update_type_id">Car Type:</label>
                                    <select name="update_type_id" required>
                                        <?php
                                        $carTypeResult = $con->query("SELECT * FROM `car_type_list`");
                                        while ($carType = $carTypeResult->fetch_assoc()) {
                                            $selected = ($carType['type_id'] == $model['type_id']) ? "selected" : "";
                                            echo "<option value='{$carType['type_id']}' {$selected}>{$carType['type_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <label for="update_seller_id">Seller_ID:</label>
                                    <input type="text" name="update_seller_id" value="<?= $model['seller_id'] ?>" required>
                                    <br>
                                    <div class="d-flex align-items-center" style="margin-top:15px;">
                                        <label for="update_status">Status:</label>
                                        <br>
                                        <select name="update_status" class="form-control" required style="margin-left:15px;">
                                            <option value="1" <?php if ($model['status'] == 1) echo 'selected'; ?>>Active</option>
                                            <option value="0" <?php if ($model['status'] == 0) echo 'selected'; ?>>Inactive</option>
                                        </select>
                                        <br>
                                        <input type="submit" name="updateModel" value="Update" style="margin-left:15px;" class="btn btn-primary ml-2">
                                    </div>
                                </form>
                                <form action="model_list.php" method="post" class="delete-form ml-2">
                                    <input type="hidden" name="delete_id" value="<?= $model['model_id'] ?>">
                                    <input type="submit" name="deleteModel" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy8RA9+eFZL/D85iS6LBd0Y5qtS6xgMz" crossorigin="anonymous"></script>
</body>
</html>
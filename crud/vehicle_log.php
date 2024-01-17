<?php
session_start();
include("../config/connection.php");

// Function to fetch all vehicles from the database
function getAllVehicles() {
    global $con;
    try {
        $result = $con->query("SELECT vehicle_log.*, model_list.model_name FROM vehicle_log
                                JOIN model_list ON vehicle_log.model_id = model_list.model_id");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    } catch (Exception $e) {
        // Log or display the error
        die("Error fetching vehicles: " . $e->getMessage());
    }
}
// Function to get a specific vehicle by ID
function getVehicleById($vehicle_id) {
    global $con;
    try {
        $stmt = $con->prepare("SELECT * FROM `vehicle_log` WHERE vehicle_id = ?");
        $stmt->bind_param("i", $vehicle_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $vehicle = $result->fetch_assoc();
        $stmt->close();
        return $vehicle;
    } catch (Exception $e) {
        // Log or display the error
        die("Error fetching vehicle: " . $e->getMessage());
    }
}


// Function to delete a vehicle from the database
function deleteVehicle($vehicle_id) {
    global $con;
    try {
        $stmt = $con->prepare("DELETE FROM `vehicle_log` WHERE vehicle_id = ?");
        $stmt->bind_param("i", $vehicle_id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        // Log or display the error
        die("Error deleting vehicle: " . $e->getMessage());
    }
}

// Check if the form is submitted for deleting a vehicle
if (isset($_POST['deleteVehicle'])) {
    // Get user_id from your session
    $user_id = $_SESSION['user_id']; // Update this line with your actual session variable

    // Process form data for deleting an existing vehicle
    $vehicle_id = $_POST['delete_id'];

    // Retrieve the existing vehicle details to check the user ID
    $existingVehicle = getVehicleById($vehicle_id);

    // Check if the user has permission to delete the vehicle
    if ($user_id == $existingVehicle['seller_id']) {
        // Call the function to delete the vehicle
        deleteVehicle($vehicle_id);

        // Redirect to the vehicle list page or perform other actions
        header("Location: vehicle_list.php");
        exit();
    } else {
        // Unauthorized access
        die("UNAUTHORIZED ACCESS.");
    }
}

// Function to recover a vehicle from the vehicle_log table
function recoverVehicle($vehicle_id) {
    global $con;
    try {
        // Retrieve vehicle details from the vehicle_log
        $stmt = $con->prepare("SELECT * FROM `vehicle_log` WHERE vehicle_id = ?");
        $stmt->bind_param("i", $vehicle_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $vehicle = $result->fetch_assoc();
        $stmt->close();

        // Check if the vehicle details are found
        if ($vehicle) {
            // Insert the recovered vehicle into the vehicle_list table
            $stmt = $con->prepare("INSERT INTO `vehicle_list` (vehicle_id, model_id, plate_number, variant, mileage, engine_number, chasis_number, price, seller_id, status, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisssssdisi",$vehicle['vehicle_id'], $vehicle['model_id'], $vehicle['plate_number'], $vehicle['variant'], $vehicle['mileage'], $vehicle['engine_number'], $vehicle['chasis_number'], $vehicle['price'], $vehicle['seller_id'], $vehicle['status'], $vehicle['image']);
            $stmt->execute();
            $stmt->close();

            //Delete the recovered vehicle from the vehicle_log
            $stmt = $con->prepare("DELETE FROM `vehicle_log` WHERE vehicle_id = ?");
            $stmt->bind_param("i", $vehicle_id);
            $stmt->execute();
            $stmt->close();
        } else {
            // Handle the case when the vehicle details are not found
            die("Error recovering vehicle: Vehicle details not found.");
        }
    } catch (Exception $e) {
        // Log or display the error
        die("Error recovering vehicle: " . $e->getMessage());
    }
}



// Check if the form is submitted for recovering a vehicle
if (isset($_POST['recoverVehicle'])) {
    // Get user_id from your session
    $user_id = $_SESSION['user_id']; // Update this line with your actual session variable

    // Process form data for recovering an existing vehicle
    $vehicle_id = $_POST['recover_id'];

    // Retrieve the existing vehicle details to check the user ID
    $existingVehicle = getVehicleById($vehicle_id);

    // Check if the user has permission to recover the vehicle
    if ($user_id == $existingVehicle['seller_id']) {
        // Call the function to recover the vehicle
        recoverVehicle($vehicle_id);

        // Redirect to the vehicle list page or perform other actions
        header("Location: vehicle_list.php");
        exit();
    } else {
        // Unauthorized access
        die("UNAUTHORIZED ACCESS.");
    }
}



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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-aG0UBBx6jAZoA2MHP1O2wxM5wPCL2RDn5S9FvA6aR/hDWEHiOtTA9Rfls4lBYL3F" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <!-- ... (same as your existing HTML body) ... -->
    <div class="col-lg-12">
        <div class="card card-outline rounded-0 card-navy">
            <div class="card-header">
                <h1>Vehicle List</h1>
                <a href="vehicle_list.php" class="mybtn ml-4">GO BACK</a>
                <!-- Display the list of vehicles -->
                <h2 class="mt-4">All Vehicles Log</h2>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Vehicle ID</th>
                            <th>Model Name</th>
                            <th>Plate No.</th>
                            <th>Variant</th>
                            <th>Mileage</th>
                            <th>Engine No.</th>
                            <th>Chasis Mo.</th>
                            <th>Price</th>
                            <th>Seller_ID</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $vehicles = getAllVehicles();foreach ($vehicles as $vehicle): ?>
                            <tr>
                                <td><?= $vehicle['vehicle_id'] ?></td>
                                <td><?= $vehicle['model_name'] ?></td>
                                <td><?= $vehicle['plate_number'] ?></td>
                                <td><?= $vehicle['variant'] ?></td>
                                <td><?= $vehicle['mileage'] ?></td>
                                <td><?= $vehicle['engine_number'] ?></td>
                                <td><?= $vehicle['chasis_number'] ?></td>
                                <td><?= $vehicle['price'] ?></td>
                                <td><?= $vehicle['seller_id'] ?></td>
                                <td><?= $vehicle['image'] ?></td>
                                <td class="text-center">
                                    <?php if($vehicle['status'] == 1): ?>
                                        <span class="badge badge-success px-3 rounded-pill">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
                                    <?php endif; ?>
                                   
                                </td>
                                <td><?= $vehicle['action'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Add the Recover button outside the loop -->
                <form action="vehicle_log.php" method="post" class="recover-form">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <?php if ($vehicle['status'] == 1): ?>
                            <input type="hidden" name="recover_id" value="<?= $vehicle['vehicle_id'] ?>">
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <input type="submit" name="recoverVehicle" value="Recover" class="btn btn-success btn-sm">
                </form>
            </div>
        </div>
    </div>
<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy8RA9+eFZL/D85iS6LBd0Y5qtS6xgMz" crossorigin="anonymous"></script>
</body>
</html>
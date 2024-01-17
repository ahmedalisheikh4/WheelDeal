<?php
include("../config/connection.php");

// Function to fetch all car types from the database
function getAllCarTypes() {
    global $con;
    try {
        $result = $con->query("SELECT * FROM `car_type_list`");
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        // Log or display the error
        die("Error fetching car types: " . $e->getMessage());
    }
}

// Function to add a new car type to the database
function addCarType($type_name, $status) {
    global $con;
    try {
        $stmt = $con->prepare("INSERT INTO `car_type_list` (type_name, status) VALUES (?, ?)");
        $stmt->bind_param("si", $type_name, $status);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        // Log or display the error
        die("Error adding car type: " . $e->getMessage());
    }
}

// Function to update a car type in the database
function updateCarType($type_id, $type_name, $status) {
    global $con;
    try {
        $stmt = $con->prepare("UPDATE `car_type_list` SET type_name = ?, status = ? WHERE type_id = ?");
        $stmt->bind_param("sii", $type_name, $status, $type_id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        // Log or display the error
        die("Error updating car type: " . $e->getMessage());
    }
}

// Function to delete a car type from the database
function deleteCarType($type_id) {
    global $con;
    try {
        $stmt = $con->prepare("DELETE FROM `car_type_list` WHERE type_id = ?");
        $stmt->bind_param("i", $type_id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        // Log or display the error
        die("Error deleting car type: " . $e->getMessage());
    }
}

// Check if the form is submitted for adding a new car type
if (isset($_POST['addCarType'])) {
    $car_type_name = $_POST['type_name'];
    $status = $_POST['status']; // Assuming you have a dropdown or radio button for status

    addCarType($car_type_name, $status);
    header("Location: car_type_list.php");
    exit();
}

// Check if the form is submitted for updating a car type
if (isset($_POST['updateCarType'])) {
    $car_type_id = $_POST['update_type_id'];
    $car_type_name = $_POST['update_type_name'];
    $status = $_POST['update_status']; // Assuming you have a dropdown or radio button for status

    // Corrected function call parameters
    updateCarType($car_type_id, $car_type_name, $status);

    header("Location: car_type_list.php");
    exit();
}


// Check if the form is submitted for deleting a car type
if (isset($_POST['deleteCarType'])) {
    $car_type_id = $_POST['delete_type_id'];

    deleteCarType($car_type_id);
    header("Location: car_type_list.php");
    exit();
}


// Fetch all car types
try {
    $carTypes = getAllCarTypes();
} catch (Exception $e) {
    // Log or display the error
    die("Error fetching car types: " . $e->getMessage());
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
            <h1>Car Types</h1>
                <a href="../pages/cars.php" class="mybtn ml-4">GO BACK</a>
                <!-- Form for adding a new car type -->
                <form action="../crud/car_type_list.php" method="post">
                    <div class="form-group">
                    <label for="type_name">Car Type Name:</label>
                        <input type="text" class="form-control" name="type_name" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="addCarType" value="Add Car Type">
                </form>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <!-- Display the list of car types -->
                <h2>All Car Types</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Car Type ID</th>
                            <th>Car Type Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carTypes as $carType): ?>
                            <tr>
                                <td><?= $carType['type_id'] ?></td>
                                <td><?= $carType['type_name'] ?></td>
                                <td class="text-center">
                                    <?php if($carType['status'] == 1): ?>
                                        <span class="badge badge-success px-3 rounded-pill">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="action-buttons">
                                    <form action="../crud/car_type_list.php" method="post" class="update-form">
                                        <input type="hidden" name="update_type_id" value="<?= $carType['type_id'] ?>">
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="update-input form-control" name="update_type_name" value="<?= $carType['type_name'] ?>" required>
                                            <select name="update_status" class="form-control" required style="margin-bottom: 14px; margin-left: 5px ">
                                                <option value="1" <?php if ($carType['status'] == 1) echo 'selected'; ?>>Active</option>
                                                <option value="0" <?php if ($carType['status'] == 0) echo 'selected'; ?>>Inactive</option>
                                            </select>
                                            <input type="submit" class="btn btn-success ml-2" name="updateCarType" value="Update" style="margin-bottom: 15px">
                                        </div>
                                    </form>
                                    <form action="../crud/car_type_list.php" method="post" class="delete-form">
                                        <input type="hidden" name="delete_type_id" value="<?= $carType['type_id'] ?>">
                                        <input type="submit" class="btn btn-danger ml-2" name="deleteCarType" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>

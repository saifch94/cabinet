<?php
include '../db_connection.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, handle update logic
    $id = $_POST['id'];
    $dateS = $_POST['dateS'];
    $heureS = $_POST['heureS'];
    $typeSoin = $_POST['typeSoin'];
    $idP = $_POST['Patient']; // Changed to match select name attribute
    $idK = $_POST['Kine']; // Changed to match select name attribute

    $sql = "UPDATE Séance SET DateS='$dateS', HeureS='$heureS', TypeSoin='$typeSoin', IdP='$idP', IdK='$idK' WHERE IdS=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../superadmin.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Display the HTML form
    $id = $_GET['id'];
    $sql = "SELECT * FROM Séance WHERE IdS = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Séance</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Séance</div>
                <div class="card-body">
                    <form action="edit.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['IdS']; ?>">
                        <div class="form-group">
                            <label for="dateS">Date:</label>
                            <input type="date" name="dateS" class="form-control" value="<?php echo $row['DateS']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="heureS">Heure:</label>
                            <input type="time" name="heureS" class="form-control" value="<?php echo $row['HeureS']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="typeSoin">Type de Soin:</label>
                            <input type="text" name="typeSoin" class="form-control" value="<?php echo $row['TypeSoin']; ?>">
                        </div>
                        <!-- Dropdown for selecting Patient -->
                        <div class="form-group">
                            <label for="Patient">Patient:</label>
                            <select name="Patient" class="form-control">
                                <?php
                                $sql_patients = "SELECT * FROM Patient";
                                $result_patients = $conn->query($sql_patients);
                                while ($row_patient = $result_patients->fetch_assoc()) {
                                    echo "<option value='" . $row_patient['IdP'] . "'";
                                    if ($row['IdP'] == $row_patient['IdP']) echo " selected";
                                    echo ">" . $row_patient['firstname'] . " " . $row_patient['lastname'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Dropdown for selecting Kiné -->
                        <div class="form-group">
                            <label for="Kine">Kiné:</label>
                            <select name="Kine" class="form-control">
                                <?php
                                $sql_kines = "SELECT * FROM Kiné";
                                $result_kines = $conn->query($sql_kines);
                                while ($row_kine = $result_kines->fetch_assoc()) {
                                    echo "<option value='" . $row_kine['IdK'] . "'";
                                    if ($row['IdK'] == $row_kine['IdK']) echo " selected";
                                    echo ">" . $row_kine['NomK'] . " " . $row_kine['PrénomK'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

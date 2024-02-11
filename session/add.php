<?php
include '../db_connection.php';

// Fetch list of patients excluding those with roleP = 'ADMIN'
$sql_patients = "SELECT IdP, firstname, lastname FROM Patient WHERE roleP != 'ADMIN'";
$result_patients = $conn->query($sql_patients);

$sql_kiné = "SELECT IdK, NomK, PrénomK FROM Kiné";
$result_kiné = $conn->query($sql_kiné);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idK = $_POST['idK'];
    $idP = $_POST['idP']; // This will now contain the selected patient's IdP
    $dateS = $_POST['dateS'];
    $heureS = $_POST['heureS'];
    $typeSoin = $_POST['typeSoin'];

    $sql = "INSERT INTO Séance (IdK, IdP, DateS, HeureS, TypeSoin) VALUES ('$idK', '$idP', '$dateS', '$heureS', '$typeSoin')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../superadmin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Séance</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add Séance</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="idK">Kiné Name:</label>
                            <select name="idK" class="form-control">
                                <?php while ($row = $result_kiné->fetch_assoc()): ?>
                                    <option value="<?php echo $row['IdK']; ?>"><?php echo $row['NomK'] . ' ' . $row['PrénomK']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idP">Patient :</label>
                            <select name="idP" class="form-control">
                                <?php while ($row = $result_patients->fetch_assoc()): ?>
                                    <option value="<?php echo $row['IdP']; ?>"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateS">Date:</label>
                            <input type="date" name="dateS" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="heureS">Heure:</label>
                            <input type="time" name="heureS" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="typeSoin">Type de Soin:</label>
                            <input type="text" name="typeSoin" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Séance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

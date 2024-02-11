<?php
include '../db_connection.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nomK = $_POST['nomK'];
    $prenomK = $_POST['prenomK'];
    $sql = "UPDATE Kiné SET NomK='$nomK', PrénomK='$prenomK' WHERE IdK=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../superadmin.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Kiné WHERE IdK = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kiné</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Kiné</div>
                <div class="card-body">
                    <form action="edit.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['IdK']; ?>">
                        <div class="form-group">
                            <label for="nomK">Nom:</label>
                            <input type="text" name="nomK" class="form-control" value="<?php echo $row['NomK']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="prenomK">Prénom:</label>
                            <input type="text" name="prenomK" class="form-control" value="<?php echo $row['PrénomK']; ?>">
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

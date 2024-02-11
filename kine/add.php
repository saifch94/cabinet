<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomK = $_POST['nomK'];
    $prenomK = $_POST['prenomK'];

    $sql = "INSERT INTO Kiné (NomK, PrénomK) VALUES ('$nomK', '$prenomK')";
    
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
  <title>Add Kiné</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Add Kiné</div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="nomK">Nom:</label>
                <input type="text" name="nomK" class="form-control">
              </div>
              <div class="form-group">
                <label for="prenomK">Prénom:</label>
                <input type="text" name="prenomK" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Add Kiné</button>
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

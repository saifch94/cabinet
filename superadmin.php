<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

// Fetch list of Séances
$sql_séance = "SELECT Séance.*, Kiné.NomK AS Kiné_Nom, Kiné.PrénomK AS Kiné_Prénom, Patient.firstname AS Patient_Nom, Patient.lastname AS Patient_Prénom
                FROM Séance
                LEFT JOIN Kiné ON Séance.IdK = Kiné.IdK
                LEFT JOIN Patient ON Séance.IdP = Patient.IdP";
$result_séance = $conn->query($sql_séance);

// Fetch list of Kiné
$sql_kiné = "SELECT * FROM Kiné";
$result_kiné = $conn->query($sql_kiné);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>gestion des séances de kinésithérapie</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Gestion des séances de kinésithérapie</div>

        <a href="./logout.php" class="btn btn-danger">Logout</a>
          <div class="card-body">
            <h3>Gestion Séances</h3>
            <a href="./session/add.php" class="btn btn-primary">Ajouter Séance</a>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th>N#</th>
                  <th>Kiné</th>
                  <th>Patient</th>
                  <th>Date</th>
                  <th>Heure</th>
                  <th>Type de Soin</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $result_séance->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['IdS']; ?></td>
                    <td><?php echo $row['Kiné_Nom'] . ' ' . $row['Kiné_Prénom']; ?></td>
                    <td><?php echo $row['Patient_Nom'] . ' ' . $row['Patient_Prénom']; ?></td>
                    <td><?php echo $row['DateS']; ?></td>
                    <td><?php echo $row['HeureS']; ?></td>
                    <td><?php echo $row['TypeSoin']; ?></td>
                    <td>
                      <a href="./session/edit.php?id=<?php echo $row['IdS']; ?>" class="btn btn-primary btn-sm">Edit</a>
                      <a href="./session/delete.php?id=<?php echo $row['IdS']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
            <h3 class="mt-5">Gestion Kiné</h3>
            <a href="./kine/add.php" class="btn btn-primary">Ajouter Kiné</a>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th>N#</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $result_kiné->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['IdK']; ?></td>
                    <td><?php echo $row['NomK']; ?></td>
                    <td><?php echo $row['PrénomK']; ?></td>
                    <td>
                      <a href="./kine/edit.php?id=<?php echo $row['IdK']; ?>" class="btn btn-primary btn-sm">Edit</a>
                      <a href="./kine/delete.php?id=<?php echo $row['IdK']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
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

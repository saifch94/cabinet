<?php
session_start();

// Include database connection
include 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get the username from session
$username = $_SESSION['username'];

// Query to get the id of the connected username
$sql_id = "SELECT IdP FROM Patient WHERE uname = '$username'";
$result_id = $conn->query($sql_id);

// Check if query was successful
if ($result_id->num_rows > 0) {
    // Fetch the id from the result set
    $row = $result_id->fetch_assoc();
    $id = $row['IdP'];
    
    // Query to get the séance details for the connected user
    $sql_séance = "SELECT Séance.*, Kiné.NomK AS Kiné_Nom, Kiné.PrénomK AS Kiné_Prénom
                    FROM Séance
                    LEFT JOIN Kiné ON Séance.IdK = Kiné.IdK
                    WHERE Séance.IdP = $id";
    $result_séance = $conn->query($sql_séance);

    // Check if there are sessions for the user
    if ($result_séance->num_rows > 0) {
        // Fetch the séance details
        $sessions = array();
        while ($row_séance = $result_séance->fetch_assoc()) {
            $sessions[] = $row_séance;
        }
    } else {
        $sessions = array(); // No sessions found
    }
} else {
    $sessions = array(); // User not found
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Patient Dashboard</div>
          <div class="card-body">
            <h3>Séances</h3>
            <?php if (!empty($sessions)): ?>
              <table class="table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Type de Soin</th>
                    <th>Kiné</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sessions as $session): ?>
                    <tr>
                      <td><?php echo $session['DateS']; ?></td>
                      <td><?php echo $session['HeureS']; ?></td>
                      <td><?php echo $session['TypeSoin']; ?></td>
                      <td><?php echo $session['Kiné_Nom'] . ' ' . $session['Kiné_Prénom']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>No sessions found.</p>
            <?php endif; ?>
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

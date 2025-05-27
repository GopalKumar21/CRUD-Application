<?php
$insert = isset($_GET['insert']) && $_GET['insert'] === "1";
$update = isset($_GET['update']) && $_GET['update'] === "1";
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "students";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
  $studentId = $_GET['delete'];
  $sql = "DELETE FROM records WHERE `Student Id`='$studentId'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $delete = true;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $StudentName = $_POST['studentName'];
  $StudentId = $_POST['studentId'];
  $PhoneNumber = $_POST['phoneNumber'];
  $Email = $_POST['studentEmail'];
  $Campus = $_POST['campus'];

  if (isset($_POST['snoEdit']) && !empty($_POST['snoEdit'])) {
    $studentId = $_POST['snoEdit'];
    $sql = "UPDATE records SET `Student Name`='$StudentName', `Phone Number`='$PhoneNumber', `Email`='$Email', `Campus`='$Campus' WHERE `Student Id`='$studentId'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      header("Location: index.php?update=1");
      exit();
    }
  } else {
    $sql = "INSERT INTO records (`Student Name`, `Student Id`, `Phone Number`, `Email`, `Campus`) VALUES ('$StudentName', '$StudentId', '$PhoneNumber', '$Email', '$Campus')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      header("Location: index.php?insert=1");
      exit();
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="//cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Custom Dark Neon CSS -->
  <link rel="stylesheet" href="style.css">
  <title>CRUD APPLICATION</title>
  
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" style="color: beige;">CRUD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php" style="color: beige;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="About.html" style="color: beige;">About</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Record has been added successfully.
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
    </div>";
  }
  if ($update) {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>Updated!</strong> Record has been updated successfully.
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
    </div>";
  }
  if ($delete) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Deleted!</strong> Record has been deleted.
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
    </div>";
  }
  ?>

  <div class="container my-5 p-4 border rounded bg-light">
    <h3 class="text-center">ADD RECORD</h3>
    <form action="index.php" method="POST">
      <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="mb-3">
        <label for="studentName">Student Name</label>
        <input type="text" class="form-control" id="studentName" name="studentName" required>
      </div>
      <div class="mb-3">
        <label for="studentId">Student ID</label>
        <input type="number" class="form-control" id="studentId" name="studentId" required>
      </div>
      <div class="mb-3">
        <label for="phoneNumber">Phone Number</label>
        <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" required>
      </div>
      <div class="mb-3">
        <label for="studentEmail">Email address</label>
        <input type="email" class="form-control" id="studentEmail" name="studentEmail" required>
      </div>
      <div class="mb-3">
        <label for="campus">Campus</label>
        <select class="form-control" id="campus" name="campus" required>
          <option value="" disabled selected>-- Select Campus --</option>
          <option value="haldwani">Haldwani</option>
          <option value="bhimtal">Bhimtal</option>
          <option value="dehradun">Dehradun</option>
        </select>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>

  <div class="section-divider"></div>

  <div class="container my-4">
    <h3 class="text-center">STUDENT RECORDS</h3>
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Student Name</th>
          <th scope="col">Student Id</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Email</th>
          <th scope="col">Campus</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM records";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno++;
          echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['Student Name'] . "</td>
            <td>" . $row['Student Id'] . "</td>
            <td>" . $row['Phone Number'] . "</td>
            <td>" . $row['Email'] . "</td>
            <td>" . $row['Campus'] . "</td>
            <td>
              <button class='edit btn btn-sm btn-warning' data-id='" . $row['Student Id'] . "'>Edit</button>
              <a href='index.php?delete=" . $row['Student Id'] . "' class='delete btn btn-sm btn-danger'>Delete</a>
            </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

      $('.edit').click(function () {
        const tr = $(this).closest('tr');
        const studentName = tr.find('td:eq(0)').text();
        const studentId = tr.find('td:eq(1)').text();
        const phoneNumber = tr.find('td:eq(2)').text();
        const email = tr.find('td:eq(3)').text();
        const campus = tr.find('td:eq(4)').text();

        $('#studentName').val(studentName);
        $('#studentId').val(studentId).prop('readonly', true);
        $('#phoneNumber').val(phoneNumber);
        $('#studentEmail').val(email);
        $('#campus').val(campus);
        $('#snoEdit').val(studentId);
        $('html, body').animate({ scrollTop: 0 }, 'fast');
      });
    });
  </script>
</body>
</html>
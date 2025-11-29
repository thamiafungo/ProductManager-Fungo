<?php
  $page = 'Customers'; 
  include 'functions/connectdb.php'; 
  $conn = Connect(); 

  if(isset($_POST['add_customer'])){
      $code = $_POST['cus_code'];
      $fname = $_POST['cus_fname'];
      $lname = $_POST['cus_lname'];
      $initial = $_POST['cus_initial'];
      $area = $_POST['cus_areacode'];
      $phone = $_POST['cus_phone'];
      $balance = $_POST['cus_balance'];

      $sql_insert = "INSERT INTO customer (cus_code, cus_fname, cus_lname, cus_initial, cus_areacode, cus_phone, cus_balance) 
                     VALUES ('$code', '$fname', '$lname', '$initial', '$area', '$phone', '$balance')";
      
      if($conn->query($sql_insert) === TRUE){
          echo "<script>alert('Customer added successfully!');</script>";
      } else {
          echo "Error: " . $conn->error;
      }
  }
?>
<!doctype html>
<html lang="en">
 <?php include 'component/head.php'; ?>
  <body>
 <?php include 'component/nav.php'; ?>   

<div class="container-fluid">
  <div class="row">
    <?php include 'component/sidebar.php'; ?>  

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customers</h1>        
      </div>

      <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Add New Customer</h5>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <input type="text" class="form-control" name="cus_code" placeholder="Code (e.g. 101)" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="cus_fname" placeholder="First Name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="cus_lname" placeholder="Last Name" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="text" class="form-control" name="cus_initial" placeholder="Initial" maxlength="2">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <input type="text" class="form-control" name="cus_areacode" placeholder="Area Code" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" name="cus_phone" placeholder="Phone" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="number" step="0.01" class="form-control" name="cus_balance" placeholder="Balance (0.00)" required>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-block" type="submit" name="add_customer">Add Customer</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

      <h3>Customer Records</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Code</th>
              <th>Full Name</th>
              <th>Initial</th>
              <th>Area</th>
              <th>Phone</th>
              <th>Balance</th>
            </tr>
          </thead>
          <tbody>

            <?php
              $sql = "SELECT * FROM customer";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['cus_code'] . "</td>";
                      echo "<td>" . $row['cus_fname'] . " " . $row['cus_lname'] . "</td>";
                      echo "<td>" . $row['cus_initial'] . "</td>";
                      echo "<td>" . $row['cus_areacode'] . "</td>";
                      echo "<td>" . $row['cus_phone'] . "</td>";
                      echo "<td>" . $row['cus_balance'] . "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </div>

    </main>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
  </body>
</html>
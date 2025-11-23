<?php
$page = 'Orders';
include 'component/head.php';
include 'component/sidebar.php';
include 'component/nav.php';
include 'functions/connectdb.php'; 

$conn = Connect();

$sql = "SELECT 
            i.inv_number, 
            c.cus_lname,
            c.cus_fname,
            c.cus_initial,
            i.inv_date,
            i.inv_subtotal,
            i.inv_tax,
            i.inv_total
        FROM invoice i
        JOIN customer c ON i.cus_code = c.cus_code
        ORDER BY i.inv_date DESC";

$result = $conn->query($sql);
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Orders</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>Invoice #</th>
          <th>Customer Name</th>
          <th>Date</th>
          <th>Sub Total</th>
          <th>Tax</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
      <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customerName = $row['cus_lname'] . ', ' . $row['cus_fname'] . ' ' . ($row['cus_initial'] ?? '');
                echo "<tr>
                        <td>" . htmlspecialchars($row['inv_number']) . "</td>
                        <td>" . htmlspecialchars($customerName) . "</td>
                        <td>" . date('d M Y', strtotime($row['inv_date'])) . "</td>
                        <td>" . number_format($row['inv_subtotal'], 2) . "</td>
                        <td>" . number_format($row['inv_tax'], 2) . "</td>
                        <td>" . number_format($row['inv_total'], 2) . "</td>
                      </tr>";
            }
        } else {
            echo '<tr><td colspan="6" class="text-center">No orders found.</td></tr>';
        }
      ?>
      </tbody>
    </table>
  </div>
</main>

<?php
$conn->close();
?>

<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: admin.php"); exit; }
include("db.php");

if(isset($_GET['status']) && isset($_GET['id'])){
  $id=(int)$_GET['id']; $st=mysqli_real_escape_string($con,$_GET['status']);
  mysqli_query($con,"UPDATE orders SET status='$st' WHERE id=$id");
  header("Location: admin_orders.php"); exit;
}
if(isset($_GET['delete'])){
  $id=(int)$_GET['delete']; mysqli_query($con,"DELETE FROM orders WHERE id=$id");
  header("Location: admin_orders.php"); exit;
}
$orders=mysqli_query($con,"SELECT o.*, u.name, u.email, u.phone FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.id DESC");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0;font-family:Arial;background:#f5f0eb}
.header{background:#6b2c1a;color:#fff;padding:12px 20px;display:flex;justify-content:space-between;align-items:center}
.header a{color:#fff;text-decoration:none;font-weight:bold;margin:0 8px}
.table-container{width:96%;margin:20px auto;background:#fff;border-radius:12px;overflow-x:auto;box-shadow:0 4px 12px rgba(0,0,0,0.1)}
table{width:100%;border-collapse:collapse;min-width:1100px}
th{padding:14px 12px;background:#6b2c1a;color:#fff;font-size:13px;text-align:left;white-space:nowrap}
td{padding:12px 12px;border-bottom:1px solid #eee;font-size:13px;vertical-align:top}
tr:hover{background:#fff8f0}
.badge{padding:4px 10px;border-radius:12px;font-size:11px;font-weight:bold}
.pending{background:#fff3cd;color:#856404}.confirmed{background:#d1ecf1;color:#0c5460}.delivered{background:#d4edda;color:#155724}.cancelled{background:#f8d7da;color:#721c24}
.btn{padding:6px 12px;border-radius:15px;text-decoration:none;color:#fff;font-size:11px;font-weight:bold;display:inline-block;margin:2px;white-space:nowrap}
.view{background:#6b2c1a}.confirm{background:#ff9800}.done{background:#28a745}.cancel{background:#d32f2f}.del{background:#000}
</style></head><body>
<div class="header">
<div><a href="dashboard.php">← DASHBOARD</a> All Orders - Receipt & Payment</div>
<div><a href="admin_stock.php">STOCK</a> <a href="admin_add.php">+ ADD</a> <a href="index.php" target="_blank">HOME</a></div>
</div>

<div class="table-container">
<table>
<tr>
<th>ID & Date</th>
<th>Customer & Address</th>
<th>Amount</th>
<th>Payment (UPI/QR/COD)</th>
<th>Status</th>
<th>Receipt + Action</th>
</tr>
<?php while($o=mysqli_fetch_assoc($orders)){ ?>
<tr>
<td><b>#<?php echo $o['id']; ?></b><br><small><?php echo $o['created_at']; ?></small></td>
<td>
<b><?php echo $o['name']; ?></b><br>
<small><?php echo $o['email']; ?></small><br>
<small>📞 <?php echo $o['phone']; ?></small><br>
<small>📍 <?php echo $o['address']; ?></small>
</td>
<td><b>₹<?php echo $o['total']; ?></b></td>
<td>
<?php echo $o['payment_method']; ?><br>
<small><?php echo $o['payment_status']; ?></small><br>
<small>Txn: <?php echo $o['txn_id'] ?? 'COD'; ?></small>
</td>
<td><span class="badge <?php echo strtolower($o['status']); ?>"><?php echo $o['status']; ?></span></td>
<td>
<a href="receipt.php?order_id=<?php echo $o['id']; ?>" target="_blank" class="btn view">🧾 View Receipt</a><br>
<a href="?id=<?php echo $o['id']; ?>&status=Confirmed" class="btn confirm">Confirm</a>
<a href="?id=<?php echo $o['id']; ?>&status=Delivered" class="btn done">Delivered</a>
<a href="?id=<?php echo $o['id']; ?>&status=Cancelled" class="btn cancel">Cancel</a><br>
<a href="?delete=<?php echo $o['id']; ?>" class="btn del" onclick="return confirm('Delete order?')">🗑️ Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>

</body></html>
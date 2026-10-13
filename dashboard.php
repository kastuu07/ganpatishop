<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: admin.php"); exit; }
include("db.php");
$users = mysqli_num_rows(mysqli_query($con,"SELECT id FROM users"));
$orders = mysqli_num_rows(mysqli_query($con,"SELECT id FROM orders"));
$pending = mysqli_num_rows(mysqli_query($con,"SELECT id FROM orders WHERE status='Pending'"));
$revenue = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(total) as t FROM orders WHERE payment_status='Paid'"))['t'] ?? 0;
$low = mysqli_num_rows(mysqli_query($con,"SELECT id FROM products WHERE stock < 5"));
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0;font-family:Arial;background:#f0eeea}
.header{background:#6b2c1a;color:#fff;padding:12px 20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}
.header a{color:#fff;text-decoration:none;margin:0 8px;font-weight:bold;font-size:13px}
.grid{display:flex;flex-wrap:wrap;gap:15px;padding:20px;max-width:1000px;margin:auto;justify-content:center}
.card{background:#fff;width:210px;padding:20px;border-radius:14px;text-align:center;box-shadow:0 4px 10px rgba(0,0,0,0.1);text-decoration:none;color:#333;display:block;transition:0.2s;border:2px solid transparent}
.card:hover{transform:scale(1.05);border-color:#6b2c1a}
.card h2{color:#6b2c1a;margin:5px}
.btn-big{padding:12px 20px;border-radius:8px;text-decoration:none;display:inline-block;margin:5px;font-weight:bold;color:#fff}
</style></head><body>
<div class="header">
<div><b>🙏 Admin Panel</b> | Only Admin Can See</div>
<div>
<a href="index.php" target="_blank" style="background:#2e7d32;padding:6px 12px;border-radius:15px">🏠 VIEW HOME PAGE</a>
<a href="dashboard.php">DASHBOARD</a>
<a href="admin_orders.php">ORDERS</a>
<a href="admin_stock.php">STOCK</a>
<a href="admin_add.php">ADD</a>
<a href="admin_logout.php" style="background:#fff;color:#6b2c1a;padding:6px 12px;border-radius:15px">LOGOUT</a>
</div>
</div>

<div class="grid">
<a href="admin_users.php" class="card"><h2><?php echo $users; ?></h2><small>👥 Total Users<br><span style="color:#6b2c1a;font-size:11px">Click to open →</span></small></a>
<a href="admin_orders.php" class="card"><h2><?php echo $orders; ?></h2><small>📦 Total Orders<br><span style="color:#6b2c1a;font-size:11px">Click to open →</span></small></a>
<a href="admin_orders.php" class="card"><h2>₹<?php echo $revenue; ?></h2><small>💰 Paid Revenue<br><span style="color:#6b2c1a;font-size:11px">Click to open →</span></small></a>
<a href="admin_orders.php?filter=pending" class="card"><h2><?php echo $pending; ?></h2><small>⏳ Pending Orders<br><span style="color:#6b2c1a;font-size:11px">Click to open →</span></small></a>
<a href="admin_stock.php?filter=low" class="card"><h2><?php echo $low; ?></h2><small>⚠️ Low Stock<br><span style="color:#6b2c1a;font-size:11px">Click to open →</span></small></a>
</div>

<div style="max-width:1000px;margin:auto;padding:0 20px">
<h3>Quick Access:</h3>
<a href="admin_add.php" class="btn-big" style="background:#0a7a0a">➕ ADD MURTI</a>
<a href="admin_orders.php" class="btn-big" style="background:#6b2c1a">📦 ORDERS + RECEIPT</a>
<a href="admin_stock.php" class="btn-big" style="background:#000">📊 STOCK</a>
<a href="index.php" target="_blank" class="btn-big" style="background:#2e7d32">🏠 VIEW HOME PAGE (What Customer Sees)</a>
</div>
</body></html>
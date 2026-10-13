<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: admin.php"); exit; }
include("db.php");
if(isset($_GET['delete'])){ $id=(int)$_GET['delete']; mysqli_query($con,"DELETE FROM users WHERE id=$id"); header("Location: admin_users.php"); exit; }
$users=mysqli_query($con,"SELECT * FROM users ORDER BY id DESC");
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.header{background:#6b2c1a;color:#fff;padding:12px 20px;display:flex;justify-content:space-between}.header a{color:#fff;text-decoration:none;font-weight:bold}table{width:95%;margin:15px auto;background:#fff;border-collapse:collapse;border-radius:10px;overflow:hidden}th,td{padding:10px;border-bottom:1px solid #eee;font-size:13px}th{background:#f5efe9}.del{background:#d32f2f;color:#fff;padding:5px 10px;border-radius:15px;text-decoration:none;font-size:11px}</style></head><body>
<div class="header"><div><a href="dashboard.php">← DASHBOARD</a> <b>Users - Delete Option</b></div></div>
<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>
<?php while($u=mysqli_fetch_assoc($users)){ ?><tr><td><?php echo $u['id']; ?></td><td><?php echo $u['name']; ?></td><td><?php echo $u['email']; ?></td><td><?php echo $u['phone']; ?></td><td><a href="?delete=<?php echo $u['id']; ?>" class="del" onclick="return confirm('Delete this user?')">🗑️ Delete</a></td></tr><?php } ?></table>
</body></html>
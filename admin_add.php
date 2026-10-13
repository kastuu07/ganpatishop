<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: admin_login.php"); exit; }
include("db.php");
$msg = "";
if(isset($_POST['add_murti'])){
 $name = mysqli_real_escape_string($con, $_POST['name']);
 $price = (int)$_POST['price'];
 $stock = (int)$_POST['stock'];
 $type = mysqli_real_escape_string($con, $_POST['murti_type']);
 $image = $_FILES['image']['name'];
 $ext = pathinfo($image, PATHINFO_EXTENSION);
 $newName = "murti_".time().".".$ext;
 if(!is_dir("uploads")){ mkdir("uploads"); }
 move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$newName);
 mysqli_query($con, "INSERT INTO products(name,price,stock,image,murti_type) VALUES('$name',$price,$stock,'$newName','$type')");
 $msg = "✅ $type Murti Added - $name";
}
if(isset($_POST['add_acc'])){
 $name = mysqli_real_escape_string($con, $_POST['name']);
 $price = (int)$_POST['price'];
 $stock = (int)$_POST['stock'];
 $image = $_FILES['image']['name'];
 $ext = pathinfo($image, PATHINFO_EXTENSION);
 $newName = "acc_".time().".".$ext;
 if(!is_dir("uploads")){ mkdir("uploads"); }
 move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$newName);
 mysqli_query($con, "INSERT INTO accessories(name,price,stock,image) VALUES('$name',$price,$stock,'$newName')");
 $msg = "✅ Accessory Added - $name";
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.header{background:#6b2c1a;color:#fff;padding:12px 20px;display:flex;justify-content:space-between}.header a{color:#fff;text-decoration:none;font-weight:bold}.box{max-width:900px;margin:20px auto;display:flex;gap:20px;flex-wrap:wrap;justify-content:center}.form{background:#fff;width:380px;padding:20px;border-radius:14px;box-shadow:0 4px 10px rgba(0,0,0,0.1)}input,select{width:100%;padding:11px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}.btn{padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold;color:#fff;cursor:pointer}</style></head><body>
<div class="header"><div><a href="dashboard.php">← DASHBOARD</a> <b> ADD ITEM</b></div><div><a href="admin_stock.php">STOCK</a></div></div>
<?php if($msg){ echo "<p style='text-align:center;background:#d4edda;padding:12px;max-width:900px;margin:15px auto;border-radius:8px'>$msg</p>"; } ?>
<div class="box">
<div class="form">
<h3 style="color:#6b2c1a;text-align:center">🙏 ADD MURTI - POP / ECO</h3>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Murti Name - Ex: Dagdusheth 12 inch" required>
<select name="murti_type" required style="border:2px solid #6b2c1a;font-weight:bold">
<option value="">-- Choose Murti Type --</option>
<option value="Eco-Friendly">🌱 Eco-Friendly (Shadu Mati)</option>
<option value="POP">🎨 POP Murti</option>
</select>
<input type="number" name="price" placeholder="Price - Ex: 2500" required>
<input type="number" name="stock" placeholder="Stock - Ex: 10" value="10" required>
<input type="file" name="image" accept="image/*" required>
<button name="add_murti" class="btn" style="background:#6b2c1a">+ ADD MURTI</button>
</form>
</div>
<div class="form">
<h3 style="text-align:center">✨ ADD ACCESSORIES</h3>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Accessory Name" required>
<input type="number" name="price" placeholder="Price" required>
<input type="number" name="stock" placeholder="Stock" value="50" required>
<input type="file" name="image" accept="image/*" required>
<button name="add_acc" class="btn" style="background:#000">+ ADD ACCESSORY</button>
</form>
</div>
</div>
</body>
</html>
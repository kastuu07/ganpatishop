<?php session_start(); include("../db.php");
if(!isset($_SESSION['admin'])){ header("Location: ../admin_login.php"); exit; }

if(!is_dir("../uploads")){ mkdir("../uploads", 0777, true); }

$msg="";
if(isset($_POST['add'])){
 $name=mysqli_real_escape_string($con,$_POST['name']);
 $price=$_POST['price']; 
 $size=$_POST['size'];
 $type=$_POST['murti_type'];
 $desc=mysqli_real_escape_string($con,$_POST['description']);

 $img_name = time()."_".$_FILES['image']['name'];
 $tmp = $_FILES['image']['tmp_name'];
 $target = "../uploads/".$img_name;

 if(move_uploaded_file($tmp,$target)){
   mysqli_query($con,"INSERT INTO products(name,price,size,murti_type,description,image) VALUES('$name','$price','$size','$type','$desc','$img_name')");
   $msg="✅ Product Added Successfully with Photo!";
 } else {
   $msg="❌ Photo Upload Failed! Check uploads folder.";
 }
}
?>
<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:Arial;background:#f0eeea;padding:20px} 
.box{background:#fff;max-width:500px;margin:auto;padding:25px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,.1)} 
input,select,textarea{width:100%;padding:12px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box;font-size:14px} 
.btn{background:#6b2c1a;color:#fff;padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold;cursor:pointer;font-size:16px}
label{font-size:13px;font-weight:bold;color:#6b2c1a}
</style></head><body>
<div class="box">
<h2 style="color:#6b2c1a;text-align:center">Add Ganesh Murti<br><small style="font-size:13px;color:#888">Photo + Price + Size + Description</small></h2>

<?php if($msg!="") echo "<p style='text-align:center;padding:10px;background:#e8f5e9;border-radius:5px'>$msg</p>"; ?>

<form method="POST" enctype="multipart/form-data">

<label>Murti Photo *</label>
<input type="file" name="image" accept="image/*" required>

<label>Murti Name *</label>
<input type="text" name="name" placeholder="e.g. Dagdusheth Ganesh Murti" required>

<label>Price (₹) *</label>
<input type="number" name="price" placeholder="e.g. 2500" required>

<label>Size *</label>
<select name="size" required>
<option value="">-- Select Size --</option>
<option value="1ft">1ft</option>
<option value="1.5ft">1.5ft</option>
<option value="2ft">2ft</option>
<option value="2.5ft">2.5ft</option>
<option value="3ft">3ft</option>
<option value="4ft">4ft</option>
<option value="5ft">5ft</option>
</select>

<label>Type *</label>
<select name="murti_type" required>
<option value="POP">POP</option>
<option value="ECO">Eco Friendly</option>
</select>

<label>Description *</label>
<textarea name="description" rows="4" placeholder="e.g. Handmade, best quality paint, suitable for home..." required></textarea>

<button class="btn" name="add">Add Product Now</button>
</form>

<br><a href="manage_products.php" style="text-decoration:none;color:#6b2c1a;font-weight:bold">📋 Manage Products</a> | <a href="../home.php">🏠 Home</a>
</div>
</body></html>
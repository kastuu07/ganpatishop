<?php session_start(); include("../db.php");
if(!isset($_SESSION['admin'])){ header("Location: ../admin_login.php"); exit; }
if(!is_dir("../uploads")){ mkdir("../uploads", 0777, true); }
$msg="";
if(isset($_POST['add'])){
 $name=mysqli_real_escape_string($con,$_POST['name']);
 $price=$_POST['price'];
 $desc=mysqli_real_escape_string($con,$_POST['description']);
 $size_text = "Depends on Ganesh Murti Size"; // Fixed
 $img_name = time()."_acc_".$_FILES['image']['name'];
 if(move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$img_name)){
   mysqli_query($con,"INSERT INTO accessories(name,price,description,image,size) VALUES('$name','$price','$desc','$img_name','$size_text')");
   $msg="✅ Accessory Added!";
 } else { $msg="❌ Photo Upload Failed!"; }
}
?>
<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{font-family:Arial;background:#f0eeea;padding:20px} .box{background:#fff;max-width:500px;margin:auto;padding:25px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,.1)} input,textarea{width:100%;padding:12px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box} .btn{background:#6b2c1a;color:#fff;padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold;font-size:16px} label{font-size:13px;font-weight:bold;color:#6b2c1a} .note{background:#fff3cd;padding:10px;border-radius:5px;font-size:12px;color:#664d03;margin:8px 0;border:1px solid #ffecb5}</style></head><body>
<div class="box">
<h2 style="color:#6b2c1a;text-align:center">Add Accessories</h2>
<?php if($msg!="") echo "<p style='text-align:center;padding:10px;background:#e8f5e9;border-radius:5px'>$msg</p>"; ?>
<form method="POST" enctype="multipart/form-data">
<label>Accessory Photo *</label><input type="file" name="image" accept="image/*" required>
<label>Name *</label><input type="text" name="name" placeholder="e.g. Golden Mukut, Flower Haar" required>
<label>Price (₹) *</label><input type="number" name="price" placeholder="e.g. 150" required>
<div class="note">📌 <b>Size:</b> Depends on Ganesh Murti Size (1ft, 2ft, 3ft etc) - Customer will choose Ganesh Murti size</div>
<label>Description *</label><textarea name="description" rows="5" placeholder="e.g. This mukut is suitable for all sizes. Size will be adjusted according to your Ganesh Murti size..." required></textarea>
<button class="btn" name="add">Add Accessory</button>
</form><br><a href="manage_accessories.php" style="text-decoration:none;color:#6b2c1a;font-weight:bold">📋 Manage Accessories</a>
</div></body></html>
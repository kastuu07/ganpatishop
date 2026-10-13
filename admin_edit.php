<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: admin.php"); exit; }
include("db.php");
$type=$_GET['type']; $id=(int)$_GET['id'];
if($type=='murti'){ $data=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM products WHERE id=$id")); }
else { $data=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM accessories WHERE id=$id")); }

if(isset($_POST['update_murti'])){
  $name=mysqli_real_escape_string($con,$_POST['name']); $price=(int)$_POST['price']; $stock=(int)$_POST['stock']; $mtype=mysqli_real_escape_string($con,$_POST['murti_type']);
  if($_FILES['image']['name']!=""){
    $newName="murti_".time().".".pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$newName);
    mysqli_query($con,"UPDATE products SET name='$name',price=$price,stock=$stock,murti_type='$mtype',image='$newName' WHERE id=$id");
  } else {
    mysqli_query($con,"UPDATE products SET name='$name',price=$price,stock=$stock,murti_type='$mtype' WHERE id=$id");
  }
  header("Location: admin_stock.php"); exit;
}
if(isset($_POST['update_acc'])){
  $name=mysqli_real_escape_string($con,$_POST['name']); $price=(int)$_POST['price']; $stock=(int)$_POST['stock'];
  if($_FILES['image']['name']!=""){
    $newName="acc_".time().".".pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$newName);
    mysqli_query($con,"UPDATE accessories SET name='$name',price=$price,stock=$stock,image='$newName' WHERE id=$id");
  } else {
    mysqli_query($con,"UPDATE accessories SET name='$name',price=$price,stock=$stock WHERE id=$id");
  }
  header("Location: admin_stock.php"); exit;
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{margin:0;font-family:Arial;background:#f0eeea}.header{background:#6b2c1a;color:#fff;padding:12px 20px}.header a{color:#fff;text-decoration:none;font-weight:bold}.box{background:#fff;max-width:400px;margin:30px auto;padding:25px;border-radius:14px}input,select{width:100%;padding:11px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}.btn{padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold;color:#fff;background:#6b2c1a;cursor:pointer}img{width:100%;height:200px;object-fit:cover;border-radius:10px}</style></head><body>
<div class="header"><a href="admin_stock.php">← BACK TO STOCK</a></div>
<div class="box">
<h3 style="text-align:center;color:#6b2c1a">✏️ Edit <?php echo $type=='murti'?'Murti':'Accessory'; ?></h3>
<img src="uploads/<?php echo $data['image']; ?>">
<?php if($type=='murti'){ ?>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="name" value="<?php echo $data['name']; ?>" required>
<select name="murti_type" required><option value="Eco-Friendly" <?php if($data['murti_type']=='Eco-Friendly') echo 'selected'; ?>>🌱 Eco-Friendly</option><option value="POP" <?php if($data['murti_type']=='POP') echo 'selected'; ?>>🎨 POP</option></select>
<input type="number" name="price" value="<?php echo $data['price']; ?>" required>
<input type="number" name="stock" value="<?php echo $data['stock']; ?>" required>
<p style="font-size:12px">Change Image (optional):</p><input type="file" name="image">
<button name="update_murti" class="btn">✅ Update Murti</button>
</form>
<?php } else { ?>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="name" value="<?php echo $data['name']; ?>" required>
<input type="number" name="price" value="<?php echo $data['price']; ?>" required>
<input type="number" name="stock" value="<?php echo $data['stock']; ?>" required>
<p style="font-size:12px">Change Image (optional):</p><input type="file" name="image">
<button name="update_acc" class="btn" style="background:#000">✅ Update Accessory</button>
</form>
<?php } ?>
</div></body></html>
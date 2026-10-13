<?php session_start(); include("../db.php");
if(!isset($_SESSION['admin'])){ header("Location: ../admin_login.php"); exit; }
$id=$_GET['id']; $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM accessories WHERE id=$id"));
if(isset($_POST['update'])){
 $name=mysqli_real_escape_string($con,$_POST['name']); $price=$_POST['price']; $desc=mysqli_real_escape_string($con,$_POST['description']);
 if($_FILES['image']['name']!=""){ $img=time()."_".$_FILES['image']['name']; move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$img); mysqli_query($con,"UPDATE accessories SET name='$name',price='$price',description='$desc',image='$img' WHERE id=$id"); }
 else { mysqli_query($con,"UPDATE accessories SET name='$name',price='$price',description='$desc' WHERE id=$id"); }
 header("Location: manage_accessories.php");
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1"><style>body{font-family:Arial;background:#f0eeea;padding:20px} .box{background:#fff;max-width:500px;margin:auto;padding:25px;border-radius:10px} input,textarea{width:100%;padding:10px;margin:8px 0;border:1px solid #ccc;border-radius:5px;box-sizing:border-box} .btn{background:#6b2c1a;color:#fff;padding:12px;width:100%;border:none;border-radius:5px;font-weight:bold}</style></head><body>
<div class="box"><h2 style="color:#6b2c1a">Edit Accessory</h2>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="name" value="<?php echo $row['name']; ?>" required>
<input type="number" name="price" value="<?php echo $row['price']; ?>" required>
<div style="background:#fff3cd;padding:10px;border-radius:5px;font-size:12px;margin:8px 0">📌 Size: Depends on Ganesh Murti Size</div>
<textarea name="description" rows="5" required><?php echo $row['description']; ?></textarea>
<p>Current: <?php echo $row['image']; ?></p><input type="file" name="image">
<button class="btn" name="update">Update</button>
</form><br><a href="manage_accessories.php">← Back</a></div>
</body></html>
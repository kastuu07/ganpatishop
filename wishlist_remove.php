<?php include("db.php");
$id=$_GET['id'];
mysqli_query($con,"DELETE FROM wishlist WHERE id=$id");
header("Location: wishlist.php");
?>
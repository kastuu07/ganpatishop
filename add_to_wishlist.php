<?php session_start(); include("db.php");
$type = $_GET['type']; // murti or accessory
$id = (int)$_GET['id'];

// Check already added
$check = mysqli_query($con,"SELECT * FROM wishlist WHERE item_type='$type' AND item_id=$id");
if(mysqli_num_rows($check)==0){
  mysqli_query($con,"INSERT INTO wishlist(item_type,item_id) VALUES('$type',$id)");
}
header("Location: wishlist.php");
?>
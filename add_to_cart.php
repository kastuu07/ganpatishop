<?php session_start(); include("db.php");
if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

if(isset($_GET['murti_id'])){
 $id=(int)$_GET['murti_id'];
 $r=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM products WHERE id=$id"));
 $_SESSION['cart'][]=['type'=>'murti','id'=>$r['id'],'name'=>$r['name'],'price'=>$r['price'],'size'=>$r['size'],'image'=>$r['image']];
}
if(isset($_GET['acc_id'])){
 $id=(int)$_GET['acc_id'];
 $r=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM accessories WHERE id=$id"));
 $_SESSION['cart'][]=['type'=>'accessory','id'=>$r['id'],'name'=>$r['name'],'price'=>$r['price'],'size'=>'Depends on Murti Size','image'=>$r['image']];
}

// If Book Now clicked
if(isset($_GET['book_now'])){
 header("Location: checkout.php");
 exit;
}
header("Location: cart.php");
?>
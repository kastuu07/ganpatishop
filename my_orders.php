if(isset($_GET['cancel_id'])){
 $cid=(int)$_GET['cancel_id'];
 mysqli_query($con,"UPDATE orders SET status='Cancelled' WHERE id=$cid AND user_id=$uid AND status='Pending'");
 header("Location: my_orders.php?cancelled=1");
 exit;
}
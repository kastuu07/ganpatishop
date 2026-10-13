<?php session_start(); include("db.php");
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }
$order_id=(int)$_GET['order_id'];
$order=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM orders WHERE id=$order_id AND user_id=".$_SESSION['user_id']));
if(!$order) die("Order not found");

$SHOP_UPI_ID = "ganpatishop@okaxis"; 
$SHOP_QR_PATH = "uploads/qr.png";

if(isset($_POST['pay_now'])){
 $method=mysqli_real_escape_string($con,$_POST['payment_method']);
 $txn=mysqli_real_escape_string($con,$_POST['transaction_id']);
 if($method=='COD'){
   mysqli_query($con,"UPDATE orders SET payment_method='COD', payment_status='COD - Pending', status='Pending' WHERE id=$order_id");
 } else {
   mysqli_query($con,"UPDATE orders SET payment_method='$method', payment_status='Paid', transaction_id='$txn', status='Confirmed' WHERE id=$order_id");
 }

 // --- STOCK DECREASE LOGIC ---
 $items=mysqli_query($con,"SELECT * FROM order_items WHERE order_id=$order_id");
 while($it=mysqli_fetch_assoc($items)){
   $item_id=(int)$it['item_id'];
   if($it['item_type']=='murti'){
     mysqli_query($con,"UPDATE products SET stock = stock - 1 WHERE id=$item_id AND stock > 0");
   } else {
     mysqli_query($con,"UPDATE accessories SET stock = stock - 1 WHERE id=$item_id AND stock > 0");
   }
 }
 // --- END STOCK LOGIC ---

 $_SESSION['cart']=[]; 
 header("Location: receipt.php?order_id=$order_id");
 exit;
}
?>
<html><head><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0;font-family:Arial;background:#f0eeea}.box{max-width:520px;margin:20px auto;background:#fff;padding:20px;border-radius:14px}
.method{border:2px solid #eee;border-radius:10px;padding:12px;margin:10px 0;cursor:pointer;display:flex;gap:10px;align-items:center}
.method.active{border-color:#6b2c1a;background:#fff8f5}
.qrbox{text-align:center;padding:15px;background:#f9f9f9;border-radius:10px;margin:10px 0}
input{width:100%;padding:11px;margin:8px 0;border:1px solid #ccc;border-radius:8px;box-sizing:border-box}
.btn{background:#6b2c1a;color:#fff;padding:12px;width:100%;border:none;border-radius:8px;font-weight:bold;cursor:pointer;font-size:15px}
</style>
<script>
function selectMethod(m){
 document.querySelectorAll('.method').forEach(e=>e.classList.remove('active'));
 document.getElementById('m-'+m).classList.add('active');
 document.getElementById('pay_method').value=m;
 document.getElementById('upi-box').style.display = (m=='UPI' || m=='QR') ? 'block' : 'none';
 document.getElementById('txn-box').style.display = (m=='UPI' || m=='QR') ? 'block' : 'none';
}
</script></head><body>
<div class="box">
<h2 style="color:#6b2c1a;text-align:center">💳 Payment Options</h2>
<p>Order #<?php echo $order_id; ?> | Amount: <b>₹<?php echo $order['total']; ?></b></p>
<form method="POST">
<input type="hidden" name="payment_method" id="pay_method" value="COD" required>
<div class="method active" id="m-COD" onclick="selectMethod('COD')"><input type="radio" checked> <b>💵 Cash on Delivery</b></div>
<div class="method" id="m-UPI" onclick="selectMethod('UPI')"><input type="radio"> <b>📲 UPI - <?php echo $SHOP_UPI_ID; ?></b></div>
<div class="method" id="m-QR" onclick="selectMethod('QR')"><input type="radio"> <b>🔳 QR Code Scan</b></div>
<div id="upi-box" style="display:none"><div class="qrbox"><img src="<?php echo $SHOP_QR_PATH; ?>" style="width:220px;height:220px;object-fit:contain" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=upi://pay?pa=<?php echo $SHOP_UPI_ID; ?>&am=<?php echo $order['total']; ?>'"><p>UPI: <b><?php echo $SHOP_UPI_ID; ?></b></p></div></div>
<div id="txn-box" style="display:none"><input type="text" name="transaction_id" placeholder="Enter UTR / Transaction ID after payment"></div>
<button name="pay_now" class="btn">Pay & Confirm - ₹<?php echo $order['total']; ?></button>
</form>
</div>
</body></html>
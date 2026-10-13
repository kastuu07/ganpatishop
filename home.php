<?php session_start(); include("db.php");
$wish = isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0;
$cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vaishnavi Arts - Kolhapur</title>
<style>
body{margin:0;font-family:Georgia,serif;background:#f0eeea}
.top-bar{background:#6b2c1a;color:#e9d18a;text-align:center;padding:6px;font-size:11px}
.header{background:#fff;display:flex;justify-content:space-between;align-items:center;padding:10px 20px;flex-wrap:wrap;position:sticky;top:0;z-index:10}
.logo b{color:#6b2c1a;font-size:20px}
.logo small{font-size:11px;color:#555;font-family:Arial;display:block}
.menu{display:flex;align-items:center;gap:5px}
.menu a{margin:0 10px;text-decoration:none;color:#333;font-weight:bold;font-size:14px}
.right{display:flex;align-items:center;gap:12px;font-family:Arial}
.badge{background:#6b2c1a;color:#fff;border-radius:50%;padding:2px 6px;font-size:11px}
.login-btn{background:#6b2c1a;color:#fff;padding:7px 14px;border-radius:20px;text-decoration:none;display:inline-block}
.mid-bar{background:#6b2c1a;color:#e9d18a;text-align:center;padding:8px 0;font-size:12px;max-width:1100px;margin:12px auto 0 auto;border-radius:10px 10px 0 0;overflow:hidden;white-space:nowrap}
.mid-bar span{display:inline-block;padding-left:100%;animation:scroll 15s linear infinite}
@keyframes scroll{0%{transform:translateX(0)}100%{transform:translateX(-100%)}}
.main-box{max-width:1100px;margin:0 auto;background:#f7f4ee;display:flex;flex-wrap:wrap;padding:30px;border-radius:0 0 10px 10px}
.left{flex:1;min-width:280px;padding:15px}
.left h1{margin:0;font-size:34px}
.left h1 i{color:#6b2c1a;font-size:38px}
.info{margin-top:15px;font-size:14px;line-height:1.8;font-family:Arial}
.view-btn{display:inline-block;margin-top:20px;background:#6b2c1a;color:#fff;padding:12px 26px;border-radius:25px;text-decoration:none;font-weight:bold;font-family:Arial}
.right-img{flex:1;min-width:280px;text-align:center}
.right-img img{width:80%;max-width:320px;border-radius:25px;border:5px solid #fff;box-shadow:0 10px 20px rgba(0,0,0,.2)}
.about-box{max-width:1100px;margin:20px auto;background:#fff;padding:35px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05)}
.about-box h2{color:#6b2c1a;font-size:28px;margin:0 0 5px 0;text-align:center}
.about-box h3{color:#6b2c1a;text-align:center;margin:0 0 20px 0;font-size:18px}
.about-box p{font-family:Arial;font-size:14.5px;line-height:1.8;color:#333;text-align:justify}
.about-box h4{color:#6b2c1a;font-size:18px;margin:25px 0 10px 0}
.about-box ul{font-family:Arial;font-size:14.5px;line-height:2;color:#333}
.footer{text-align:center;padding:18px;color:#6b2c1a;font-weight:bold}
.dropdown{position:absolute;background:#fff;border-radius:8px;box-shadow:0 5px 15px rgba(0,0,0,0.2);min-width:170px;z-index:100;overflow:hidden;display:none}
.dropdown a{display:block;padding:12px 15px;text-decoration:none;color:#333;font-size:14px;border-bottom:1px solid #eee;font-family:Arial}
.dropdown a:last-child{border-bottom:none}
</style>
</head>
<body>

<div class="top-bar">VAISHNAVI ARTS, KOLHAPUR | SANT GORA KUMBHAR VASAHAT, BAPT CAMP KOLHAPUR | ESTD 2015</div>

<div class="header">
<div class="logo"><b>Vaishnavi Arts</b><small>Sant Gora Kumbhar Vasahat, Bapat Camp, Kolhapur<br>Since 2015 - Kolhapur</small></div>

<div class="menu">
<a href="home.php">HOME</a>

<div style="position:relative">
<a href="#" onclick="toggleGanesh(event)">GANESH MURTI ▼</a>
<div id="ganeshDropdown" class="dropdown" style="left:0;top:25px">
<a href="products.php?type=POP">POP</a>
<a href="products.php?type=ECO" style="color:#6b2c1a;font-weight:bold">Eco Friendly</a>
</div>
</div>

<a href="accessories.php">ACCESSORIES</a>
</div>

<div class="right">
<a href="wishlist.php" style="text-decoration:none">❤️ <span class="badge"><?php echo $wish; ?></span></a>
<a href="cart.php" style="text-decoration:none">🛒 <span class="badge"><?php echo $cart; ?></span></a>

<div style="position:relative">
<a href="#" class="login-btn" onclick="toggleLogin(event)">Login ▼</a>
<div id="loginDropdown" class="dropdown" style="right:0;top:35px">
<a href="customer_login.php">👤 Customer Login</a>
<a href="admin_login.php">🔐 Admin Login</a>
</div>
</div>

</div>
</div>

<div class="mid-bar"><span>VAISHNAVI ARTS, KOLHAPUR | GANESH MURTI | ESTD 2015 | SANT GORA KUMBHAR VASAHAT &nbsp;&nbsp; • &nbsp;&nbsp; VAISHNAVI ARTS, KOLHAPUR | GANESH MURTI | ESTD 2015 | SANT GORA KUMBHAR VASAHAT</span></div>

<div class="main-box">
<div class="left">
<h1>WELCOME TO<br><i>Vaishnavi Arts</i></h1>
<div class="info"><b>Shop:</b> Vaishnavi Arts, Kolhapur<br><b>Location:</b> Sant Gora Kumbhar Vasahat, Bapat Camp<br><b>Year:</b> 2015</div>
<p style="font-family:Arial;margin-top:20px;font-size:14.5px;line-height:1.7;color:#444;">Beautifully Designed Ganesh Murtis with Devotion, Creativity and Tradition for your Home and Mandal.</p>
<a href="products.php" class="view-btn">View Ganesh Murtis</a>
</div>
<div class="right-img"><img src="uploads/bappa.jpg" onerror="this.src='https://images.unsplash.com/photo-1567593810070-7a94846d5a60?w=400'"></div>
</div>

<div class="about-box">
<h2>About Us</h2>
<h3>Vaishnavi Arts – Since 2015</h3>
<p>Welcome to <b>Vaishnavi Arts</b>, a trusted name in Ganesh Murti craftsmanship in Kolhapur, serving customers since 2015.</p>
<p>At Vaishnavi Arts, we create beautifully designed Ganesh Murtis with devotion, creativity, and attention to detail.</p>
<p>Since 2015, our goal has been to provide customers with beautiful designs, good-quality idols, and affordable options.</p>
<h4>Our Mission</h4>
<p>Our mission is to combine tradition, devotion, and artistic craftsmanship to create Ganesh Murtis that make every Ganeshotsav more special.</p>
<h4>Why Choose Vaishnavi Arts?</h4>
<ul>
<li>Ganesh Murti craftsmanship since 2015</li>
<li>Traditional and creative designs</li>
<li>Different sizes and styles</li>
<li>Quality-focused workmanship</li>
<li>Affordable options</li>
<li>Customer satisfaction is our priority</li>
</ul>
<p style="text-align:center;margin-top:30px;font-weight:bold;color:#6b2c1a">Vaishnavi Arts – Creating Ganesh Murtis with Devotion, Art & Tradition.</p>
</div>

<div class="footer">Vaishnavi Arts, Kolhapur - Since 2015</div>

<script>
function toggleGanesh(e){ e.preventDefault(); var d=document.getElementById('ganeshDropdown'); d.style.display=d.style.display==='block'?'none':'block'; document.getElementById('loginDropdown').style.display='none'; }
function toggleLogin(e){ e.preventDefault(); var d=document.getElementById('loginDropdown'); d.style.display=d.style.display==='block'?'none':'block'; document.getElementById('ganeshDropdown').style.display='none'; }
window.onclick=function(event){ if(!event.target.closest('.menu') && !event.target.closest('.right')){ document.getElementById('ganeshDropdown').style.display='none'; document.getElementById('loginDropdown').style.display='none'; } }
</script>

</body>
</html>
<?php
echo "<h3>Checking images folder</h3>";
echo "Current folder: ".getcwd()."<br><br>";

$folders = ["", "uploads/", "images/", "admin/uploads/", "img/"];
foreach($folders as $f){
  echo "<b>Folder: $f</b> - ";
  if(is_dir($f)) echo "EXISTS, files: ".count(glob($f."*"))."<br>";
  else echo "NOT FOUND<br>";
}
echo "<hr>";
echo "<b>Products table images:</b><br>";
include("db.php");
$q=mysqli_query($con,"SELECT id,name,image FROM products");
while($r=mysqli_fetch_assoc($q)){
  $img=$r['image'];
  echo "ID {$r['id']} - {$r['name']} - DB says: $img - ";
  if(file_exists($img)) echo " FOUND at $img<br>";
  else if(file_exists("uploads/".$img)) echo " FOUND at uploads/$img<br>";
  else if(file_exists("uploads/".basename($img))) echo " FOUND at uploads/".basename($img)."<br>";
  else echo " <span style='color:red'>NOT FOUND ANYWHERE!</span><br>";
}
?>
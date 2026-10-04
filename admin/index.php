<?php
session_start(); require_once "../config.php";
if(!isset($_SESSION["admin"])){ if($_SERVER["REQUEST_METHOD"]==="POST" && $_POST["password"]==="admin123"){$_SESSION["admin"]=true;} else { ?>
<!DOCTYPE html><html><head><title>Admin Login</title><link rel="stylesheet" href="../assets/style.css"></head><body><div class="formbox"><h2>Admin Login</h2><form method="post"><input type="password" name="password" placeholder="Admin Password" required><button class="btn">Login</button></form></div></body></html><?php exit;}}
if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["add"])){
$stmt=$conn->prepare("INSERT INTO opportunities(title,company,type,location,description) VALUES(?,?,?,?,?)");
$stmt->bind_param("sssss",$_POST["title"],$_POST["company"],$_POST["type"],$_POST["location"],$_POST["description"]);$stmt->execute();
}
$ops=$conn->query("SELECT * FROM opportunities ORDER BY created_at DESC");
?><!DOCTYPE html><html><head><title>Admin</title><link rel="stylesheet" href="../assets/style.css"></head><body><div class="container"><h2>Admin Panel</h2>
<form method="post" class="adminform"><input name="title" placeholder="Job/Internship Title" required><input name="company" placeholder="Company" required><select name="type"><option>Job</option><option>Internship</option></select><input name="location" placeholder="Location" required><textarea name="description" placeholder="Description"></textarea><button class="btn" name="add">Add Opportunity</button></form>
<h3>Opportunities</h3><table><tr><th>Title</th><th>Company</th><th>Type</th><th>Location</th></tr><?php while($o=$ops->fetch_assoc()): ?><tr><td><?=htmlspecialchars($o["title"])?></td><td><?=htmlspecialchars($o["company"])?></td><td><?=$o["type"]?></td><td><?=htmlspecialchars($o["location"])?></td></tr><?php endwhile; ?></table></div></body></html>

<?php
session_start(); require_once "config.php";
if(!isset($_SESSION["user_id"])){header("Location: login.php");exit;}
$id=(int)$_SESSION["user_id"];
$stmt=$conn->prepare("SELECT a.*,o.title,o.company FROM applications a JOIN opportunities o ON a.opportunity_id=o.id WHERE a.user_id=? ORDER BY a.applied_at DESC");
$stmt->bind_param("i",$id); $stmt->execute(); $apps=$stmt->get_result();
?>
<!DOCTYPE html><html><head><title>Dashboard</title><link rel="stylesheet" href="assets/style.css"></head><body>
<nav><h2>Student Dashboard</h2><div><a href="index.php">Opportunities</a><a href="logout.php">Logout</a></div></nav>
<div class="container"><h2>Welcome, <?=htmlspecialchars($_SESSION["name"])?></h2><h3>My Applications</h3>
<table><tr><th>Opportunity</th><th>Company</th><th>Status</th><th>Applied On</th></tr>
<?php while($a=$apps->fetch_assoc()): ?><tr><td><?=htmlspecialchars($a["title"])?></td><td><?=htmlspecialchars($a["company"])?></td><td><?=htmlspecialchars($a["status"])?></td><td><?=$a["applied_at"]?></td></tr><?php endwhile; ?>
</table></div></body></html>

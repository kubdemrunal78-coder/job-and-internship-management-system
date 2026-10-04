<?php
session_start(); require_once "config.php";
if(!isset($_SESSION["user_id"])){header("Location: login.php");exit;}
$oid=(int)($_GET["id"]??0);
$stmt=$conn->prepare("SELECT * FROM opportunities WHERE id=?"); $stmt->bind_param("i",$oid); $stmt->execute(); $op=$stmt->get_result()->fetch_assoc();
if(!$op){die("Opportunity not found.");}
$msg="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $uid=$_SESSION["user_id"]; $stmt=$conn->prepare("INSERT INTO applications(user_id,opportunity_id) VALUES(?,?)");
 $stmt->bind_param("ii",$uid,$oid); $msg=$stmt->execute() ? "Application submitted successfully!" : "You may have already applied.";
}
?>
<!DOCTYPE html><html><head><title>Apply</title><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="formbox"><h2><?=htmlspecialchars($op["title"])?></h2><p><b><?=htmlspecialchars($op["company"])?></b> · <?=htmlspecialchars($op["type"])?></p><p><?=htmlspecialchars($op["description"])?></p>
<?php if($msg): ?><p class="msg"><?=$msg?></p><?php endif; ?><form method="post"><button class="btn">Submit Application</button></form><p><a href="dashboard.php">Go to Dashboard</a></p></div></body></html>

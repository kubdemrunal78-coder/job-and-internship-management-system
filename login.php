<?php
session_start(); require_once "config.php"; $msg="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $email=trim($_POST["email"]); $password=$_POST["password"];
 $stmt=$conn->prepare("SELECT id,name,password FROM users WHERE email=?"); $stmt->bind_param("s",$email); $stmt->execute(); $r=$stmt->get_result()->fetch_assoc();
 if($r && password_verify($password,$r["password"])){ $_SESSION["user_id"]=$r["id"]; $_SESSION["name"]=$r["name"]; header("Location: dashboard.php"); exit; }
 $msg="Invalid email or password.";
}
?>
<!DOCTYPE html><html><head><title>Login</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="formbox"><h2>Student Login</h2><?php if($msg): ?><p class="error"><?=$msg?></p><?php endif; ?>
<form method="post"><input type="email" name="email" placeholder="Email" required><input type="password" name="password" placeholder="Password" required><button class="btn">Login</button></form>
<p>New user? <a href="register.php">Register</a></p></div></body></html>

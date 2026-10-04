<?php
require_once "config.php";
$msg="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $name=trim($_POST["name"]); $email=trim($_POST["email"]); $password=password_hash($_POST["password"],PASSWORD_DEFAULT);
 $stmt=$conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
 $stmt->bind_param("sss",$name,$email,$password);
 $msg=$stmt->execute() ? "Registration successful. You can login now." : "Email may already exist.";
}
?>
<!DOCTYPE html><html><head><title>Register</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="formbox"><h2>Student Registration</h2>
<?php if($msg): ?><p class="msg"><?=$msg?></p><?php endif; ?>
<form method="post"><input name="name" placeholder="Full Name" required><input type="email" name="email" placeholder="Email" required><input type="password" name="password" placeholder="Password" required><button class="btn">Register</button></form>
<p>Already registered? <a href="login.php">Login</a></p></div></body></html>

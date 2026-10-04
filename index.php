<?php
require_once "config.php";
$jobs = $conn->query("SELECT * FROM opportunities ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Job & Internship Management System</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav><h2>Job & Internship Portal</h2><div><a href="index.php">Home</a><a href="register.php">Register</a><a href="login.php">Login</a></div></nav>
<section class="hero"><h1>Find Jobs & Internships</h1><p>Explore opportunities and apply online.</p></section>
<div class="container">
<h2>Latest Opportunities</h2>
<div class="grid">
<?php while($row=$jobs->fetch_assoc()): ?>
<div class="card">
<h3><?=htmlspecialchars($row['title'])?></h3>
<p><b>Company:</b> <?=htmlspecialchars($row['company'])?></p>
<p><b>Type:</b> <?=htmlspecialchars($row['type'])?></p>
<p><b>Location:</b> <?=htmlspecialchars($row['location'])?></p>
<p><?=htmlspecialchars($row['description'])?></p>
<a class="btn" href="apply.php?id=<?=$row['id']?>">Apply Now</a>
</div>
<?php endwhile; ?>
</div>
</div>
</body>
</html>

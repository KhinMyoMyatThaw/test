<?php
session_start();
if (!isset($_SESSION['email'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: signin.php');
	# code...
}

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>

</head>
<body>

	<div class="header">
		<h2>Home Page</h2>
		
	</div>
<div class="content">
	<!---- notification message ---->
	<?php
	if(isset($_SESSION['success'])){
	?>
	<div class="error success">
		<h3>
			<?php
			echo $_SESSION['success'];
			unset($_SESSION['success']);


			?>
		</h3>
	<?php
	}
	?>	
	</div>

<!--- logged in user information-->
<?php if (isset($_SESSION['email']));?>
<p>Welcome <strong><?php echo $_SESSION['email']; ?></strong></p>
<p> <a href="logout.php" style="color: red;">logout</a></p>

	
</div>

</body>
</html>
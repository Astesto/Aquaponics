<?php 
include('functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

	

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<div><h2>choose your next action<h2></div><br><br>
						
						<a href="create_user.php"> ADD NEW USER</a><br>
						<a href ="show_user.php">SHOW ALL AVAILABLE USERS</a><br><br><br>
						
												<a href="home.php?logout='1'" style="color: red;">logout</a>
                        
					</small>

				<?php endif ?>
			</div>
		</div>
		
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
		</div>
	
</body>
</html>
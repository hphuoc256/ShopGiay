<?php session_start();
if(isset($_SESSION['uid'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản trị hệ thống</title>
	<meta charset="utf-8">
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<form name="" method="">
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		
	</div>
	<?php include('includeadmin/footeradmin.php') ?>
	</form>
</body>
</html>
<?php }
/*--------------------------*/
else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập hệ thống</title>
	<meta charset="utf-8">
	<?php include('includeadmin/headadmin.php') ?>
	<style type="text/css">
		.input-group{
			width: 400px;
			margin: 0px auto;
			margin-top: 20px;
		}
		.form-control{
			height: 40px;
		}
		#dn{
			width: 600px;
			height: 250px;
			background: #ffffff;
			margin: 0px auto;
			margin-top: 30vh;
		}
		#dn label{
			margin: 0px;
			padding: 0px;
			color: white;
			font-size: 18px;
			margin-top: 5px;
			margin-left: 5px;
		}
		.btn-primary{
			margin-left: 400px;
		}
		body{
			background:#eff0f5;
		}
	</style>
</head>
<body>
	<form method="POST" action="ac.php">
		<div id="dn">
			<div style="background:#10a6be;height:32px;"><label>ĐĂNG NHẬP HỆ THỐNG</label></div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="email" type="text" class="form-control" name="username" placeholder="Username" required="required">
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required">
			</div>
			<div style="margin-top: 20px;">
				<input type="submit" name="submit_admin" class="btn btn-primary" value="Đăng nhập">
			</div>
		</div>
		<br>
	</form>
</body>
</html>
<?php } ?>

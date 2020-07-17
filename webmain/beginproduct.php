<?php 
ob_start();
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	include('../inc/myconnect.php');
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$query="SELECT * FROM tblsanpham WHERE idsp='$id' ";
		$results=mysqli_query($dbc,$query);
		$d=mysqli_fetch_array($results);
	}
	?>
	<title><?php echo $d['tensp'] ;?></title>
	<?php include('includemain/headmain.php') ?>
</head>
<body>
	<form name="" method="" style="background: #eff0f5;">
		<?php include('includemain/headermain.php') ?>
		<?php include('includemain/containerproduct.php') ?>
		<?php include('includemain/footermain.php') ?>
	</form>
</body>
</html>
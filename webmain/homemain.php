<?php ob_start();
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HVT Shop</title>
	<?php include('includemain/headmain.php') ?>
	<!-- <script type="text/javascript">
		$(document).ready(function(){
			var i=6;
			$(".button_xemthem").click(function(){
				$.get("acmain.php",{id:i,xemthem:1},function(data){
					$("#home-main").append(data);
				});
				i+=6;
			});
		});
	</script> -->
</head>
<body>
	<form name="" method="GET">
		<!----------------------------- header ----------------------------->
		<?php include('includemain/headermain.php'); ?>
		<!---------------------------- container ------------------------>
		<div id="container">
			<?php include('includemain/bannermain.php') ?>
			<?php include('includemain/homemain.php') ?>
			<!----------------------------- footer ----------------------------->
			<?php include('includemain/footermain.php') ?>
		</div>
	</form>
</body>
</html>

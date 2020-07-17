<?php 
ob_start();
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>HVT Shop</title>
	<?php include('includemain/headmain.php') ?>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#signup').validate({
				rules:{
					hoten:{
						required:true,
					},
					username:{
						required:true,
					},
					password_again:{
						required:true,
					},
					sdt:{
						required:true,
						minlength: 10,
					},
					email:{
						required:true,
						email:true,
					},
					password:{
						required:true,
						minlength: 5,
					}
				},
				messages:{
					hoten:{
						required:"Vui lòng nhập tên",
					},
					username:{
						required:"Vui lòng nhập tên đăng nhập",
					},
					password_again:{
						required:"Vui lòng nhập tên đăng nhập",
					},
					sdt:{
						required:"Vui lòng nhập số điện thoại",
						minlength:"Số điện thoại không hợp lệ",
					},
					email: {
						required: "Vui lòng nhập lại",
						email:"Email không hợp lệ",
					},
					password:{
						required:"Vui lòng nhập lại mật khẩu",
						minlength:"Mật khẩu trên 6 ký tự",
					}
				}
			});
		});
	</script>
</head>
<body>
	<form name="signup" method="post" id="signup" action="acmain.php">
		<!----------------------------- header ----------------------------->
		<?php include('includemain/headermain.php'); ?>
		<!---------------------------- container ------------------------>
		<div id="container">
			<div id="product">
				<!-----------------phần sản phẩm-------------------->
				<div id="product-main">
					<ul class="product-main-ul">
						<li><h2>Đăng ký</h2></li>
						<hr style="width: 90%;">
						<li> <input type="Text" name="hoten" placeholder="Họ và tên " required="required" class="product-form"></li>
						<br>
						<li> <input type="text" name="email" placeholder="Email"  required="required" class="product-form"></li>
						<br>
						<li> <input type="text" name="username" placeholder="Tên đăng nhập"  required="required" class="product-form" id="input_username">
							<span id="alertusername" style="color: red;"></span>
						</li>
						<br>
						<li> <input type="password" name="password" placeholder="Mật khẩu" required="required" class="product-form" id="password"></li>
						<br>
						<li> <input type="password" name="password_again" placeholder="Nhập lại mật khẩu"  required="required" class="product-form" id="password_again">
							<span id="alertpassword" style="color: red;"></span>
						</li>
						<br>
						<li> <input type="text" name="sdt" placeholder="Số điện thoại"  required="required" class="product-form"></li>
						<br>
						<li>
							<select class="product-form" name="province" id="province_select">
								<?php 
								include('../inc/myconnect.php');
								$query="SELECT * FROM province";
								$results=mysqli_query($dbc,$query) or die("bị lỗi");
								while ($d=mysqli_fetch_array($results)){
									?>
									<option value="<?php echo $d['provinceid']; ?>"><?php echo $d['name']; ?></option>
								<?php } ?>
							</select>
						</li>
						<br>
						<li id="district">
							<select class="product-form" name="district" >
								<?php 
								$query="SELECT * FROM district WHERE provinceid='01TTT'";
								$results=mysqli_query($dbc,$query) or die("bị lỗi");
								while ($d=mysqli_fetch_array($results)){
									?>
									<option value="<?php echo $d['districtid']; ?>"><?php echo $d['name']; ?></option>
								<?php } ?>
							</select>
						</li>
						<br>
						<li class="product-form2">
							<span class="span1-1">Địa chỉ cụ thể:</span>
							<textarea name="diachi"></textarea>
						</li>
						<br>
						<li class="product-form2">
							<span class="span1-1">Giới tính:</span>
							<input type="radio" name="gioitinh" value="1" checked="checked"> Nam
							<input type="radio" name="gioitinh" value="0"> Nữ
						</li>
						<br>
						<li class="product-form2">
							<span class="span1-1">Ngày sinh: </span>
							<input type="date" name="ngaysinh">
						</li>
						<br>
						<li><input type="submit" name="submit_signup" value="Đăng ký ngay" title="đồng ý" class="product-form" id="submit_signup"></li>
					</ul>
				</div>
			</div>
		</div>
	</form>
	<!----------------------------- footer ----------------------------->
	<?php include('includemain/footermain.php') ?>
</body>
</html>

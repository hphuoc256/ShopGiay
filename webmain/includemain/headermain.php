<div id="header">
	<div id="logo">
		<a href="homemain.php" title="Home"><img src="../picture/logo/logo2.PNG" class="logo" /></a>
	</div>
	<div id="menu">
		<ul class="menu">
			<li class="li-menu"><a href="#" class="li-menu-a">Giới thiệu</a></li>
			<li class="li-menu"><a href="seachpro.php?gt1=1&gt=10" class="li-menu-a">Giày nam</a>
				<ul class="sub-menu">
					<?php 
					include('../inc/myconnect.php');
					$query="SELECT * FROM loaisp WHERE gioitinh=1||gioitinh=10";
					$results=mysqli_query($dbc,$query);
					while ($d=mysqli_fetch_array($results)) {
						?>
						<li><a href="seachpro.php?gt1=1&gt=10&idL=<?php echo $d['idL']; ?>" class="sub-menu-a"><?php echo $d['ten']; ?></a></li>
					<?php } ?>
				</ul>
			</li>
			<li class="li-menu"><a href="seachpro.php?gt1=0&gt=10" class="li-menu-a">Giày nữ</a>
				<ul class="sub-menu">
					<?php 
					$query="SELECT * FROM loaisp WHERE gioitinh=0||gioitinh=10";
					$results=mysqli_query($dbc,$query);
					while ($d=mysqli_fetch_array($results)) {
						?>
						<li><a href="seachpro.php?gt1=0&gt=10&idL=<?php echo $d['idL']; ?>" class="sub-menu-a"><?php echo $d['ten']; ?></a></li>
					<?php } ?>
				</ul>
			</li>
			<li class="li-menu" ><a href="#" class="li-menu-a">Chính sách bảo hảnh</a></li>
			<li class="li-menu"><a href="#"  class="li-menu-a">Liên hệ</a></li>
		</ul>
	</div>
	<div id="function">
		<table border="0">
			<tr>
				<td id="menu_quanli_tk">
					<?php 
					if(!isset($_SESSION['usernames'])){
						?>
						<a title="Tài khoảng" class="account1-1-1"><i class="fa fa-user" style="font-size: 30px;margin-right: 5px;"></i><span>TÀI KHOẢN</span></a>
					<?php }
					else{
						$hotendn=explode(" ", $_SESSION['hoten']);
						$sizenumht= sizeof($hotendn);
						$hoten='';
						for ($i=$sizenumht-2; $i< $sizenumht; $i++) { 
							$hoten=$hoten." ".$hotendn[$i];
						}
						?>
						<a title="Tài khoảng" class="tkdangnhap"><i class="fa fa-user" style="font-size: 30px;margin-right: 5px;"></i><span><?php echo $hoten; ?></span></a>
						<ul id="quanli_tk" >
							<a href=""><li><i class="fa fa-user-circle-o" style="font-size:18px;margin-right: 8px;"></i>Profile</li></a>
							<a href=""><li><i class="fa fa-shopping-cart" style="font-size:18px;margin-right: 8px;"></i>Quản lý đơn hàng</li></a>
							<a href=""><li><i class="fa fa-gear" style="font-size:18px;margin-right: 8px;"></i>Đổi mật khẩu</li></a>
							<a href="acmain.php?logout=logout"><li><i class="fa fa-power-off" style="font-size:18px;margin-right: 8px;"></i>Log Out</li></a>
						</ul>
					<?php } ?>
				</td>
				<td>
					<?php if(isset($_SESSION['iduser'])){ ?>
						<a href="cartmain.php" title="Giỏ hàng"><i class="fa fa-shopping-cart" style="font-size: 30px;margin-right: 5px;"></i><span>GIỎ</span></a>
					<?php } else{?>
						<a title="Giỏ hàng" class="account1-1-1"><i class="fa fa-shopping-cart" style="font-size: 30px;margin-right: 5px;"></i><span>GIỎ</span>
						</a>

					<?php } ?>
				</td>
			</tr>
			<tr>
				<form method="get" name="seachkey_input">
					<td colspan="2">
						<input type="text" name="seachkey1" placeholder="Tìm kiếm">
					</input>
					<button class="seach_button">
						<i class="fa fa-search" style="font-size: 22px;"></i></a>
					</button>
					<?php if(isset($_GET['seachkey1'])){
						$seachkey1=$_GET['seachkey1'];
						header('location:seachpro.php?seachkey='.$seachkey1);
						ob_end_flush();
					} ?>
				</td>
			</form>
		</tr>
	</table>
</div>
<?php if(!isset($_SESSION['usernames'])){ ?>
	<form method="post" action="acmain.php" name="dangnhap_lol">
		<div id="account">
			<i class="fa fa-window-close-o" style="font-size:28px;margin-left: 470px; cursor: pointer;"></i>
			<span style="width: 165px;display: inline-block;font-size: 2rem;font-weight: 400;text-align: center;">Đăng nhập</span>
			<a href="signup.php"><span class="account-signup">Đăng ký</span></a>
			<input type="text" name="username" class="input_account" placeholder="Tên đăng nhập" required="required">
			<input type="password" name="password" class="input_account" placeholder="Mật khẩu" required="required">
			<br>
			<a href="#"><span style="margin-left: 270px;margin-right: 5px;">Quên mật khẩu</span></a>|<a href="#"><span style="margin-left: 10px; color: black;">Cần trợ giúp</span></a>
			<br>
			<input type="submit" name="submit_dangnhap" value="Đăng nhập">
		</div>
	</form>
<?php } ?>
</div>
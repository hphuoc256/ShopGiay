<?php 
ob_start();
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>HVT Shop</title>
	<?php include('includemain/headmain.php') ?>
</head>
<body>
	
	<form name="" method="get"  style="background: #eff0f5;">
		<!----------------------------- header ----------------------------->
		<?php include('includemain/headermain.php') ?>
		<!---------------------------- container ------------------------>
		<div id="container">
			<?php 
			include('../inc/myconnect.php');
			if(!isset($_GET['idL']) && isset($_GET['gt1']) && isset($_GET['gt'])){
				$gioitinh=$_GET['gt1'];
				$query="SELECT * FROM tblsanpham WHERE gioitinh='10'||gioitinh=$gioitinh AND status=1 ORDER BY ordernum DESC ";
			}
			if(isset($_GET['idL'])&&isset($_GET['gt1']) && isset($_GET['gt'])){
				$idL=$_GET['idL'];
				$gioitinh=$_GET['gt1'];
				$query="SELECT * FROM tblsanpham WHERE (gioitinh=$gioitinh AND idL=$idL) || (gioitinh='10'AND idL=$idL) AND status=1 ORDER BY ordernum DESC";
			} 
			if(isset($_GET['seachkey'])){
				$seachkey="\"".$_GET['seachkey']."\"";
				$query="SELECT * FROM tblsanpham WHERE status=1 AND tensp LIKE '%'".$seachkey."'%'";
			}
			if(!isset($_GET['gt']) && !isset($_GET['idL']) && !isset($_GET['seachkey'])){
				$query="SELECT * FROM tblsanpham WHERE status=1 ORDER BY ordernum DESC";
			}
			$results=mysqli_query($dbc,$query) or die("kết nối bị lỗi");
			?>
			<div id="product">
				<!--------------------------sản phẩm------------------------->
				<div id="product-main">
					<a href="homemain.php"><span>Trang chủ </span></a><span> / </span><a href="seachpro.php"><span>Tất cả sản phẩm</span></a><span> / Kết quả</span>
					<ul>
						<?php 
						while ( $d=mysqli_fetch_array($results)) {
							?>
							<li class="product-main-li">
								<a href="beginproduct.php?id=<?php echo $d['idsp']; ?>">
									<img src="<?php echo $d['anh']; ?>" class="product-img">
									<br>
									<p class="label-product-title"><?php echo $d['tensp']; ?></p>
									<p class="label-product-title-giasp"><?php echo number_format($d['giasp']); ?></p>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div id="product-filter">
					<table >
						<tr>
							<th>LỌC SẢN PHẨM</th>
						</tr>
						<tr>
							<td class="filter-td-header">Giới tính</td>
						</tr>
						<tr>
							<td class="filter-td-checkbox">
								<input type="checkbox" name="" >Nam<br>
								<input type="checkbox" name="">Nữ<br>
							</td>
						</tr>
						<tr>
							<td class="filter-td-header">Kiểu mẫu</td>
						</tr>
						<tr>
							<td class="filter-td-checkbox">
								<input type="checkbox" name="">Dép<br>
								<input type="checkbox" name="">Giày boot <br>
								<input type="checkbox" name="">Giày mọi<br>
								<input type="checkbox" name="">Giày Oxford<br>
								<input type="checkbox" name="" > Giày Sandal<br>
								<input type="checkbox" name="" >Slipon<br>
								<input type="checkbox" name="" >Giày thanh lịch<br>
								<input type="checkbox" name="" >Giày thể thao<br>
							</td>
						</tr>
						<tr>
							<td class="filter-td-header">Màu sắc</td>
						</tr>
						<tr>
							<td class="filter-td-checkbox">
								<ul>
									<li><a href="#"><img src="./filer-color/color1.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color2.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color3.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color4.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color5.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color6.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color7.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color8.PNG" class="filter-color"></a></li>
									<li><a href="#"><img src="./filer-color/color10.PNG" class="filter-color"></a></li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="filter-td-header">Giá tiền</td>
						</tr>
						<tr>
							<td class="filter-td-checkbox">
								<input type="checkbox" name="">Dưới 100,000đ<br>
								<input type="checkbox" name="">Từ 100,000đ-300,000đ <br>
								<input type="checkbox" name="">300.000đ-1,000,000<br>
								<input type="checkbox" name="">Trên 1,000,000<br>
								
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!----------------------------- footer ----------------------------->
		<?php include('includemain/footermain.php') ?>
	</form>
</body>
</html>

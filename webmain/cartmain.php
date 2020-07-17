<?php ob_start();
session_start();
if(!isset($_SESSION['iduser'])){
	header('location:homemain.php');
}
$iduser=$_SESSION['iduser'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Giỏ hàng</title>
	<?php include('includemain/headmain.php') ?>
</head>
<body style="background:#eff0f5;">
	<!----------------------------- header ----------------------------->
	<?php include('includemain/headermain.php'); ?>
	<!---------------------------- container ------------------------>
	<div id="container" >
		<div id="container_cart_main">
			<div id="container_giohang">
				<?php 
				/*==============================Đưa dữ liệu vào giỏ hàng==================*/
				$query="SELECT * FROM tblgiohang WHERE iduser=$iduser AND status=0";
				$results=mysqli_query($dbc,$query);
				$numr=mysqli_num_rows($results);
				$tongtien=0;
				if($numr==0) echo "<h3 style='text-align:center'>Không có sản phẩm</h3>";
				else{
				?>
				<table class="table table-striped">
					<tr>
						<th style="width: 10px;">STT</th>
						<th style="width: 150px; text-align: center;">Ảnh</th>
						<th style="width: 400px;text-align: center;">Tên sản phẩm</th>
						<th style="text-align: center;">Màu</th>
						<th style="text-align: center;">Size</th>
						<th style="width: 120px;">Đơn giá</th>
						<th style="width: 150px;">Số lượng</th>
						<th style="width: 120px;">Thành tiền</th>
						<th style="width: 100px;">Tùy chỉnh</th>
					</tr>
					<?php
					for($i=1;$i<=$numr;$i++){
						$d=mysqli_fetch_array($results);
						$idsp=$d['idsp'];
						$idmau=$d['idmau'];
						$query1="SELECT * FROM tblsanpham WHERE idsp=$idsp";
						$results1=mysqli_query($dbc,$query1);
						$d1=mysqli_fetch_array($results1);
						$query2="SELECT * FROM tblsanpham_mau WHERE id=$idmau";
						$results2=mysqli_query($dbc,$query2);
						$d2=mysqli_fetch_array($results2);
						$tongtien += $d['thanhtien'];
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td style="text-align: center;"><img src="<?php echo $d1['anh']; ?>" class="cart_img"></td>
							<td><span><?php echo $d1['tensp']; ?></span></td>
							<td><?php echo $d2['tenmau']; ?></td>
							<td><?php echo $d['size']; ?></td>
							<td><?php echo $d1['giasp']; ?></td>
							<td><input type="number" name="cart_soluong" min="1" max="<?php echo $d1['soluong']; ?>"
								style="text-align: center;" value="<?php echo $d['soluong']; ?>"></td>
								<td><span id="ajax_thanhtien_cart"><?php echo $d['thanhtien']; ?></span></td>
								<td><a href="acmain.php?id=<?php echo $d['id']; ?>&xoasp_cart=1" title="Xóa" style=" margin-left: 12px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"><i class="fa fa-times" style="font-size:22px;color:red;"></i>
								</a></td>
							</tr>
						<?php } ?>
					</table>
				<?php } ?>
				</div>	
				<form name="cart_thanhtoan" method="post" action="acmain.php">
					<div id="container_view">
						<?php 
						$query="SELECT * FROM tblusers WHERE id=$iduser";
						$results=mysqli_query($dbc,$query);
						$d=mysqli_fetch_array($results);
						$districtid=$d['districtid'];
						$provinceid=$d['provinceid'];
						$query1="SELECT * FROM district WHERE districtid='$districtid'";
						$results1=mysqli_query($dbc,$query1);
						$d1=mysqli_fetch_array($results1);
						$query2="SELECT * FROM province WHERE provinceid='$provinceid'";
						$results2=mysqli_query($dbc,$query2);
						$d2=mysqli_fetch_array($results2);
						$diachi=$d['diachi'].','.$d1['name'].','.$d2['name'];
						?>
						<h4>Thanh toán vận chuyển</h4>
						<input type="text" name="hoten"  class="form-control" placeholder="Tên người nhận" style="width: 240px;" required="required" value="<?php echo $d['hoten']; ?>">
						<input type="text" name="diachi" placeholder="Địa chỉ" class="form-control"  style="width: 240px;"  required="required"  value="<?php echo $diachi ?>">
						<input type="text" name="sdt" placeholder="Số điện thoại" class="form-control"  style="width: 240px;"  required="required" value="<?php echo $d['sdt']; ?>">
						<input type="text" name="email" placeholder="Email" class="form-control"  style="width: 240px;"  required="required" value="<?php echo $d['email']; ?>">
						<hr>
						<h4>Thông tin đơn hàng</h4>
						<hr>
						<table>
							<tr>
								<td class="cart_tt">Tạm tính</td>
								<td class="cart_tt_t"><?php echo $tongtien; ?></td>
							</tr>
							<tr>
								<td class="cart_tt">Phí giao hàng</td>
								<td class="cart_tt_t">FREE</td>
							</tr>
							<tr>
								<td class="cart_tt">Tổng cộng</td>
								<td class="cart_tt_t" style="color:#f57224;font-size: 20px;"><?php echo $tongtien; ?></td>
							</tr>
						</table>
						<?php if($numr==0) {?>
							<input type="button" name="" value="Thanh toán" class="submit_thanhtoan" id="submit_thanhtoan_ok">
						<?php }else{ ?>
							<input type="submit" name="cart_thanhtoan_submit" class="submit_thanhtoan" value="Thanh toán">
						<?php } ?>
					</div>
				</form>
			</div>
		</div>
		<!----------------------------- footer ----------------------------->
		<?php include('includemain/footermain.php') ?>
	</body>
	</html>

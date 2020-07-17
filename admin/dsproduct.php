<?php include('includeadmin/ktsession.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Danh sách sản phẩm</title>
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		<form name="addVideo" method="GET" action="ac.php">
			<?php include('../inc/myconnect.php');
			$query="SELECT * FROM tblsanpham ORDER BY ordernum";
			$kq=mysqli_query($dbc,$query);
			?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>STT</th>
						<th style="width: 200px;">Tên sản phẩm</th>
						<th>idL</th>
						<th>Giá bán</th>
						<th>Giá gốc</th>
						<th>Size</th>
						<th style="width: 100px;">Màu</th>
						<th>Giới tính</th>
						<th>Số lượng</th>
						<th>Ngày đăng</th>
						<th style="text-align: center;">Thứ tự</th>
						<th style="text-align: center;">Trạng thái</th>
						<th>Ảnh</th>
						<th>Tùy chỉnh</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					while ($d=mysqli_fetch_array($kq)) {
						$idsp=$d['idsp'];
						$mausac='';
						$query1="SELECT * FROM tblsanpham_mau WHERE idsp='$idsp'";
						$kq1=mysqli_query($dbc,$query1);
						while ($d1=mysqli_fetch_array($kq1)){
							$mausac=$mausac.$d1['tenmau'].",";
						}
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php  echo $d['tensp']?></td>
							<td><?php echo $d['idL'] ?></td>
							<td><?php  echo $d['giasp']?></td>
							<td><?php  echo $d['giagoc']?></td>
							<td><?php  echo $d['size']?></td>
							<td><?php  echo $mausac?></td>
							<td style="text-align: center;"><?php if($d['gioitinh']==1) echo "Nam"; else{if($d['gioitinh']==0) echo "Nữ"; else echo "NN";};?>
						</td>
						<td style="text-align: center;"><?php  echo $d['soluong']?></td>
						<td><?php  echo $d['ngaydang']?></td>	
						<td style="text-align: center;"><?php  echo $d['ordernum']?></td>
						<td style="text-align: center;"><?php if($d['status']==1) echo "Hiện"; else echo "Ẩn" ;?></td>
						<td><img src="<?php echo $d['anh'] ?>" class="dsproduct-img"></td>
						<td>
							<a href="dsproduct.php?id=<?php echo $d['idsp'];?>&submitsua=1" title="Chỉnh sửa"><i class="fa fa-edit" style="font-size:22px;color:red"></i>
							</a>
							<a href="ac.php?id=<?php echo $d['idsp']?>&productxoa=1" title="Xóa" style=" margin-left: 12px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"><i class="fa fa-times" style="font-size:22px;color:red;"></i>
							</a>
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</form>
		<?php if(isset($_GET['id'])&&isset($_GET['submitsua'])){
			$id=$_GET['id'];
			?>
			<form method="POST" action="ac.php" enctype="multipart/form-data">
				<?php
				$query="SELECT * FROM tblsanpham WHERE idsp=$id;";
				$kq=mysqli_query($dbc,$query);
				$d=mysqli_fetch_array($kq);
				$gioitinh=$d['gioitinh'];
				$query1="SELECT * FROM tblsanpham_mau WHERE idsp=$id ORDER BY id";
				$kq1=mysqli_query($dbc,$query1);
				$num=mysqli_num_rows($kq1);
				?>
				<div class="addVideo-group">
					<input type="text" name="id" value="<?php echo $id ?>" class="hide">
					<label>Tên sản phẩm</label><br>
					<input type="text" name="title" class="group-input" placeholder="Tên sản phẩm" required="required" value="<?php echo $d['tensp'] ?>">
				</div>
				<div class="addVideo-group">
					<label>Ảnh</label><br>
					<input type="file" name="anh" class="group-input" placeholder="Ảnh đại diện" value="">
				</div>
				<div class="addVideo-group">
					<label>Giá bán</label><br>
					<input type="text" name="dongia" class="group-input" placeholder="Đơn giá" required="required" value="<?php echo $d['giasp'] ?>">
				</div>
				<div class="addVideo-group">
					<label>Giá gốc</label><br>
					<input type="text" name="giagoc" class="group-input" placeholder="Đơn giá gốc" required="required" value="<?php echo $d['giagoc'] ?>">
				</div>
				<div class="addVideo-group">
					<label>Màu sắc</label><br>
					<input type="text" name="product-color" value="<?php echo $num ?>" class="product-color-input">
					<?php for($j=1;$j<=$num;$j++){ 
						$mau="mau".$j;
						$link="link".$j;
						$div_color="add-color".$j;
						$id_pro_color="id-product-color".$j;
						$d1=mysqli_fetch_array($kq1);
						?>
						<div id="<?php echo $div_color; ?>" class="add-color-100">
							<label class="label-color">Tên màu</label>
							<input type="text" name="<?php echo $id_pro_color; ?>" value="<?php echo $d1['id'] ?>" class="hide">
							<input type="text" name="<?php echo $mau ?>" placeholder="Tên màu" required="required" class="group-input-color" value="<?php echo $d1['tenmau'] ?>"><br><br>
							<label class="label-color">Ảnh</label>
							<input type="file" name="<?php echo $link ?>" placeholder="Link" required="required" class="group-input-color" style="margin-left: 46px;">
							<hr>
						</div>
					<?php } ?>
					<button type="button" class="btn btn-info" style="margin-left: 300px;margin-top: 10px;" id="add-color">Thêm</button>
					<button type="button" class="btn btn-info" style="margin-left: 10px;margin-top: 10px;" id="del-color">Xóa</button>
				</div>
				<div class="addVideo-group">
					<label>Size</label><br>
					<input type="text" name="size" class="group-input" placeholder="Size" value="<?php echo $d['size'] ?>">
				</div>
				<div class="addVideo-group">
					<label>Tổng số lượng</label><br>
					<input type="text" name="soluong" class="group-input" placeholder="Tổng số lượng" value="<?php echo $d['soluong'] ?>">
				</div>
				<div class="addVideo-group">
					<label>Nội dung</label><br>
					<textarea name="noidung" id="ten" class="ckeditor"><?php echo $d['noidung'] ?></textarea>

				</div>
				<div class="addVideo-group">
					<label>Thứ tự</label><br>
					<input type="text" name="ordernum" class="group-input" placeholder="Số thứ tự" value="<?php echo $d['ordernum'] ?>">
				</div>
				<div class="addVideo-group">
					<label>Giới tính</label><br><br>
					<select name="gioitinh" class="loaisp_option" id="gioitinh_select">
						<option value="1"  <?php if($d['gioitinh']==1) echo "selected='selected'"?> >Nam</option>
						<option value="0"  <?php if($d['gioitinh']==0) echo "selected='selected'"?> >Nữ</option>
						<option value="10"  <?php if($d['gioitinh']==10) echo "selected='selected'"?> >NN</option>
					</select>
				</div>
				<div class="addVideo-group">
					<label>Loại giày</label><br>
					<div id="addloai">
						<select name="loai" class="loaisp_option">
							<?php 
							include('../inc/myconnect.php');
							$queryloai="SELECT * FROM loaisp WHERE gioitinh=$gioitinh||gioitinh =10";
							$resultsloai=mysqli_query($dbc,$queryloai);
							while ($dloai=mysqli_fetch_array($resultsloai)) {
								?>
								<option value="<?php echo $dloai['idL'] ?>" <?php if($dloai['idL']==$d['idL']) echo "selected='selected'"  ?>><?php echo $dloai['ten']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="addVideo-group">
					<label>Trạng thái</label><br><br>
					<input type="radio" name="status" value="1" <?php if($d['status']==1) echo "checked='checked'"?>  style="margin-left: 15px;"> Hiển thị
					<input type="radio" name="status" value="0" style="margin-left: 10px;" <?php if($d['status']==0) echo "checked='checked'"?> > Không hiển thị
				</div>
				<div class="addVideo-group">
					<input type="submit" name="submit-product-sua" value="Lưu" >
					<a href="dsproduct.php"><button type="button" class="btn btn-primary" style="border-radius: 10px;height: 30px;background: #086dd5db;color: white; width: 100px;" title="Thoát">Thoát</button></a>
				</div>
			</form>
		<?php }
		?>
	</div>
	<!-- <?php include('includeadmin/footeradmin.php') ?> -->
</body>
</html>
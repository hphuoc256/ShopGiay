<?php include('includeadmin/ktsession.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Thêm mới sản phẩm</title>
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		<form name="addVideo" method="post" action="ac.php" enctype="multipart/form-data">
			<div class="addVideo-group">
				<label>Tên sản phẩm</label><br>
				<input type="text" name="title" class="group-input" placeholder="Tên sản phẩm" required="required">
			</div>
			<div class="addVideo-group">
				<label>Ảnh</label><br>
				<input type="file" name="anh" class="group-input" placeholder="Ảnh đại diện" required="required">
			</div>
			<div class="addVideo-group">
				<label>Giá bán</label><br>
				<input type="text" name="dongia" class="group-input" placeholder="Đơn giá" required="required">
			</div>
			<div class="addVideo-group">
				<label>Giá gốc</label><br>
				<input type="text" name="giagoc" class="group-input" placeholder="Đơn giá gốc" required="required">
			</div>
			<div class="addVideo-group">
				<label>Màu sắc</label><br>
				<input type="number" name="product-color" value="1" class="product-color-input">
				<div id="add-color1" class="add-color-100">
					<label class="label-color">Tên màu</label>
					<input type="text" name="mau1" placeholder="Tên màu" required="required" class="group-input-color"><br><br>
					<label class="label-color">Ảnh</label>
					<input type="file" name="link1" placeholder="Link" required="required" class="group-input-color" style="margin-left: 46px;">
					<hr>
				</div>
				<button type="button" class="btn btn-info" style="margin-left: 300px;margin-top: 10px;" id="add-color">Thêm</button>
				<button type="button" class="btn btn-info" style="margin-left: 10px;margin-top: 10px;" id="del-color">Xóa</button>
			</div>
			<div class="addVideo-group">
				<label>Size</label><br>
				<input type="text" name="size" class="group-input" placeholder="Size">
			</div>
			<div class="addVideo-group">
				<label>Tổng số lượng</label><br>
				<input type="text" name="soluong" class="group-input" placeholder="Tổng số lượng">
			</div>
			<div class="addVideo-group">
				<label>Nội dung</label><br>
				<textarea name="noidung" id="ten" class="ckeditor"></textarea>
				
			</div>
			<div class="addVideo-group">
				<label>Thứ tự</label><br>
				<input type="text" name="ordernum" class="group-input" placeholder="Số thứ tự">
			</div>
			<div class="addVideo-group">
				<label>Giới tính</label><br><br>
				<select name="gioitinh" class="loaisp_option" id="gioitinh_select">
					<option value="1" selected="selected">Nam</option>
					<option value="0">Nữ</option>
					<option value="10">NN</option>
				</select>
			</div>
			<div class="addVideo-group">
				<label>Loại giày</label><br>
				<div id="addloai">
					<select name="loai" class="loaisp_option">
						<?php 
						include('../inc/myconnect.php');
						$queryloai="SELECT * FROM loaisp WHERE gioitinh=1||gioitinh =10";
						$resultsloai=mysqli_query($dbc,$queryloai);
						while ($dloai=mysqli_fetch_array($resultsloai)) {
							?>
							<option value="<?php echo $dloai['idL'] ?>"><?php echo $dloai['ten']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="addVideo-group">
				<label>Trạng thái</label><br><br>
				<input type="radio" name="status" value="1" checked="checked" style="margin-left: 15px;"> Hiển thị
				<input type="radio" name="status" value="0" style="margin-left: 10px;"> Không hiển thị
			</div>
			<div class="addVideo-group">
				<input type="submit" name="submit-product" value="Lưu">
				<a href="addproduct.php" onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu không?');"> <button type="button" class="btn btn-danger" style="border-radius: 7px;width: 95px;">Xóa</button>
				</a>
			</div>
		</form>
	</div>
	<?php include('includeadmin/footeradmin.php') ?>
</body>
</html>
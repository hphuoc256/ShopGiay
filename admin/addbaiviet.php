<?php include('includeadmin/ktsession.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Thêm mới bài viết</title>
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		<form name="addVideo" method="post" action="ac.php" enctype="multipart/form-data">
			<div class="addVideo-group">
				<label>Tiêu đề</label><br>
				<input type="text" name="title" class="group-input" placeholder="Tên sản phẩm" required="required">
			</div>
			<div class="addVideo-group">
				<label>Ảnh</label><br>
				<input type="file" name="anh" class="group-input" placeholder="Link" required="required">
			</div>
			<div class="addVideo-group">
				<label>Tóm tắt</label><br>
				<textarea name="tomtat" class="ckeditor"></textarea>
			</div>
			<div class="addVideo-group">
				<label>Nội dung</label><br>
				<textarea name="noidung" id="ten" class="ckeditor"></textarea>
			</div>
			<div class="addVideo-group">
				<label>Thứ tự</label><br>
				<input type="text" name="ordernum" class="group-input" placeholder="Số thứ tự" required="required">
			</div>
			<div class="addVideo-group">
				<label>Trạng thái</label><br><br>
				<input type="radio" name="status" value="1" checked="checked" style="margin-left: 15px;"> Hiển thị
				<input type="radio" name="status" value="0" style="margin-left: 10px;"> Không hiển thị
			</div>
			<div class="addVideo-group">
				<input type="submit" name="submit_baiviet" value="Lưu">
				<a href="addbaiviet.php" onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu không?');"> <button type="button" class="btn btn-danger" style="border-radius: 7px;width: 95px;">Xóa</button>
				</a>
			</div>
		</form>
	</div>
	<?php include('includeadmin/footeradmin.php') ?>
</body>
</html>
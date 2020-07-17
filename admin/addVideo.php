<?php include('includeadmin/ktsession.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Thêm mới video</title>
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		<form name="addVideo" method="GET" action="ac.php">
			<div class="addVideo-group">
				<label>Tiêu đề</label><br>
				<input type="text" name="title" class="group-input" placeholder="Tiêu đề" required="required">
			</div>
			<div class="addVideo-group">
				<label>Link</label><br>
				<input type="text" name="link" class="group-input" placeholder="link" required="required">
			</div>
			<div class="addVideo-group">
				<label>Thứ tự</label><br>
				<input type="text" name="ordernum" class="group-input" placeholder="số thứ tự" required="required">
			</div>
			<div class="addVideo-group">
				<label>Trạng thái</label><br><br>
				<input type="radio" name="status" value="1" checked="checked" style="margin-left: 15px;">Hiển thị
				<input type="radio" name="status" value="0" style="margin-left: 10px;">Không hiển thị
			</div>
			<div class="addVideo-group">
				<input type="submit" name="submit-video" value="Lưu">
				<a href="addVideo.php" onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu không?');"> <button type="button" class="btn btn-danger" style="border-radius: 7px;width: 95px;">Xóa</button></a>
			</div>
		</form>
	</div>
	<?php include('includeadmin/footeradmin.php') ?>
</body>
</html>
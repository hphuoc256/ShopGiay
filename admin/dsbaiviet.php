<?php include('includeadmin/ktsession.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Danh sách bài viết</title>
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		<fieldset class="fieldset-add">
			<legend>Danh sách các bài viết</legend>
		<form name="addVideo" method="GET" action="ac.php">
			<?php include('../inc/myconnect.php');
			$query="SELECT * FROM tblbaiviet ORDER BY ordernum";
			$kq=mysqli_query($dbc,$query);
			?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tiêu đề</th>
						<th>Tóm tắt</th>
						<th style="text-align: center; width: 80px;">Ảnh</th>
						<th style="text-align: center;">view</th>
						<th>Ngày đăng</th>
						<th style="text-align: center;">Thứ tự</th>
						<th style="text-align: center;">Trạng thái</th>
						<th>Tùy chỉnh</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					while ($d=mysqli_fetch_array($kq)) {
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td style="width: 270px;"><?php  echo $d['title']?></td>
							<td style="width: 320px;"><?php  echo $d['tomtat']?></td>
							<td><img src="<?php echo $d['anh'] ?>" class="dsproduct-img"></td>
							<td style="width: 100px;"><?php  echo $d['view']?></td>
							<td><?php  echo $d['ngaydang']?></td>
							<td style="text-align: center;"><?php  echo $d['ordernum']?></td>
							<td style="text-align: center;"><?php if($d['status']==1) echo "Hiện"; else echo "Ẩn" ;?></td>
							<td>
								<a href="dsbaiviet.php?id=<?php echo $d['id'];?>&submitsua=1" title="Chỉnh sửa"><i class="fa fa-edit" style="font-size:22px;color:red"></i>
								</a>
								<a href="ac.php?id=<?php echo $d['id']?>&baivietxoa=1" title="Xóa" style=" margin-left: 12px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"><i class="fa fa-times" style="font-size:22px;color:red;"></i>
								</a>
							</td>
						</tr>
						<?php $i++; } ?>
					</tbody>
				</table>
			</form>
		</fieldset>
			<?php if(isset($_GET['id'])&&isset($_GET['submitsua'])){
				$id=$_GET['id'];
				?>
				<form method="POST" action="ac.php" enctype="multipart/form-data">
					<?php
					$query="SELECT * FROM tblbaiviet WHERE id=$id;";
					$kq=mysqli_query($dbc,$query);
					$d=mysqli_fetch_array($kq);
					?>
					<div class="addVideo-group">
						<input type="text" name="id" value="<?php echo $id ?>" class="hide">
						<label>Tiêu đề</label><br>
						<input type="text" name="title" class="group-input" placeholder="Tiêu đề" required="required" value="<?php echo $d['title'] ?>">
					</div>
					<div class="addVideo-group">
						<label>Ảnh</label><br>
						<input type="file" name="anh" class="group-input" placeholder="Link">
					</div>

					<div class="addVideo-group">
						<label>Tóm tắt</label><br>
						<textarea name="tomtat" id="ten" class="ckeditor"><?php echo $d['tomtat'] ?></textarea>
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
						<label>Trạng thái</label><br><br>
						<input type="radio" name="status" value="1" <?php if($d['status']==1) echo "checked='checked'"?>  style="margin-left: 15px;"> Hiển thị
						<input type="radio" name="status" value="0" style="margin-left: 10px;" <?php if($d['status']==0) echo "checked='checked'"?> > Không hiển thị
					</div>
					<div class="addVideo-group">
						<input type="submit" name="submit_baiviet_sua" value="Lưu" >
						<a href="dsbaiviet.php"><button type="button" class="btn btn-primary" style="border-radius: 10px;height: 30px;background: #086dd5db;color: white; width: 100px;" title="Thoát">Thoát</button></a>
					</div>
				</form>
			<?php }
			?>
		</div>
		<!-- <?php include('includeadmin/footeradmin.php') ?> -->
	</body>
	</html>
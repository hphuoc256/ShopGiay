<?php include('includeadmin/ktsession.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý slide</title>
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		<fieldset class="fieldset-add">
			<legend>Thêm mới slide</legend>
			<form name="addSlide" method="post" action="ac.php" enctype="multipart/form-data">
				<div class="addVideo-group">
					<label>Tiêu đề</label><br>
					<input type="text" name="title" class="group-input" placeholder="Tên màu" required="required">
				</div>
				<div class="addVideo-group">
					<label>Ảnh</label><br>
					<input type="file" name="anh" class="group-input" placeholder="Link" required="required">
				</div>
				<div class="addVideo-group">
					<label>Link</label><br>
					<input type="text" name="link" class="group-input" placeholder="Link" required="required">
				</div>
				<div class="addVideo-group">
					<label>Thứ tự</label><br>
					<input type="text" name="ordernum" class="group-input" placeholder="Số thứ tự" required="required">
				</div>
				<div class="addVideo-group">
					<label>Trạng thái</label><br><br>
					<input type="radio" name="status" value="1" checked="checked" style="margin-left: 15px;">Hiển thị
					<input type="radio" name="status" value="0" style="margin-left: 10px;">Không hiển thị
				</div>
				<div class="addVideo-group">
					<input type="submit" name="submit-Slide" value="Lưu">
					<a href="addslider.php" onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu không?');"> <button type="button" class="btn btn-danger" style="border-radius: 7px;width: 95px;">Xóa</button>
					</a>
				</div>
			</form>
		</fieldset>
		<form method="GET" name="addSlide1">
			<?php 
			include('../inc/myconnect.php');
			$query="SELECT * FROM tblslider ORDER BY ordernum";
			$kq=mysqli_query($dbc,$query);
			$num=mysqli_num_rows($kq);
			if($num > 0){ ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tiêu đề</th>
							<th>Ảnh</th>
							<th>Link</th>
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
								<td><?php  echo $d['title']?></td>
								<td style="width: 350px;"><img src="<?php  echo $d['anh']?>" class="slide-img-list"></td>
								<td><?php  echo $d['link']?></td>
								<td style="text-align: center;"><?php  echo $d['ordernum']?></td>
								<td style="text-align: center;"><?php if($d['status']==1) echo "Hiện"; else echo "Ẩn" ;?></td>
								<td>
									<a href="addslider.php?id=<?php echo $d['id'];?>&submitsua=1" title="Chỉnh sửa"><i class="fa fa-edit" style="font-size:22px;color:red"></i>
									</a>
									<a href="ac.php?id=<?php echo $d['id']?>&slidexoa=1" title="Xóa" style=" margin-left: 12px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"><i class="fa fa-times" style="font-size:22px;color:red;"></i>
									</a>
								</td>
							</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
				<?php  } ?>
			</form>

		</div>
		<?php if(isset($_GET['id'])&&isset($_GET['submitsua'])) {?>
			<div id="chinhsua">
				<?php  $id=$_GET['id'];?>
				<form method="post" action="ac.php" enctype="multipart/form-data">
					<?php
					$query="SELECT * FROM tblslider WHERE id=$id;";
					$kq=mysqli_query($dbc,$query);
					$d=mysqli_fetch_array($kq);
					?>
					<input type="text" name="id" value="<?php echo $id ?>" class="hide">
					<div class="addVideo-group">
						<label>Tiêu đề</label><br>
						<input type="text" name="title" class="group-input" placeholder="Tiêu đề" required="required" value="<?php echo $d['title'] ?>">
					</div>
					<div class="addVideo-group">
						<label>Ảnh</label><br>
						<input type="file" name="anh" class="group-input" placeholder="Link">
					</div>
					<div class="addVideo-group">
						<label>Link</label><br>
						<input type="text" name="link" class="group-input" placeholder="Link" required="required" value="<?php echo $d['link'] ?>">
					</div>
					<div class="addVideo-group">
						<label>Thứ tự</label><br>
						<input type="text" name="ordernum" class="group-input" placeholder="Số thứ tự" required="required" value="<?php echo $d['ordernum'] ?>">
					</div>
					<div class="addVideo-group">
						<label>Trạng thái</label><br><br>
						<input type="radio" name="status" value="1" <?php if($d['status']==1) echo ("checked='checked'") ?> style="margin-left: 15px;">Hiển thị
						<input type="radio" name="status" value="0" <?php if($d['status']==0) echo ("checked='checked'") ?> style="margin-left: 10px;">Không hiển thị
					</div>
					<div class="addVideo-group">
						<input type="submit" name="submit-slide-sua" value="Lưu" >
						<a href="addslider.php"><button type="button" class="btn btn-primary" style="border-radius: 10px;height: 30px;background: #086dd5db;color: white; width: 100px;" title="Thoát">Thoát</button></a>
					</div>
				</form>
			<?php } ?>
		</div>
		<?php include('includeadmin/footeradmin.php') ?>
	</body>
	</html>
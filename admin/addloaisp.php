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
			<legend>Thêm mới loại sản phẩm</legend>
			<form name="addloaisp" method="post" action="ac.php" enctype="multipart/form-data">
				<div class="addVideo-group">
					<label>Tên loại</label><br>
					<input type="text" name="title" class="group-input" placeholder="Tên loại" required="required">
				</div>
				<div class="addVideo-group">
					<label>Giới tính</label><br><br>
					<input type="radio" name="gioitinh" value="1" checked="checked" style="margin-left: 15px;"> Nam
					<input type="radio" name="gioitinh" value="0" style="margin-left: 10px;"> Nữ
					<input type="radio" name="gioitinh" value="10" style="margin-left: 10px;"> NN
				</div>
				<div class="addVideo-group">
					<label>Trạng thái</label><br><br>
					<input type="radio" name="status" value="1" checked="checked" style="margin-left: 15px;">Hiển thị
					<input type="radio" name="status" value="0" style="margin-left: 10px;">Không hiển thị
				</div>
				<div class="addVideo-group">
					<input type="submit" name="submit_loaisp" value="Lưu">
					<a href="addslider.php" onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu không?');"> <button type="button" class="btn btn-danger" style="border-radius: 7px;width: 95px;">Xóa</button>
					</a>
				</div>
			</form>
		</fieldset>
		<form method="GET" name="addloaisp1">
			<?php 
			include('../inc/myconnect.php');
			$query="SELECT * FROM loaisp";
			$kq=mysqli_query($dbc,$query);
			$num=mysqli_num_rows($kq);
			if($num > 0){ ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên loại</th>
							<th style="text-align: center;">Giới tính</th>
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
								<td><?php  echo $d['ten']?></td>
								<td style="text-align: center;"><?php if($d['gioitinh']==1) echo "Nam"; else{if($d['gioitinh']==0) echo "Nữ"; else echo "NN";};?></td>
								<td style="text-align: center;"><?php if($d['status']==1) echo "Hiện"; else echo "Ẩn" ;?></td>
								<td>
									<a href="addloaisp.php?id=<?php echo $d['idL'];?>&submitsua=1" title="Chỉnh sửa"><i class="fa fa-edit" style="font-size:22px;color:red"></i>
									</a>
									<a href="ac.php?id=<?php echo $d['idL']?>&loaispxoa=1" title="Xóa" style=" margin-left: 12px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"><i class="fa fa-times" style="font-size:22px;color:red;"></i>
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
					$query="SELECT * FROM loaisp WHERE idL=$id;";
					$kq=mysqli_query($dbc,$query);
					$d=mysqli_fetch_array($kq);
					?>
					<input type="text" name="id" value="<?php echo $d['idL'] ?>" class="hide">
					<div class="addVideo-group">
						<label>Tên loại</label><br>
						<input type="text" name="title" class="group-input" placeholder="Tên loại" required="required" value="<?php echo $d['ten'] ?>">
					</div>
					<div class="addVideo-group">
						<label>Giới tính</label><br><br>
						<input type="radio" name="gioitinh" value="1" <?php if($d['gioitinh']==1) echo "checked='checked'"?> style="margin-left: 15px;"> Nam
						<input type="radio" name="gioitinh" value="0" style="margin-left: 10px;" <?php if($d['gioitinh']==0) echo "checked='checked'"?> > Nữ
						<input type="radio" name="gioitinh" value="10" style="margin-left: 10px;" <?php if($d['gioitinh']==10) echo "checked='checked'"?> > NN
					</div>
					<div class="addVideo-group">
						<label>Trạng thái</label><br><br>
						<input type="radio" name="status" value="1" <?php if($d['status']==1) echo ("checked='checked'") ?> style="margin-left: 15px;">Hiển thị
						<input type="radio" name="status" value="0" <?php if($d['status']==0) echo ("checked='checked'") ?> style="margin-left: 10px;">Không hiển thị
					</div>
					<div class="addVideo-group">
						<input type="submit" name="submit_loaisp_sua" value="Lưu" >
						<a href="addloaisp.php"><button type="button" class="btn btn-primary" style="border-radius: 10px;height: 30px;background: #086dd5db;color: white; width: 100px;" title="Thoát">Thoát</button></a>
					</div>
				</form>
			<?php } ?>
		</div>
	</body>
	</html>
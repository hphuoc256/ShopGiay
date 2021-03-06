<?php include('includeadmin/ktsession.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Danh sách video</title>
	<?php include('includeadmin/headadmin.php') ?>
</head>
<body>
	<?php include('includeadmin/headeradmin.php'); ?>
	<?php include('includeadmin/sidebaradmin.php') ?>
	<div id="container">
		<form name="addVideo" method="GET" action="ac.php">
			<?php include('../inc/myconnect.php');
			$query="SELECT * FROM tblVideo ORDER BY ordernum";
			$kq=mysqli_query($dbc,$query);
			?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tiêu đề</th>
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
							<td><?php  echo $d['link']?></td>
							<td style="text-align: center;"><?php  echo $d['ordernum']?></td>
							<td style="text-align: center;"><?php if($d['status']==1) echo "Hiện"; else echo "Ẩn" ;?></td>
							<td>
								<a href="dsVideo.php?id=<?php echo $d['id'];?>&submitsua=1" title="Chỉnh sửa"><i class="fa fa-edit" style="font-size:22px;color:red"></i>
								</a>
								<a href="ac.php?id=<?php echo $d['id']?>&videoxoa=1" title="Xóa" style=" margin-left: 12px;" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"><i class="fa fa-times" style="font-size:22px;color:red;"></i>
								</a>
							</td>
						</tr>
						<?php $i++; } ?>
					</tbody>
				</table>
			</form>
			<?php if(isset($_GET['id'])&&isset($_GET['submitsua'])){?>
				<form method="GET" action="ac.php">
					<?php
					$id=$_GET['id'];
					$query="SELECT * FROM tblVideo WHERE id=$id;";
					$kq=mysqli_query($dbc,$query);
					$d=mysqli_fetch_array($kq);
					?>
					<input type="text" name="id" value="<?php echo $id ?>" id="hide">
					<div class="addVideo-group">
						<label>Tiêu đề</label><br>
						<input type="text" name="title" class="group-input" placeholder="Tiêu đề" required="required" value="<?php echo $d['title'] ?>">
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
						<input type="submit" name="submit-video-sua" value="Lưu" >
						<a href="dsVideo.php"><button type="button" class="btn btn-primary" style="border-radius: 10px;height: 30px;background: #086dd5db;color: white; width: 100px;" title="Thoát">Thoát</button></a>
					</div>
				</form>
			<?php } ?>
		</div>
		<!-- <?php include('includeadmin/footeradmin.php') ?> -->
	</body>
	</html>
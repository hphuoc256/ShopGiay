<?php
include('../inc/myconnect.php');
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$query="SELECT * FROM tblsanpham WHERE idsp='$id' ";
	$results=mysqli_query($dbc,$query);
	$d=mysqli_fetch_array($results);
	$query1="SELECT * FROM tblsanpham_mau WHERE idsp='$id'";
	$results1=mysqli_query($dbc,$query1);
	$numcolor=mysqli_num_rows($results1);
	?>
	<input type="text" name="numcolor" disabled="disabled" class="hide" value="<?php echo $numcolor ?>">
	<div id="contrainer-product">
		<div id="combination">
			<div id="contrainer-title">
				<label><a href="homemain.php">Trang chủ</a> / <?php echo $d['tensp'] ?></label>
			</div>
			<div id="product-view">
				<div id="product-view-img">
					<div id="view-menu">
						<ul >
							<li><div><img src="<?php echo $d['anh']; ?>" class="view-img1"></div></li>
							<?php while ($d1=mysqli_fetch_array($results1)) {
								?>
								<li><div><img src="<?php echo $d1['anh'] ?>" class="view-img1"></div></li>
							<?php } ?>
						</ul>
					</div>
					<div id="view" style="float: left;width: 420px">
						<img src="<?php echo $d['anh'] ?>" class="view-img">
					</div>
				</div>
				<form method="get" action="acmain.php" name="themvaogiaohang">
					<div id="product-view-detail">
						<ul>
							<li>
								<input type="text" name="idsp" value="<?php echo $d['idsp']; ?>" class="hide"></li>
							<li><label style="font-size: 22px; color: black;"><?php echo $d['tensp']; ?></label></li>
							<br>
							<li><label style="font-size: 24px; color:red;">Giá: <?php echo number_format($d['giasp']); ?></label></li>
							<li><label style="font-size: 15px;color: #9e9e9e;">Giá gốc: <strike><?php echo number_format($d['giagoc']);?></strike></label></li>
							<?php 
							$size=explode(",", $d['size']);
							$sizenum= sizeof($size);
							?>
							<li style="margin-top: 25px;"><label>Size:</label>
								<select name="size_option" style="margin-left: 62px; width: 84px; height: 20px; border: 1px solid #0000001f;">
									<?php for($i=0;$i<$sizenum;$i++){ ?>
										<option ><?php echo $size[$i] ?></option>
									<?php } ?>
								</select>
							</li>
							<li style="margin-top: 12px;">
								<label>Số lượng:</label>
								<input type="number" min="1" max="<?php echo $d['soluong']; ?>" value="1" style="margin-left: 36px; width: 84px; height: 20px; border: 1px solid #0000001f; text-align: center;" name="soluong" >
								<?php if($d['soluong']==0) echo "sản phẩm tạm thời hết hàng"?>
							</li>
							<li style="margin-top: 12px;" >
								<?php if(!isset($_SESSION['usernames'])){ ?>
								<input type="button" value="Mua ngay" name="muangay" class="buy_submit" style="background: #ffb916;" id="submit_buy_now_no">
								<input type="button" value="Thêm vào giỏ hàng"  name="giohang" class="buy_submit" style="background: #f57224;" id="add_cart_no">
							<?php } else{ ?>
								<input type="submit" value="Mua ngay" name="add_muangay" class="buy_submit" style="background: #ffb916;" id="submit_buy_now">
								<input type="button" value="Thêm vào giỏ hàng"  name="add_giohang" class="buy_submit" style="background: #f57224;" id="add_cart">
							<?php } ?>
							</li>
								<li>
									<ul style="margin-top: 20px;padding: 0px;">
										<li>
											<label><b>Màu sắc:</b></label>
										</li>
										<br>
										<?php 
										$query2="SELECT * FROM tblsanpham_mau WHERE idsp='$id'";
										$results2=mysqli_query($dbc,$query2);
										for($i=1;$i<=$numcolor;$i++){
											$d2=mysqli_fetch_array($results2);
											?>
											<li class="product-color-li">
												<img src="<?php echo $d2['anh']; ?>" class="product-color">
												<br>
												<input type="radio" name="color" <?php if($i==1) echo "checked='checked'";?> value="<?php echo $d2['id']; ?>" id="numcolor<?php echo $i?>" >
												<?php echo $d2['tenmau']; ?>
											</li>
										<?php } ?>
									</ul>
								</li>
							</ul>
						</div>
					</form>
			<!-- <div id="product-view-help">
				<ul style="padding: 0px;margin: 14px;">
					<li class="product-view-help-li-1"><label class="product-view-help-li-1-header">Tùy chọn giao hàng</label>
					</li>
					<li class="product-view-help-li-2">
						<i class="fa fa-map-marker" style="font-size:24px; float: left; margin-right: 10px;"></i>
						<p>Đường TCH35, Tân Chánh Hiệp, quận 12,qqqqqqqqqqqqqqqqqqqqqqq TP.HCM <a href="#">Thay đổi</a></p>
						
					</li>
					<li class="product-view-help-li-2">
						<i class="fa fa-truck" style="font-size:24px; float: left;"></i>
						<div class="product-view-help-li-2-div">Giao hàng tiêu chuẩn<br><span class="span-hide">3-8 ngày</span>
						</div>
						<span style="float: right; color: black;">0đ</span> 
					</li>
					<li class="product-view-help-li-2">
						<i class="fa fa-cc-visa" style="font-size:24px; float: left;"></i>
						<div class="product-view-help-li-2-div">Thanh toán khi nhận hàng
						</div>
					</li>
					<li class="product-view-help-li-1"><label class="product-view-help-li-1-header">Đổi trả & bảo hành</label></li>
					<li style="padding-top: 3px;height: 50px;">
						<i class="fa fa-refresh	" style="font-size:24px; float: left;"></i>
						<div class="product-view-help-li-2-div">7 ngày đổi trả dễ dàng<br><span class="span-hide">Không được đổi trả với lí do"Không vừa ý"</span> 
						</div>
					</li>
					<li class="product-view-help-li-2">
						<i class="fa fa-envira" style="font-size:24px; float: left;"></i>
						<div class="product-view-help-li-2-div">
							Bảo hành 6 tháng
						</div>
					</li>
				</ul>
			</div> -->
		</div>
	</div>
	<div id="clear" style="background: #eff0f5; height: 10px; margin-top:20px;"></div>

	<!-------------------------------------Phần giới thiệu----------------------------->
	<div id="introduce">
		<div id="introduce-main">
			<div id="mota_sp">
				<h2 class="introduce-main-header">Mô tả sản phẩm</h2>
				<div>
					<div id="introduce-main-content">
						<?php echo $d['noidung'];?>
					</div>
				</div>
			</div>
			<div id="product-cmt">
				<label style="margin-left: 10px;font-size: 16px;">Câu hỏi về sản phẩm này</label>
				<div class="media">
					<div class="media-left">
						<img src="../picture/logo/logo2.PNG" class="media-object" style="width:60px">
					</div>
					<div class="media-body">
						<h4 class="media-heading" style="color: #9e9e9e;">Left-aligned 
							<div>
								<ul class="product-cmt-ellipsis-v">
									<li class="product-cmt-ellipsis-v-li" ><i class="fa fa-ellipsis-v" id="1"></i></li>
									<li class="product-cmt-ellipsis-v-li">
										<ul class="product-cmt-ellipsis-v-sub" id="11">
											<a href="#"><li>Chỉnh sửa</li></a>
											<a href="#"><li>Xóa</li></a>
										</ul>
									</li>
								</ul>
							</div>
						</h4>
						<label style="font-size: 10px; color: #9e9e9e;">4 giờ trước</label>
						<p style="width: 800px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<img src="../picture/logo/logo2.PNG" class="media-object" style="width:60px">
					</div>
					<div class="media-body">
						<h4 class="media-heading" style="color: #9e9e9e;">Left-aligned 
							<div>
								<ul class="product-cmt-ellipsis-v">
									<li class="product-cmt-ellipsis-v-li"><i class="fa fa-ellipsis-v" id="2"></i></li>
									<li class="product-cmt-ellipsis-v-li">
										<ul class="product-cmt-ellipsis-v-sub" id="21">
											<a href="#"><li>Chỉnh sửa</li></a>
											<a href="#"><li>Xóa</li></a>
										</ul>
									</li>
								</ul>
							</div>
						</h4>
						<label style="font-size: 10px; color: #9e9e9e;">4 giờ trước</label>
						<p style="width: 800px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<img src="../picture/logo/logo2.PNG" class="media-object" style="width:60px">
					</div>
					<div class="media-body">
						<h4 class="media-heading" style="color: #9e9e9e;">Left-aligned 
							<div>
								<ul class="product-cmt-ellipsis-v">
									<li class="product-cmt-ellipsis-v-li"><i class="fa fa-ellipsis-v" id="3"></i></li>
									<li class="product-cmt-ellipsis-v-li">
										<ul class="product-cmt-ellipsis-v-sub" id="31">
											<a href="#"><li>Chỉnh sửa</li></a>
											<a href="#"><li>Xóa</li></a>
										</ul>
									</li>
								</ul>
							</div>
						</h4>
						<label style="font-size: 10px; color: #9e9e9e;">4 giờ trước</label>
						<p style="width: 800px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
				</div>
				<div class="form-group">
					<label for="usr">Name:</label>
					<input type="text" class="form-control" id="usr" style="width: 800px;
					height: 40px; ">
					<button type="button" class="btn btn-primary" style="margin-top: 10px;
					float: right; margin-right: 300px;">Bình luận</button>
				</div>
				<ul class="pagination">
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
				</ul>
			</div>
		</div>
		<!----------Phần quảng cáo----------->
		<div id="introduce-ads">
			<ul>
				<li class="introduce-ads-li-title">Quảng cáo sản phẩm</li>
				<?php 
				$query="SELECT * FROM tblsanpham ORDER BY ordernum";
				$results=mysqli_query($dbc,$query);
				$numqc=mysqli_num_rows($results);
				if($numqc>5) $qc=5;else $qc=$numqc;
				for($i=1;$i<=$qc;$i++){
					$d=mysqli_fetch_array($results);
					?>
					<a href="beginproduct.php?id=<?php echo $d['idsp']; ?>"><li class="introduce-ads-li">
						<img src="<?php echo $d['anh'] ?>" class="introduce-ads-li-img">
						<p class="introduce-ads-p"><?php echo $d['tensp'] ?></p>
						<p class="introduce-ads-p" style="color: red;"><?php echo number_format($d['giasp']); ?></p>
					</li>
				</a>
			<?php }  ?>
		</ul>
	</div>
</div>
</div>
<?php } ?>
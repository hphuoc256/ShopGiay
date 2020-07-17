<?php 
session_start();
include('../inc/myconnect.php');
/*-------------------------- GET----------------------------*/
?>
<?php 
/*======================Thêm tin mới trên trang chủ====================*/
if(isset($_GET['id']) && isset($_GET['xemthem'])){
	$sl=$_GET['id'];
	$query="SELECT * FROM tblbaiviet WHERE status=1 ORDER BY ordernum LIMIT $sl , 6";
	$results=mysqli_query($dbc,$query) or die("Bị lỗi truy vấn sever");
	$num=mysqli_num_rows($results);
	if($num==0) echo "<script> alert('Đã hết tin tức mới nhất');</script>";
	else{
		?>
		<div class="home-main-smail">
			<ul>
				<?php
				for($i=1;$i<=$num;$i++){
					$d=mysqli_fetch_array($results);
					?>
					<li>
						<a href="chitietbaiviet.php?id=<?php echo $d['id']; ?>">
							<p><?php echo $d['title'] ?></p>
							<img src="<?php echo $d['anh'] ?>" class="home-main-img" />
							<br>
							<span><?php echo $d['tomtat'] ?></span>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	<?php }
}
?>
<?php 
/*==================================Kiểm tra tỉnh/tp========================*/
if(isset($_GET['provinceid'])){
	$provinceid=$_GET['provinceid'];
	?>
	<select class="product-form" name="district">
		<?php 
		$query="SELECT * FROM district WHERE provinceid='$provinceid'";
		$results=mysqli_query($dbc,$query) or die("bị lỗi");
		while ($d=mysqli_fetch_array($results)){
			?>
			<option value="<?php echo $d['districtid']; ?>"><?php echo $d['name']; ?></option>
		<?php } ?>
	</select>
<?php } ?>
<?php 
/*==============================Kiểm tra username==========================*/
if(isset($_GET['usernametest'])){
	$usernametest=$_GET['usernametest'];
	$query="SELECT * FROM tblusers WHERE username='$usernametest'";
	$results=mysqli_query($dbc,$query);
	$num=mysqli_num_rows($results);
	echo $num;
}
/*==============================Kiểm tra password==========================*/
if(isset($_POST['passwordtest'])&&isset($_POST['password_againtest'])){
	$passwordtest=$_POST['passwordtest'];
	$password_againtest=$_POST['password_againtest'];
	if($passwordtest==$password_againtest) echo 1;
	else echo 0;
}
/*==============================Đăng ký tài khoản user==========================*/
if(isset($_POST['submit_signup'])){
	$username=$_POST['username'];
	$query="SELECT * FROM tblusers WHERE username='$username'";
	$results=mysqli_query($dbc,$query);
	$num=mysqli_num_rows($results);
	if($num==0){
		$password=$_POST['password'];
		$password_again=$_POST['password_again']; 
		if($password_again==$password){
			$hoten=$_POST['hoten'];
			$email=$_POST['email'];
			$sdt=$_POST['sdt'];
			$provinceid=$_POST['province'];
			$districtid=$_POST['district'];
			$diachi=$_POST['diachi'];
			$gioitinh=$_POST['gioitinh'];
			$ngaysinh=$_POST['ngaysinh'];
			$ngaydk=date('Y:m:d');
			$query="INSERT INTO tblusers(username,password,hoten,email,ngaydk,ngaysinh,diachi,districtid,provinceid,gioitinh,sdt) VALUES('{$username}','{$password}','{$hoten}','{$email}','{$ngaydk}','{$ngaysinh}','{$diachi}','{$districtid}','{$provinceid}',$gioitinh,'{$sdt}')";
			$results=mysqli_query($dbc,$query)or die("bị lỗi kết nối");
			if(mysqli_affected_rows($dbc)==1){
				$_SESSION['usernames']=$username;
				$_SESSION['hoten']=$hoten;
				$_SESSION['iduser']=$id;
				echo " <script>
				alert('Đăng ký thành công');
				location.href = 'homemain.php';
				</script>";
			}
			else echo " <script>
			alert('Đăng ký bị lỗi');
			window.history.back();
			</script>";	 
		}
		else{
			echo "<script>
			alert('Nhập lại mật khẩu không đúng');
			window.history.back();
			</script>";
		};
	}
	else{
		echo "<script>
		alert('Tài khoản đã tồn tại');
		window.history.back();
		</script>";
	};
}
/*==============================Đăng nhập users==========================*/
if(isset($_POST['submit_dangnhap'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query="SELECT * FROM tblusers WHERE username='$username' AND password='$password'";
	$results=mysqli_query($dbc,$query) or die("bị lỗi kết nối sever");
	$num=mysqli_num_rows($results);
	if($num==1){
		$d=mysqli_fetch_array($results);
		$username=$d['username'];
		$hoten=$d['hoten'];
		$id=$d['id'];
		$_SESSION['iduser']=$id;
		$_SESSION['usernames']=$username;
		$_SESSION['hoten']=$hoten;
		echo " <script>
		window.history.back();
		</script>";	
	}
	else{
		echo " <script>
		alert('Tài khoản hoặc mật khẩu bị sai. Xin nhập lại');
		window.history.back();
		</script>";	

	}
}
/*===========đăng xuất==============*/
if(isset($_GET['logout'])){
	session_destroy();
	header('location:homemain.php');
}
/*==============================Add giỏ hàng==========================*/
if(isset($_GET['add_muangay'])){
	$iduser=$_SESSION['iduser'];
	$idsp=$_GET['idsp'];
	$size=$_GET['size_option'];
	$soluong=$_GET['soluong'];
	$color=$_GET['color'];
	$queryold="SELECT * FROM tblgiohang WHERE iduser=$iduser AND idsp=$idsp AND status=0 AND idmau=$color";
	$resultsold=mysqli_query($dbc,$queryold);
	$num=mysqli_num_rows($resultsold);
	$query="SELECT * FROM tblsanpham WHERE idsp=$idsp";
	$results=mysqli_query($dbc,$query);
	$d=mysqli_fetch_array($results);
	$giasp=$d['giasp'];
	if($num==1){
		$dold=mysqli_fetch_array($resultsold);
		$idgiohang=$dold['id'];
		$soluongold=$dold['soluong'];
		$soluongup=$soluong+$soluongold;
		$thanhtienup=$soluongup*$giasp;
		$queryup="UPDATE tblgiohang SET soluong=$soluongup, thanhtien=$thanhtienup WHERE id=$idgiohang ";
		$resultsup=mysqli_query($dbc,$queryup)or die(" <script>
			alert('Thêm vào giỏ hàng bị lỗi');
			window.history.back();
			</script>");
		echo " <script>
		alert('Đã thêm vào giỏ hàng');
		location.href='cartmain.php';
		</script>";
	}else{
		$thanhtien=$soluong*$giasp;
		$query1="INSERT INTO tblgiohang(iduser,idsp,idmau,size,soluong,thanhtien,status) VALUES($iduser,$idsp,$color,'{$size}',$soluong,$thanhtien,0)";
		$results1=mysqli_query($dbc,$query1) or die("Kết nối bị lỗi đm");
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Đã thêm vào giỏ hàng');
			location.href='cartmain.php';
			</script>";
		}
		else echo " <script>
		alert('Thêm vào giỏ hàng bị lỗi');
		window.history.back();
		</script>";	 
	}
}
if(isset($_GET['add_giohang'])){
	$iduser=$_SESSION['iduser'];
	$idsp=$_GET['idsp'];
	$size=$_GET['size_option'];
	$soluong=$_GET['soluong'];
	$color=$_GET['color'];
	$queryold="SELECT * FROM tblgiohang WHERE iduser=$iduser AND idsp=$idsp AND status=0 AND idmau=$color";
	$resultsold=mysqli_query($dbc,$queryold);
	$num=mysqli_num_rows($resultsold);
	$query="SELECT * FROM tblsanpham WHERE idsp=$idsp";
	$results=mysqli_query($dbc,$query);
	$d=mysqli_fetch_array($results);
	$giasp=$d['giasp'];
	if($num==1){
		$dold=mysqli_fetch_array($resultsold);
		$idgiohang=$dold['id'];
		$soluongold=$dold['soluong'];
		$soluongup=$soluong+$soluongold;
		$thanhtienup=$soluongup*$giasp;
		$queryup="UPDATE tblgiohang SET soluong=$soluongup, thanhtien=$thanhtienup WHERE id=$idgiohang ";
		$resultsup=mysqli_query($dbc,$queryup)or die(" <script>
			alert('Thêm vào giỏ hàng bị lỗi');
			</script>");
		echo " <script>
		alert('Đã thêm vào giỏ hàng');
		</script>";
	}else{
		$thanhtien=$soluong*$giasp;
		$query1="INSERT INTO tblgiohang(iduser,idsp,idmau,size,soluong,thanhtien,status) VALUES($iduser,$idsp,$color,'{$size}',$soluong,$thanhtien,0)";
		$results1=mysqli_query($dbc,$query1) or die("Kết nối bị lỗi đm");
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Đã thêm vào giỏ hàng');
			</script>";
		}
		else echo " <script>
		alert('Thêm vào giỏ hàng bị lỗi');
		</script>";	 
	}
}
/*==============================Xóa giỏ hàng==========================*/
if(isset($_GET['xoasp_cart'])){
	$id=$_GET['id'];
	$query="DELETE FROM tblgiohang WHERE id=$id";
	$results=mysqli_query($dbc,$query);
	header('location:cartmain.php');
}
/*==============================Thanh toán==========================*/
if(isset($_POST['cart_thanhtoan_submit'])){
	$iduser=$_SESSION['iduser'];
	$hoten=$_POST['hoten'];
	$diachi=$_POST['diachi'];
	$sdt=$_POST['sdt'];
	$email=$_POST['email'];
	$ngaydat=date('Y-m-d');
	$ngaygiao = strtotime(date("Y-m-d", strtotime($ngaydat)) . " +6 day");
	$ngaygiao = strftime("%Y-%m-%d", $ngaygiao);
	$query="SELECT * FROM tblgiohang WHERE iduser=$iduser AND status=0";
	$results=mysqli_query($dbc,$query);
	$tongtien=0;
	while ($d=mysqli_fetch_array($results)) {
		$tongtien += $d['thanhtien'];
	}
	$query="INSERT INTO tbldonhang(iduser,hoten,diachi,sdt,email,ngaydat,ngaygiao,tongtien,status) VALUES($iduser,'{$hoten}','{$diachi}','{$sdt}','{$email}','{$ngaydat}','{$ngaygiao}',$tongtien,1)";
	$results=mysqli_query($dbc,$query) or die("kết nối bị lỗi");
	/*-----lấy id đơn hàng--------*/
	$query="SELECT * FROM tbldonhang WHERE iduser=$iduser ORDER BY id DESC";
	$results=mysqli_query($dbc,$query);
	$d=mysqli_fetch_array($results);
	$iddonhang=$d['id'];
	/*------đưa sản phẩm giỏ hàng vào đơn hàng------------*/
	$query="UPDATE tblgiohang SET iddonhang=$iddonhang, status=1 WHERE iduser=$iduser AND status=0";
	$results=mysqli_query($dbc,$query);
	if(mysqli_affected_rows($dbc)==1){
		echo " <script>
		alert('Đã tạo đơn hàng');
		location.href='quanlydonhang.php'
		</script>";
	}
}
?>


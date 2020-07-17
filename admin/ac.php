<?php 
//include('includeadmin/ktsession.php');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<form method="GET">
	<?php  
	include('../inc/myconnect.php');
	/*================video==================*/
	if (isset($_GET['submit-video'])) {
		$title=$_GET['title'];
		$link=$_GET['link'];
		$ordernum=$_GET['ordernum'];
		$status=$_GET['status'];
		$query="INSERT INTO tblvideo(title,link,ordernum,status) VALUES('{$title}','{$link}',$ordernum,$status)";
		$results=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Thêm mới thành công');
			location.href = 'addVideo.php';
			</script>";
		}
		else echo " <script>
		alert('Thêm mới không thành công');
		location.href = 'addVideo.php';
		</script>";	
	}
	if(isset($_GET['videoxoa'])&&isset($_GET['id'])){
		$ma=$_GET['id'];
		$query="DELETE FROM tblvideo WHERE id='$ma'";
		$results=mysqli_query($dbc,$query) or die('Xóa dữ liệu thất bại');
		header('location:dsVideo.php');
	}
	if (isset($_GET['submit-video-sua'])&&isset($_GET['id'])){
		$id=$_GET['id'];
		$title=$_GET['title'];
		$link=$_GET['link'];
		$ordernum=$_GET['ordernum'];
		$status=$_GET['status'];
		$query="UPDATE tblvideo SET title='$title',link='$link',ordernum=$ordernum,status=$status WHERE id=$id";
		$results=mysqli_query($dbc,$query) or die('Không thể cập nhật');
		if(mysqli_query($dbc,$query)){
			echo " <script>
			alert('Cập nhật thành công');
			location.href = 'dsVideo.php';
			</script>";	
		}
		//header('location:dsVideo.php');
	}
	/*================ baiviet ==================*/

	if(isset($_GET['baivietxoa'])&&isset($_GET['id'])){
		$ma=$_GET['id'];
		$query="DELETE FROM tblbaiviet WHERE id='$ma'";
		$results=mysqli_query($dbc,$query) or die('Xóa dữ liệu thất bại');
		header('location:dsbaiviet.php');
	}
	/*================ slide ==================*/

	if(isset($_GET['slidexoa'])&&isset($_GET['id'])){
		$ma=$_GET['id'];
		$query="DELETE FROM tblslider WHERE id='$ma'";
		$results=mysqli_query($dbc,$query) or die('Xóa dữ liệu thất bại');
		header('location:addslider.php');
	}

	/*================ product xóa ==================*/
	if(isset($_GET['productxoa'])&&isset($_GET['id'])){
		$ma=$_GET['id'];
		$query="DELETE FROM tblsanpham WHERE idsp='$ma'";
		$results=mysqli_query($dbc,$query) or die('Xóa dữ liệu thất bại');
		header('location:dsproduct.php');
	}
	/*================ Xóa loại sản phẩm ==================*/
	if(isset($_GET['loaispxoa'])&&isset($_GET['id'])){
		$ma=$_GET['id'];
		$query="DELETE FROM loaisp WHERE idL='$ma'";
		$results=mysqli_query($dbc,$query) or die('Xóa dữ liệu thất bại');
		header('location:addloaisp.php');
	}
	/* -------------------Loại sản phẩm---------------------------------*/
	if(isset($_GET['slidexoa'])&&isset($_GET['id'])){
		$ma=$_GET['id'];
		$query="DELETE FROM tblslider WHERE id='$ma'";
		$results=mysqli_query($dbc,$query) or die('Xóa dữ liệu thất bại');
		header('location:addslider.php');
	}
	/*================ Đăng xuất ==================*/
	if(isset($_GET['logout'])){
		session_destroy();
		header('location:admin.php');
	}
	?>
</form>
<?php /*================================== Phuong thuc POST ========================================*/ ?>
<form method="post" enctype="multipart/form-data">
	<?php 
	include('../inc/myconnect.php');
	/*================ Product ==================*/
/*-------------------thêm mới ==================*/
	if(isset($_POST['submit-product'])){
		$title=$_POST['title'];
		$loaisp=$_POST['loai'];
		$giasp=$_POST['dongia'];
		$giagoc=$_POST['giagoc'];
		$size=$_POST['size']; 
		$soluong=$_POST['soluong']; 
		$noidung=$_POST['noidung']; 
		$ngaydang=date('Y:m:d');
		$ordernum=$_POST['ordernum']; 
		$gioitinh=$_POST['gioitinh']; 
		$status=$_POST['status'];
		$img=$_FILES['anh']['name'];
		$anh='../upload/product/'.$img;
		move_uploaded_file($_FILES['anh']['tmp_name'],"../upload/product/".$img);
		$query="INSERT INTO tblsanpham(tensp,idL,giasp,giagoc,gioitinh,size,soluong,noidung,ordernum,status,anh,ngaydang) VALUES('{$title}',$loaisp,$giasp,$giagoc,$gioitinh,'{$size}',$soluong,'{$noidung}',$ordernum,$status,'{$anh}','{$ngaydang}')";
		$results=mysqli_query($dbc,$query) or die("Thêm mới bị lỗi!");
		$query="SELECT * FROM tblsanpham ORDER BY idsp DESC LIMIT 0,1";
		$results=mysqli_query($dbc,$query);
		$d=mysqli_fetch_array($results);
		$id=$d['idsp']; echo $id;
		for($i=1;$i<=10;$i++){
			$a='mau'.$i;
			if(isset($_POST[$a])){
				$n=$i;
			}
		}
		for($j=1;$j<=$n;$j++){
			$b='mau'.$j;
			$tenmau=$_POST[$b];
			$l='link'.$j;
			$img=$_FILES[$l]['name'];
			$anh='../upload/product/'.$img;
			move_uploaded_file($_FILES[$l]['tmp_name'],"../upload/product/".$img);
			$query="INSERT INTO tblsanpham_mau(idsp,tenmau,anh) VALUES ($id,'{$tenmau}','{$anh}')";
			$results=mysqli_query($dbc,$query) or die("thêm sản phẩm màu bị lỗi");
		}
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Thêm mới thành công');
			location.href = 'addproduct.php';
			</script>";
		}
		else echo " <script>
		alert('Thêm mới không thành công');
		location.href = 'addproduct.php';
		</script>";	
	}
	
	/*--------------sửa sản phẩm------------*/
	if (isset($_POST['submit-product-sua'])&&isset($_POST['id'])){
		$id=$_POST['id'];
		$title=$_POST['title'];
		$loaisp=$_POST['loai'];
		$giasp=$_POST['dongia'];
		$giagoc=$_POST['giagoc'];
		$size=$_POST['size']; 
		$soluong=$_POST['soluong']; 
		$noidung=$_POST['noidung']; 
		$ngaydang=date('Y:m:d');
		$ordernum=$_POST['ordernum']; 
		$gioitinh=$_POST['gioitinh']; 
		$status=$_POST['status'];
		$query="UPDATE tblsanpham SET tensp='$title',idL=$loaisp, giasp=$giasp, giagoc=$giagoc, gioitinh=$gioitinh, size='$size', soluong=$soluong, noidung='$noidung', ordernum=$ordernum, status=$status, ngaydang='$ngaydang'  WHERE idsp='$id'" ;
		$results=mysqli_query($dbc,$query) or die("Cập nhật bị lỗi!");
		if(isset($_FILES['anh']['name']) && $_FILES['anh']['name'] !=''){
			$img=$_FILES['anh']['name'];
			$anh='../upload/product/'.$img;
			move_uploaded_file($_FILES['anh']['tmp_name'],"../upload/product/".$img);
			$query="UPDATE tblsanpham SET anh='$anh' WHERE idsp='$id'";
			$results=mysqli_query($dbc,$query) or die("cập nhật ảnh đại diện cho sản phẩm bị lỗi");
		}
		for($i=1;$i<=10;$i++){
			$a='mau'.$i;
			$b='id-product-color'.$i;
			if(isset($_POST[$a])){
				$n=$i;
			}
			if(isset($_POST[$b])){
				$id_n=$i;
			}
		}
		$query1="SELECT * FROM tblsanpham_mau WHERE idsp='$id' ORDER BY id";
		$results1=mysqli_query($dbc,$query1);
		$num_id=mysqli_num_rows($results1);
		if($num_id > $id_n){
			for($g=1;$g<=$num_id;$g++){
				$id_val_color="id-product-color".$g;
				$id_pro_color=0;
				if(isset($_POST[$id_val_color])) {
					$id_pro_color=$_POST[$id_val_color];
				}
				$dn=mysqli_fetch_array($results1);
				$id_del=$dn['id'];
				if($id_del!=$id_pro_color){
					$queryn="DELETE FROM tblsanpham_mau WHERE id='$id_del'";
					$kqn=mysqli_query($dbc,$queryn) or die("Bị lỗi xóa sau cập nhật!");
				}
			}
		}
		for($j=1;$j<=$n;$j++){
			$id_val_color="id-product-color".$j;
			$b='mau'.$j;
			$tenmau=$_POST[$b];
			$l='link'.$j;
			$img=$_FILES[$l]['name'];
			$anh='../upload/product/'.$img;
			move_uploaded_file($_FILES[$l]['tmp_name'],"../upload/product/".$img);
			if(isset($_POST[$id_val_color])) {
				$id_pro_color=$_POST[$id_val_color];
				$queryup="UPDATE tblsanpham_mau SET tenmau='$tenmau', anh='$anh' WHERE id='$id_pro_color'";
				$resultsup=mysqli_query($dbc,$queryup) or die("Cập nhật sản phẩm màu bị lỗi");	
			}
			else{
				$query="INSERT INTO tblsanpham_mau(idsp,tenmau,anh) VALUES ($id,'{$tenmau}','{$anh}')";
				$results=mysqli_query($dbc,$query) or die("Cập nhật thêm sản phẩm màu bị lỗi");
			}
		}
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Cập nhật thành công');
			location.href = 'dsproduct.php';
			</script>";
		}
		else echo " <script>
		alert('Cập nhật thành công');
		location.href = 'dsproduct.php';
		</script>";	
	}
	/*--------------thêm loại sp------------*/
	if (isset($_POST['submit_loaisp'])) {
		$title=$_POST['title'];
		$gioitinh=$_POST['gioitinh'];
		$status=$_POST['status'];
		$query="INSERT INTO loaisp(ten,gioitinh,status) VALUES('{$title}',$gioitinh,$status)";
		$results=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Thêm mới thành công');
			location.href = 'addloaisp.php';
			</script>";
		}
		else echo " <script>
		alert('Thêm mới không thành công');
		location.href = 'addloaisp.php';
		</script>";	
	}
	/*--------------sửa loại sp------------*/
	if (isset($_POST['submit_loaisp_sua'])&&isset($_POST['id'])){
		$id=$_POST['id'];
		$title=$_POST['title'];
		$gioitinh=$_POST['gioitinh'];
		$status=$_POST['status'];
		$query="UPDATE loaisp SET ten='$title',gioitinh=$gioitinh,status=$status WHERE idL=$id";
		$results=mysqli_query($dbc,$query) or die("Cập nhật bị lỗi!");
		if(mysqli_query($dbc,$query)){
			echo " <script>
			alert('Cập nhật thành công');
			location.href = 'addloaisp.php';
			</script>";	
		}
	}
	/*================ slide =================================*/
	if (isset($_POST['submit-Slide'])) {
		$title=$_POST['title'];
		$link=$_POST['link'];
		$ordernum=$_POST['ordernum'];
		$status=$_POST['status'];
		$img=$_FILES['anh']['name'];
		$anh='../upload/slide/'.$img;
		move_uploaded_file($_FILES['anh']['tmp_name'],"../upload/slide/".$img);
		$query="INSERT INTO tblslider(title,anh,link,ordernum,status) VALUES('{$title}','{$anh}','{$link}',$ordernum,$status)";
		$results=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Thêm mới thành công');
			location.href = 'addslider.php';
			</script>";
		}
		else echo " <script>
		alert('Thêm mới không thành công');
		location.href = 'addslider.php';
		</script>";	
	}
	if (isset($_POST['submit-slide-sua'])&&isset($_POST['id'])){
		$id=$_POST['id'];
		$title=$_POST['title'];
		$link=$_POST['link'];
		$ordernum=$_POST['ordernum'];
		$status=$_POST['status'];
		$query="UPDATE tblslider SET title='$title',link='$link',ordernum=$ordernum,status=$status WHERE id=$id";
		$results=mysqli_query($dbc,$query) or die("Cập nhật bị lỗi!");
		if(isset($_FILES['anh']['name']) && $_FILES['anh']['name']!=''){
			$img=$_FILES['anh']['name'];
			$anh='../upload/slide/'.$img;
			move_uploaded_file($_FILES['anh']['tmp_name'],"../upload/slide/".$img);
			$query="UPDATE tblslider SET anh='$anh' WHERE id=$id";
			$results=mysqli_query($dbc,$query) or die("Cập nhật bị lỗi!");
		}
		if(mysqli_query($dbc,$query)){
			echo " <script>
			alert('Cập nhật thành công');
			location.href = 'addslider.php';
			</script>";	
		}
	}
	/*================ bài viết ==================*/
	if (isset($_POST['submit_baiviet'])) {
		$title=$_POST['title'];
		$tomtat=$_POST['tomtat'];
		$noidung=$_POST['noidung'];
		$ngaydang=date('d-m-Y');echo $ngaydang;
		$giodang=date('H-i');echo $giodang;
		$ordernum=$_POST['ordernum'];
		$status=$_POST['status'];
		$img=$_FILES['anh']['name'];
		$anh='../upload/baiviet/'.$img;
		move_uploaded_file($_FILES['anh']['tmp_name'],"../upload/baiviet/".$img);
		$query="INSERT INTO tblbaiviet(title,tomtat,noidung,anh,ngaydang,giodang,ordernum,status) VALUES('{$title}','{$tomtat}','{$noidung}','{$anh}','{$ngaydang}','{$giodang}',$ordernum,$status)";
		$results=mysqli_query($dbc,$query) or die("bị lỗi sever!");
		if(mysqli_affected_rows($dbc)==1){
			echo " <script>
			alert('Thêm mới thành công');
			location.href = 'addbaiviet.php';
			</script>";
		}
		else echo " <script>
		alert('Thêm mới không thành công');
		location.href = 'addbaiviet.php';
		</script>";	
	}
	if (isset($_POST['submit_baiviet_sua'])&&isset($_POST['id'])){
		$id=$_POST['id'];
		$title=$_POST['title'];
		$tomtat=$_POST['tomtat'];
		$noidung=$_POST['noidung'];
		$ngaydang=date('d-m-Y');echo $ngaydang;
		$giodang=date('H-i');echo $giodang;
		$ordernum=$_POST['ordernum'];
		$status=$_POST['status'];
		$query="UPDATE tblbaiviet SET title='$title',noidung='$noidung',tomtat='$tomtat',ngaydang='$ngaydang',giodang='$giodang',ordernum=$ordernum,status=$status WHERE id=$id";
		$results=mysqli_query($dbc,$query) or die("Cập nhật bị lỗi!");
		if(isset($_FILES['anh']['name']) && $_FILES['anh']['name']!=''){
			$img=$_FILES['anh']['name'];
			$anh='../upload/baiviet/'.$img;
			move_uploaded_file($_FILES['anh']['tmp_name'],"../upload/baiviet/".$img);
			$query="UPDATE tblbaiviet SET anh='$anh' WHERE id=$id";
			$results=mysqli_query($dbc,$query) or die("Cập nhật bị lỗi!");
		}
		if(mysqli_query($dbc,$query)){
			echo " <script>
			alert('Cập nhật thành công');
			location.href = 'dsbaiviet.php';
			</script>";	
		}
	}
	/*================ Đăng nhập ==================*/
	if(isset($_POST['submit_admin'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$query="SELECT * FROM tbladmin WHERE username='$username' AND password='$password'";
		$results=mysqli_query($dbc,$query) or die("Bị lỗi sever");
		$num=mysqli_num_rows($results);
		if($num==1){
			$d=mysqli_fetch_array($results);
			$id=$d['id'];
			$_SESSION['uid']=$id;
			$_SESSION['username']=$username;
			header('location:admin.php');
		}
		else{
			echo " <script>
			alert('Tài khoản hoặc mật khẩu bị sai. Xin nhập lại');
			location.href = 'admin.php';
			</script>";	
			
		}
	}
	?>

</form>

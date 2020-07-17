 <?php if(isset($_GET['idloai'])){
 	$gioitinh=$_GET['idloai'];
 } ?>
 <select name="loai" class="loaisp_option">
 	<?php 
 	include('../inc/myconnect.php');
 	$query="SELECT * FROM loaisp WHERE gioitinh=$gioitinh||gioitinh =10";
 	$results=mysqli_query($dbc,$query);
 	while ($dloai=mysqli_fetch_array($results)) {
 		?>
 		<option value="<?php echo $dloai['idL'] ?>"><?php echo $dloai['ten']; ?></option>
 	<?php } ?>
 </select>

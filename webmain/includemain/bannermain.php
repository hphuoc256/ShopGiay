<div id="banner">
	<?php 
	include('../inc/myconnect.php');
	$query="SELECT * FROM tblslider WHERE status=1 ORDER BY ordernum";
	$results=mysqli_query($dbc,$query) or die("Bị lỗi sever");
	$num=mysqli_num_rows($results);
	?>
	<input type="text" name="numberslide" value="<?php echo $num; ?>" id="numberslide" class="hide">
	<?php
	for ($i=0; $i <$num ; $i++) { 
		$d=mysqli_fetch_array($results);
		?>
		<a href="<?php echo $d['link']; ?>"><img src="<?php echo $d['anh'] ?>" class="img-banner" <?php if($i!=0) echo "style='display: none;'";  ?>stt="<?php echo $i ?>"/></a>
	<?php } ?>
	<!-- <a href="#" id="prev"><i class="fa fa-angle-left" style="font-size: 70px; color: black;"></i></a>
	<a href="#" id="next"><i class="fa fa-angle-right" style="font-size: 70px; color: black;"></i></a> -->
	<div id="prev" style="width: 40px; cursor: pointer;"><i class="fa fa-angle-left" style="font-size: 70px; color: black;"></i></div>
	<div id="next" style="width: 40px; cursor: pointer;"><i class="fa fa-angle-right" style="font-size: 70px; color: black;"></i></div>
	<ul style="margin: 0px; margin-top: 15px;">
		<?php for ($i=0; $i <$num ; $i++) {  ?>
			<li <?php if($i==0) echo "class='active'" ?>></li>
		<?php } ?>
	</ul>
</div>
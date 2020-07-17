<?php 
include('../inc/myconnect.php');
$query="SELECT * FROM tblbaiviet WHERE status=1 ORDER BY ordernum DESC";
$results=mysqli_query($dbc,$query);
$num=mysqli_num_rows($results);
if($num > 6) $n=6; else $n=$num; echo $n;
?>
<div id="home">
	<div id="home-main">
		<div class="home-main-smail">
			<ul>
				<?php for($i=1;$i<=$n;$i++){
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
	</div>
	<div style="clear: both;"></div>
	<div class="submit-home"><input type="button" name="them" value="Xem thêm tin tức" class="button_xemthem"></div>
</div>
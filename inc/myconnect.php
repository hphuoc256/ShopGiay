<?php 
	$dbc=@mysqli_connect('localhost','root','','webshop') or die('không thể kết nối với sever');
	mysqli_query($dbc,"SET NAMES 'utf8'");
?>
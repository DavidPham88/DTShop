<?php
	require_once("../lib/db.php");
	
	$email = $_POST['email'];
	
	//Kiem tra email co trong he thong khong
	$sql = "SELECT `id`,`name` FROM `dt_user` WHERE `email`='{$email}'";
	$rs = mysqli_query($link,$sql);
	
	if(mysqli_num_rows($rs) > 0)//Email co trong he thong
		echo '<img src="img/logo/deny.png"> Email này đã tồn tại';
	else
		echo '<img src="img/logo/accept.png"> Bạn có thể sử dụng email này';
?>

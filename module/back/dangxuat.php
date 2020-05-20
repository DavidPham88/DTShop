<?php
	//Huy cac session da duoc tao trong login
	unset($_SESSION['admin_id']);
	unset($_SESSION['admin_name']);
	
	//Chuyen den trang dang nhap
	header("location:?mod=dangnhap");	
?>
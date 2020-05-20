<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}

	$id=$_GET['id'];
	
	$sql="DELETE FROM `dt_category` WHERE `id`={$id}";
	mysqli_query($link,$sql);
	
	header("location:?mod=cate");
?>
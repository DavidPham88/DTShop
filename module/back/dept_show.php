<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}
	
	$id=$_GET['id'];
	
	$sql="update `dt_department` set `active`=0 where `id`={$id}";
	mysqli_query($link,$sql);
	
	header("location:?mod=dept");
?>
<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}

	$id=$_GET['id'];
	
	$sql="update `dt_product` set `active`=1 where `id`={$id}";
	mysqli_query($link,$sql);
	
	header("location:?mod=product");
?>
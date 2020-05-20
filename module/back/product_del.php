<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}

	$id=$_GET['id'];
		
	$sql="select `category_id`, `img_url` from `dt_product` where `id`={$id}";
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	
	//Xóa hình 
	if(is_file("img/sp/{$r['img_url']}.jpg"))
	{
		unlink("img/sp/{$r['img_url']}.jpg");	
	}
	
	//Xóa trong CSDL
	$sql="delete from `dt_product` where `id`={$id}";
	mysqli_query($link,$sql);	
	
	//Chuyển Trang
	header("location:?mod=product&cid={$r['category_id']}");
	
?>
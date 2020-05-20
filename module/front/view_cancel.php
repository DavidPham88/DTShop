<?php
	if(! isset($_SESSION['id']))
	{
		header("location:?mod=dangnhap");
	}
	
	//Lấy ID đơn hàng
	$id=$_GET['id'];
	
	//Lấy thông tin người dùng
	$userID=$_SESSION['id'];
	
	$sql="select * from `dt_order` where `id`={$id}";
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	
	if($r['user_id'] != $userID || $r['status'] !=0)
	{
		echo 'Yêu cầu không được thực thi';
	}
	else
	{
		//Cập nhật trạng thái thành hủy
		$sql="update `dt_order` set `status`=-1 where `id`={$id}";
		mysqli_query($link,$sql);
		
		//Chuyển trang
		header("location:?mod=account");
	}
	
?>
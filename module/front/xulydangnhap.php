<?php
	$user=$_POST['user'];
	
	//Mã hóa MK
	$pass=hash('sha512',$_POST['pass']);
	
	//Kiem tra bang cach truy van vao DB
	$sql="select * from `dt_user` where `email`='{$user}' and `password`='{$pass}' and `active`=1";
	$rs=mysqli_query($link,$sql);
	
	if(mysqli_num_rows($rs))
	{
		$kq=mysqli_fetch_assoc($rs);
		$_SESSION['id']=$kq['id'];
		$_SESSION['name']=$kq['name'];
		
		header("location:?mod=home");
	}
	else
	{
		//Tạo Session lưu tạm (hiện lại) email sau khi nhập sai
		$_SESSION['email']=$user;
		
		$message = "Sai TK hoặc MK";
		echo "<script> alert('$message'); </script>";
		echo "<script> window.location='?mod=dangnhap'; </script>";		
		
	}
?>
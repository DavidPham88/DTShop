<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}
?>

<div style="margin-top:120px; padding-bottom:120px">

<h3 style="text-align:center; color:#C06; font-weight:bold; text-transform:uppercase">*** Chào Mừng <u><?=$_SESSION['admin_name']?></u> Đến Với Trang Quản Lý ***</h3><br>

<h4 style="text-align:center; text-transform:uppercase">Bạn Đã Có Thể Sử Dụng Các Chức Năng Của Admin Để Quản Lý Website</h4><br>

<p style="text-align:center; font-size:18px; color:#006; text-transform:uppercase">Hãy quản lý website của bạn thật tốt và đúng đắn nhé !</p><br>

<p style="text-align:center; color:#060; font-size:18px; text-transform:uppercase"><u>Chúc Bạn Có 1 Ngày Tốt Lành !</u>&nbsp; 
	<i class="fa fa-handshake-o" style="font-size:22px"></i></p>
    
</div>
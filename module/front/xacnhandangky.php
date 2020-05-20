<?php	
		$sql= "UPDATE `dt_user` SET `active`=1 WHERE `id`={$_SESSION['id_dangky']}";
		mysqli_query($link,$sql);
		unset($_SESSION['id_dangky']);
?>
	<script>
		alert("Chúc Mừng Bạn Đã Đăng Ký Thành Công!");
		window.location="?mod=dangnhap";
    </script>
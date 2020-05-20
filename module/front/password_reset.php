<?php
	$msg ='';
	
	$email=addslashes($_GET['email']);
	$email=filter_var($email,FILTER_SANITIZE_EMAIL);
	$hash=@$_GET['hash'];
	
	if($hash == hash('sha512',$email.'duy'))
	{
		if(isset($_POST['pass']))
		{
			$pass = $_POST['pass'];
			$repass = $_POST['repass'];
			if(strlen($pass) < 6)
				$msg = 'Mật khẩu tối thiểu 6 ký tự';
			elseif($pass != $repass)
				$msg = 'Mật khẩu nhập lại không đúng';
			else//Hợp lệ => update trong DB
			{
				$pass=hash('sha512',$pass);
				$sql = "update `dt_user` set `password`='{$pass}' where `email`='{$email}'";
				mysqli_query($link, $sql);
				$msg = 'Cập nhật mật khẩu thành công';
			}
		}
?>
	<h2 style="margin-top:80px">Cập Nhật Mật Khẩu Mới</h2>
	<div style="margin-bottom:70px">
		<form action="" method="post" style="margin-top:20px">
		  <p style="font-size:20px; font-weight:bold; color:#F00"><?=$msg?></p>
			<ul style="list-style:none">
				<li>Nhập mật khẩu mới*</li>
				<li><input type="password" name="pass" required placeholder="Tối thiểu 6 ký tự" ></li>
			</ul>
			<ul style="list-style:none">
				<li>Nhập lại mật khẩu mới*</li>
				<li><input type="password" name="repass" id="repass" required ></li>
			</ul>
			<ul style="list-style:none">
				<li>
				<button type="submit" class="btn btn-danger">Cập Nhật</button>
				</li>
			</ul>
		</form>
	</div>
    
<?php
	}
	else
	{
		echo 'Link không hợp lệ !';
	}
?>
    

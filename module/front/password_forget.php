<?php

	$msg='';
	if(isset($_POST['email']))
	{
		$email=$_POST['email'];
		
		//Kiem tra email co trong he thong khong
		$sql="SELECT * FROM `dt_user` WHERE `email` = '{$email}'";
		$rs=mysqli_query($link,$sql);
		
		if(mysqli_num_rows($rs)>0)//Email co trong he thong
		{
			//Lấy thông tin người dùng
			$r=mysqli_fetch_assoc($rs);
			
			//include thu vien gui mail
			include_once('lib/function.php');
			
			$from = 'info@DTshop.com';
			$to = $email;
			$subject = 'DTshop - Khởi Tạo Mới Mật Khẩu Của Bạn';
			
			//Tao gia tri hash (chong gia mao)
			$hash=hash("sha512",$email.'duy');
			
			//Tạo link
			$link = "http://localhost:8888/ProjectDTshop/?mod=password_reset&email={$email}&hash={$hash}";
			
			$content = 'Xin chào <b>'.$r['name'].'</b><br>
			Nếu bạn muốn đặt lại mật khẩu thì click <a href="'.$link.'">vào đây</a>';
			
			//Gui mail
			if(mailer($from, $to, $subject, $content))
				$msg = 'Link đặt lại mật khẩu mới đã được gửi đến email của bạn !';
			else
				$msg = 'Lỗi. Bạn hãy liên hệ với Admin !';
		}
		else
			$msg = 'Email không có trong hệ thống !';
	}
?>

<div class="container" style="background:url(img/logo/bg.jpg); margin-top:30px">
<div class="row">
	
    <div class="col-md-7 col-sm-12 col-xs-12">
            	
    <form action="" method="post" id="login" style="margin-top:100px; margin-bottom:100px">
    <h3 style="color:#900; font-weight:bold">Tìm mật khẩu</h3>
    <div style="color:#F00; font-size:20px;"><?=$msg?></div>
    
      <ul style="list-style:none; margin-top:20px">
          <li>Nhập Email*</li>
          <li class="inputfield"><input type="text" name="email" value="" ></li>
      </ul>
        <ul style="list-style:none">
            <li>
            <button type="submit" class="btn btn-danger">Gửi</button>
            </li>
        </ul>
    </form>

    </div>
    
</div>
</div>    
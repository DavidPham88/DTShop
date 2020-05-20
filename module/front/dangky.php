<?php
	if(isset($_POST['user']))
	{
		$user=$_POST['user'];
		$name=$_POST['name'];
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];
		$mobile=$_POST['mobile'];
		$captcha=$_POST['captcha'];
		
		//Kiem tra CAPTCHA
		if($captcha != $_SESSION['captcha'])
		{
?>
			<script>
				alert("Mã xác nhận chưa chính xác");
			</script>
<?php                        
		}
		//Kiem Tra Email
		elseif(filter_var($user,FILTER_VALIDATE_EMAIL)===false)
		{
?>		
			<script>
				alert("Email không hợp lệ");
			</script>
<?php            
		}
		//Kiem Tra Pass
		elseif(strlen($pass)<6)
		{
?>			
			<script>
				alert("Mật khẩu tối thiểu 6 ký tự");
			</script>
<?php
		}
		//Kiem Tra Nhap lai pass
		elseif($pass!=$repass)
		{
?>			
			<script>
				alert("Mật khẩu nhập lại chưa đúng");
			</script>			
<?php            
		}
		else //Du lieu hop le => insert vao DB
		{
			//Mã Hóa password
			$pass = hash('sha512',$pass);
			
			$sql="insert into `dt_user` (`email`,`password`,`name`,`mobile`,`active`) values ('$user','$pass','$name','$mobile','0')";
			$rs=mysqli_query($link,$sql);
			
			//Lay id (Auto Increment) cua lenh insert truoc
			$orderID=mysqli_insert_id($link);
			$_SESSION['id_dangky']=$orderID;
			
			if($rs==false)
			{
				$mes= 'Đăng ký không thành công, Email đã tồn tại';
			}
			else
			{
				//Kiem tra email co trong he thong khong
				$sql_mail="SELECT * FROM `dt_user` WHERE `id` = '{$orderID}' and `active`=0";
				$rs_mail=mysqli_query($link,$sql_mail);
				
				if(mysqli_num_rows($rs_mail)>0)//Email co trong he thong
				{
					//Lấy thông tin người dùng
					$r_mail=mysqli_fetch_assoc($rs_mail);
					
					//include thu vien gui mail
					include_once('lib/function.php');
					
					$from = 'info@DTshop.com';
					$to = $r_mail['email'];
					$subject = 'DTshop - Về Việc Đăng Ký Tài Khoản';
					
					//Tao gia tri hash (chong gia mao)
					$hash=hash("sha512",$to.'duy');
					
					//Tạo link
					$link = "http://localhost:8888/ProjectDTshop2/?mod=xulydangky&email={$to}&hash={$hash}";
					
					$content = 'Xin chào <b>'.$r_mail['name'].'</b><br>
					Vui lòng click <a href="'.$link.'">vào đây để hoàn thành việc xác nhận đăng ký!</a>';
					
					//Gui mail
					if(mailer($from, $to, $subject, $content))
						$msg = 'Vui lòng vào Gmail vừa tạo để hoàn thành việc xác nhận đăng ký!';
					else
						$msg = 'Lỗi. Bạn hãy liên hệ với Admin !';
				}
?>				
				<script>
                    alert("Vui lòng vào Gmail vừa tạo để hoàn thành việc xác nhận đăng ký!");
                </script>					
<?php                
				$_SESSION['email']=$user;
?>
				<script>
                   window.location="?mod=dangnhap";
                </script>	
<?php				
			}
		}
	}
?>

<div class="container" style="background:url(img/logo/bg.jpg)">
<div class="row">
	
    <div class="col-md-5 col-sm-12 col-xs-12">
    	
    	<form action="" method="post" style="margin-bottom:60px">             	   
        <fieldset>
        	<legend><h3 style="text-align:center; font-weight:bold">Đăng Ký Tài Khoản</h3></legend>
            
            <div align="center" style="color:#F00; font-size:18px; font-weight:bold; margin-top:10px;">
				<br>&nbsp;
            </div>
            
            <ul class="form_lh">
            	<li>Họ và Tên*</li>
            	<li><input type="text" name="name" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required
                value="<?php if(isset($name)) echo $name ?>" ></li>
        	</ul><br/>
            <ul class="form_lh">
            	<li>Email*</li>
                <li><input type="email" name="user" id="user" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required
                value="<?php if(isset($user)) echo $user ?>" onblur="Ajax()" > <div id="loi"></div>
                </li>
            </ul><br/>
            <ul class="form_lh">
            	<li>Mật khẩu*</li>
                <li><input type="password" name="pass" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required ></li>	
            </ul><br/>
            <ul class="form_lh">
            	<li>Nhập lại mật khẩu*</li>
                <li><input type="password" name="repass" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required ></li>	
            </ul><br/>
             <ul class="form_lh">
            	<li>Số điện thoại*</li>
                <li><input type="text" name="mobile" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required
                 value="<?php if(isset($mobile)) echo $mobile ?>" ></li>	
            </ul><br/>
            <ul class="form_lh">
            	<li>Mã xác nhận*</li>
                <li><input type="text" name="captcha" class="col-md-6 col-sm-6 col-xs-6" required />&nbsp;
                 	<img id="captcha" src="lib/captcha/image.php" alt="captcha">
                    <a onClick="reset_captcha()"><i class="fa fa-undo" aria-hidden="true"></i></a>
                </li>	
            </ul><br/>
            <ul class="form_lh">
            	<button type="submit" class="btn btn-danger" style="margin-top:10px">Đăng Ký</button>
            </ul>	
        </fieldset>    
        </form>

    </div>
    
</div>
</div>    
	

<!-- OnBlur Dòng nhập Email để kiểm tra đã tồn tại hay chưa -->
<script>
	function Ajax()
	{
		//Kiểm tra Email không được trống 
		if(document.getElementById('user').value=='')
		{			
			document.getElementById('user').focus();
		}
		
		//Nếu có nhập Email thì kiểm tra xem có tồn tại hay chưa
		else
		{
			$.ajax({
				url:'AJAX/ajax.php',
				type:'POST',
				data:{email:$('#user').val()},
			})
			.done(function(data)
			{
				$('#loi').html(data);	
			})
		}
	}
	function reset_captcha()
	{
		document.getElementById("captcha").src="lib/captcha/image.php";
	}
</script>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css">
  <script src="jquery/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
  <script src="jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "jquery/jquery-ui-1.12.1.custom/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
	  
	  //Tùy chỉnh tháng
	  changeMonth:true,
	  monthNamesShort: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
	  
	  //Tùy chỉnh năm
	  changeYear:true,
	  yearRange: "c-100:c",
	  
	  //Date Format
	  dateFormat: "dd-mm-yy",
	  
    });
	
  } );
  </script>
  
  <style>
  	button, input, optgroup, select, textarea{
		color:#000;
	}
  </style>
</head>

<?php
	if(! isset($_SESSION['id']))
	{
		header('location:?mod=dangnhap');
	}
	
	//Lấy thông tin người dùng
	$user_ID=$_SESSION['id'];
	$mes='';
	
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];
		$mobile=$_POST['mobile'];
		$address=$_POST['address'];
		$dob=$_POST['dob'];
		
		//Chuyen format $dob tu dd/mm/yyyy -> yyyy-mm-dd
		$d= substr($dob,0,2);
		$m= substr($dob,3,2);
		$y= substr($dob,6,4);
		
		$dob="{$y}-{$m}-{$d}";
		
		//Kiem tra name
		if($name === '')	
		{
			$mes = 'Họ tên không được để trống';
		}		
		//Kiem Tra Độ Dài của Pass ( nếu có nhập)
		elseif(strlen($pass)>0 && strlen($pass)<6)
		{
			$mes= 'Mật khẩu tối thiểu 6 ký tự';
		}
		//Kiem Tra Nhap lai pass
		elseif($pass!=$repass)
		{
			$mes= 'Nhập lại MK chưa đúng';			
		}
		else //Du lieu hop le => update vao DB
		{
			if($pass!='') // Có update password
			$sql="update `dt_user` set 
						`name`='{$name}',
						`email`='{$email}',
						`password`=sha2('{$pass}',512),
						`dob`='{$dob}',
						`mobile`='{$mobile}',
						`gender`='{$gender}',
						`address`='{$address}'
						where `id`={$user_ID}";
			else
			$sql="update `dt_user` set 
						`name`='{$name}',
						`email`='{$email}',
						`dob`='{$dob}',
						`mobile`='{$mobile}',
						`gender`='{$gender}',
						`address`='{$address}'
						where `id`={$user_ID}";
					
			$rs=mysqli_query($link,$sql);
			if($rs==false)
			{
				$mes = 'Cập nhật không thành công';
			}
			else
			{
				$mes = 'Cập nhật thành công ! Hệ thống sẽ chuyển đến trang chủ sau 3s';		
				$_SESSION['name']=$name;
?>

				<script>	
					setTimeout("window.location='?mod=home';",3000);
				</script>

<?php				
			}
		}
	}
?>


<?php

	$sql="select * from `dt_user` where `id`={$user_ID}";
	$kq=mysqli_query($link,$sql);
	$xuat=mysqli_fetch_assoc($kq);
?>
<div class="container" style="background:url(img/logo/bg.jpg)">
<div class="row">
	
    <div class="col-md-8 col-sm-8 col-xs-12">
    <div id="form_lienhe">
    	<div style="color:#F00; text-align:center"><?=$mes?></div>
    	<form action="" method="post">
        <fieldset>
        	<legend><h3 style="text-align:center; font-weight:bold">CẬP NHẬT TÀI KHOẢN</h3></legend>
            <ul class="form_lh">
            	<li>Họ tên*</li>
            	<li><input type="text" name="name" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required  
                value="<?=$xuat['name']?>"></li>
        	</ul>
            <ul class="form_lh" style="margin-top:40px">
            	Giới tính  &nbsp;&nbsp;
                	  <label>
                	    <input type="radio" name="gender" value="1" id="gender_1"<?php if($xuat['gender']==1) echo 'checked' ?>>
                	    Nam</label>&nbsp;
                	  <label>
                	    <input type="radio" name="gender" value="0" id="gender_0" <?php if($xuat['gender']==0) echo'checked' ?>>
            	   		 Nữ</label>
            </ul> 
            <ul class="form_lh">
           	  <li>Email*</li>
                <li><input type="email" name="email" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required
                value="<?=$xuat['email']?>" ></li>
            </ul>
             <ul class="form_lh">
           	  <li>Mật khẩu</li>
                <li><input type="password" name="pass" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" ></li>
            </ul>
             <ul class="form_lh">
           	  <li>Nhập lại mật khẩu</li>
                <li><input type="password" name="repass" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" ></li>
            </ul>
            <ul class="form_lh">
            	<li>Số điện thoại*</li>
                <li><input type="number" name="mobile" class="col-md-12 col-sm-12 col-xs-12" style="width:100%"
                value="<?=$xuat['mobile']?>" ></li>	
            </ul>
            
             <ul class="form_lh">
            	<li>Ngày tháng năm sinh</li>
                <li><input type="text" name="dob" id="datepicker" readonly
                value="<?=date('d/m/Y',strtotime($xuat['dob']))?>" ></li>	
            </ul>
            
             <ul class="form_lh">
            	<li>Địa chỉ</li>
                <li><textarea name="address" class="col-md-12 col-sm-12 col-xs-12" style="width:100%"><?=$xuat['address']?></textarea></li>	
            </ul>            
            <ul class="form_lh">
            	<button type="submit" class="btn btn-danger" style="margin-top:10px">Gửi</button>
            </ul>	
        </fieldset>    
        </form>
    </div>
    </div>
    
    <!-- Đánh giá -->
     <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top:60px">
                <form action="?mod=danhgia" method="post" id="danh_gia">

                <!--Tieu đề câu hỏi -->
                <?php
					$sql="select `id`,`content` from `dt_question` where `active`=1";
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_assoc($rs);
				?>
                
                <p style="text-align:center; font-weight:bold; font-size:18px; text-decoration:underline">
                	<?=$r['content'];?>
                </p>
                
                <ul class="form_lh" style="margin-top:20px">
                <!--Những đáp án trả lời -->        
                <?php
					$sql="select `id`,`content` from `dt_answer` where `question_id`=1";
					$rs=mysqli_query($link,$sql);
					
					while($r=mysqli_fetch_assoc($rs)) {
				?>        
                	<li><label><input name="answer" type="radio" value="<?=$r['id'] ?>" > <?=$r['content']; ?></li></label> 
                <?php } ?>
                                                  
                </ul>
                <button type="submit" class="btn btn-default" style="margin-top:10px; margin-left:40px">Bình chọn</button>   
                </form> 
        
    </div>
    
</div>
</div>    
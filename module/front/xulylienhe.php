<div style="font-size:36px; margin:65px 0 65px 0; color:#006">


<?php
	if(isset($_POST['email']))
	{
		$email=$_POST['email'];
		$name=$_POST['name'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];
		
		$sql="insert into `dt_contact`(`email`, `name`, `subject`, `content`) values('$email','$name','$subject','$content')";
		$rs=mysqli_query($link,$sql);	
		
		if($rs==false)
		{
			$mes_wrong="Gửi biểu mẫu không thành công. Xin vui lòng kiểm tra lại!";
			echo $mes_wrong;
		}
		else
		{
			$mes="Gửi biểu mẫu thành công. Hệ thống sẽ phản hồi bạn qua email! Bạn sẽ được chuyển về trang chủ sau vài giây nữa."; 
			echo $mes;
?>

		<script>	
					setTimeout("window.location='?mod=home';",8000);
		</script>

<?php							
		}
	}
	
?>

</div>
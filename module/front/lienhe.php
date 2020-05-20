<?php
	if(isset($_POST['nhanxet'])){
		$name=$_POST['name'];
		$mail=$_POST['mail'];
		$problem=$_POST['problem'];
		$comment=$_POST['comment'];
		if(filter_var($mail,FILTER_VALIDATE_EMAIL)===false)
		{
			?>
			<script> alert('Email không hợp lệ!')</script>
			<?php
		}
		elseif(trim($problem)=="")
		{
			?>
			<script> alert('Vui lòng chọn vấn đề cần liên hệ!')</script>
			<?php	
		}
		elseif(trim($comment)=="")
		{
			?>
			<script> alert('Vui lòng Mô Tả thêm về vấn đề liên hệ!')</script>
			<?php
		}
		else
		{
			$sql="insert into `hs_contact` (`name`,`email`,`date_contact`,`problem`,`describe_problem`,`status`) values (N'{$name}','{$mail}',now(),N'{$problem}',N'{$comment}',0)";
			if(mysqli_query($link,$sql))
			{
				?>
				<script> alert('Cảm ơn quý khách đã đóng góp ý kiến!')</script>
				<?php
			}
			else
			{
				echo $sql;
			}
		}
	}
?>


</div>
	<div class="row">
        <div class="dark col-md-12" style="background-image:url(img/Contact/2016-12-26-09-04-hit_contact_us_header.jpg); height:500px; background-position:center; background-size:cover;">
        	<div id="dark">
            	<div class="centered">
                	<p id="cont_font" align="center">Liên hệ với chúng tôi</p>
                    <p id="cont_font1" align="center"><span style="font-size:36px; color:#096;">GOGO</span> Kết Nối Niềm Tin</p>
                </div>
            </div>
        </div>
    </div>


<div class="container">
	<div class="row" style="padding-top:20px">
        	<h2 align="center" style="color:#3F3F3F;">Chúng tôi giúp đỡ được những gì?</h2>
            <div class="col-md-6" style="padding:20px; background-color:#FFF; height:280px; padding-top:40px">
            	<p id="cont_font1" style="color:#3F3F3F;">Nhằm nâng cao giá trị phục vụ cho cộng đồng, nếu như bạn có thắc mắc cần liên hệ, ý kiến cần đóng góp, vui lòng đừng ngần ngại, hãy liên hệ cho chúng tôi. Chúng tôi cam kết sẽ hồi âm trong thời gian sớm nhất.</p>
            </div>
            <div class="col-md-6" style="background-color:#096; padding:20px; height:280px; margin-top:20px;">
            	<div id="cont_font1" style="padding-top:15px">Hãy liên hệ cho chúng tôi nếu:<br/><br/>
                    <p><i class="far fa-clock"></i> Thời gian giải quyết đơn hàng lâu</p>
                    <p><i class="fas fa-user-circle"></i> Thái độ chủ nhà không chuẩn mực</p>
                    <p><i class="far fa-question-circle"></i> Thông tin nhà bị sai/không phù hợp</p>
                    <p><i class="fas fa-lightbulb"></i> Có ý tưởng đóng góp cho GOGO</p>
                </div>
            </div>
    </div>
    <div class="col-md-12" id="blank"></div>
    <div class="row" style="padding-top:60px">
            <div class="col-md-7" style="padding:20px;height:500px;">
            	<p id="cont_font1" style="color:#3F3F3F;">Thông tin liên hệ</p>
                <div class="form-group" id="cont_font_info">
                <form action="" method="post">
                    <label for="name">Họ và Tên:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php if(isset($name)) echo $name ?>">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="mail" id="email" value="<?php if(isset($mail)) echo $mail ?>">
                    <label for="prob">Vấn đề:</label>
                    <input type="text" class="form-control" name="problem" id="prob" value="<?php if(isset($problem)) echo $problem ?>">
                    <label for="comment">Mô tả:</label>
 					<textarea class="form-control" rows="5" name="comment" id="comment"><?php if(isset($comment)) echo $comment ?></textarea><br />
                    <button type="submit" name="nhanxet" class="btn btn-success" style="background-color:#096; color:#FFF;">Gửi nhận xét</button>	
                </form>				
                </div>
            </div>
            <div class="col-md-5" style="height:500px; " >
                <div class="row">
					<div style="background-color:#096; height:48px; border-bottom-right-radius:50px; padding:10px;" id="cont_font_info1">
                    	<p >Liên hệ trực tiếp:</p>
                    </div><br />
                    <div style="color:#3F3F3F" id="cont_font_info2">
                    	<p style="padding-top:15px;"><i class="fas fa-phone"></i> Gọi cho chúng tôi<br />
                        	<span style="font-size:16px; color:#666">(+84) 090-001-002</span></p>
                        <P style="padding-top:15px"><i class="fas fa-envelope"></i> @Email<br /><span style="font-size:16px; color:#666;">gogo@gmail.com</span></P>
                        <P style="padding-top:15px"><i class="fas fa-map-marker"></i> Địa chỉ<br /><span style="font-size:16px; color:#666;">666 Bảy tầng mây trắng, P.Thiên Đường, Q.Cupid, TP.Ngàn Sao</span></P>
                    </div>
                </div>
            </div>
    </div>

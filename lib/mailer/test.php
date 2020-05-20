<?php 
function mailer($from,$to,$subject,$message)
{
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$subject="=?UTF-8?B?".base64_encode($subject)."?=\n";

	require_once('PHPMailerAutoload.php');
	
	$mail             = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	
	//Xu ly bao loi SMTP ERROR: Failed to connect to server
	$mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
    );
		
	//Cac thong so cua mail server
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "mailer.nhatnghe";  // GMAIL username
	$mail->Password   = "ubbillpfpqrdsscw";  // GMAIL App password
	//End of Cac thong so cua mail server
	
	$mail->SetFrom($from,$from);
	
	$mail->AddReplyTo($from,$from);
	
	$mail->Subject    = $subject;	
	$mail->MsgHTML($message);
	$mail->IsHTML(true);
	$mail->AddAddress($to, "");
	
	if(!$mail->Send()) {
	   return false;
	} else {
	   return true;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
  <p>
    <label>Người nhận
      <input type="text" name="to" id="to" />
    </label>
  </p>
  <p>
  <label>Tiêu đề
  <input type="text" name="subject" id="subject" />
</label>
</p>
  <p>
    <label>Nội dung
      <textarea name="content" cols="60" rows="20" id="content"></textarea>
    </label>
  </p>
  <p>
    <label>
      <input type="submit" name="submit" id="submit" value="Gửi thư" />
    </label>
  </p>
</form>
<?php
	if(isset($_POST['submit']))
	{
		$from="info@faceshop.com.vn";
		$to=$_POST['to'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];
		if(mailer($from,$to,$subject,$content))
			echo "Gửi thành công";
		else
			echo "Gửi không thành công";
	}
?>
</body>
</html>
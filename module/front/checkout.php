<style>
	th{
		text-align:center;
	}
</style>

<?php
	if(! isset($_SESSION['id']))
	{
		header("location:?mod=dangnhap");
	}
	
	//Lấy thông tin người dùng
	$userID=$_SESSION['id'];
	$cart=@$_SESSION['cart'];
	if(@count($cart)<=0)
	{
		echo"<div style='font-size:20px; color:red; font-weight:bold; text-align:center; margin-top:200px'>Bạn phải chọn sản phẩm</div>";
		echo"<div style='margin-top:200px'></div>";
	}
	else
	{			
		$mes='';
		if(isset($_POST['name']))
		{
			$name=$_POST['name'];
			$email=$_POST['email'];
			$mobile=$_POST['mobile'];
			$address=$_POST['address'];
			$remark=$_POST['remark'];			
			
			//Insert don hang (order)
			$sql="insert into `dt_order` values('NULL','$userID',now(),'$name','$address',now(),'$email','$mobile','$remark','0')";
			mysqli_query($link,$sql);
			
			//Insert don hang chi tiet (order_detail)
			//Lay id (Auto Increment) cua lenh insert truoc
			$orderID=mysqli_insert_id($link);
			
			$carts=@$_SESSION['cart'];
			foreach($carts as $k => $v)
			{
				//Lay gia san pham
				$sql = 'select `price` from `dt_product` where`id`='.$k;
				$rs = mysqli_query($link,$sql);
				$r = mysqli_fetch_assoc($rs);
				$price = $r['price'];
				
				//Insert
				$sql = "insert into `dt_order_detail` values('$orderID','$k','$v','$price')";
				mysqli_query($link,$sql);
			}
			echo '<script>alert("Đặt hàng thành công");</script>';
			unset($_SESSION['cart']);
?>	
	
			
		
<?php
				//Kiem tra email co trong he thong khong
				$sql_mail="SELECT * FROM `dt_user` WHERE `id` = '{$userID}'";
				$rs_mail=mysqli_query($link,$sql_mail);
				
				if(mysqli_num_rows($rs_mail)>0)//Email co trong he thong
				{
					//Lấy thông tin người dùng
					$r_mail=mysqli_fetch_assoc($rs_mail);
					
					//include thu vien gui mail
					include_once('lib/function.php');
					
					$from = 'info@DTshop.com';
					$to = $r_mail['email'];
					$subject = 'DTshop - Chúc Mừng Bạn Đã Đặt Hàng Thành Công';
					
					//Tao gia tri hash (chong gia mao)
					$hash=hash("sha512",$to.'duy');
					
					//Tạo link
					$link = "http://localhost:8888/ProjectDTshop2/?mod=account&email={$to}&hash={$hash}";
					
					$content = 'Xin chào <b>'.$r_mail['name'].'</b><br>
					Nếu bạn muốn kiểm tra lại đơn hàng thì click <a href="'.$link.'">vào đây</a>';
					
					//Gui mail
					if(mailer($from, $to, $subject, $content))
						$msg = 'Đặt Hàng Thành Công!';
					else
						$msg = 'Lỗi. Bạn hãy liên hệ với Admin !';
				}
?>
			<script>window.location="?mod=account";</script>
<?php            							
		}	
?>



<div class="container">
	<h2 style="color:#C06">Giỏ hàng</h2>
<div class="row">


<form action="" method="post">
<table border="1" class="col-md-12 col-sm-12 col-xs-12" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <th width="42">STT</th>
    <th width="118">Hình</td>
    <th width="220">Tên Sản Phẩm</th>
    <th width="140">Giá Sản Phẩm</td>
    <th width="106">Số Lượng</th>
    <th width="198">Tổng Tiền</th>
  </tr>
  
  <?php
  	$cart=@$_SESSION['cart'];
	$s=0;
	$i=0;
	if(count($cart)>0)foreach($cart as $k => $v)
	{
		$sql="select `img_url`,`name`,`price` from `dt_product` where `id`={$k} ";
		$rs=mysqli_query($link,$sql);
		$r=mysqli_fetch_assoc($rs);
		$s+=$r['price']*$v;
  ?>
  
  <tr style="text-align:center; height:50px">
    <td><?=++$i?></td>
    <td><img src="img/sp/<?=$r['img_url']?>.jpg" alt="" height="45px" width="45px" /></td>
    <td><?=$r['name']?></td>
    <td><?=number_format($r['price'])?><u>đ</u></td>
    <td><input type="number" min="1" value="<?=$v?>" style="width:50%; text-align:center" disabled></td>
    <td><?=number_format($r['price']*$v)?><u>đ</u></td>
  </tr>

<?php } ?>
</table>

</div>

<div class="row" style="margin-top:30px">
	<div class="col-md-4 col-sm-4 col-xs-12"><span style="font-weight:bold; font-size:20px; text-decoration:underline">Tổng thành tiền: <?=number_format($s)?>đ</span></div>                 	
</div>

</form>

</div>


<!-- Remark -->
<?php
	@$sql="select * from `dt_user` where `id`={$userID}";
	$kq=mysqli_query($link,$sql);
	$kq_show=mysqli_fetch_assoc($kq);
?>
<div class="container" style="background:url(img/logo/bg.jpg); margin-top:30px;">
<div class="row">
	
    <div class="col-md-8 col-sm-8 col-xs-12">
    <div id="form_lienhe">
    	<form action="" method="post">
        <fieldset>
        	<legend><h3 style="text-align:center; font-weight:bold">Thông Tin Giao Hàng !</h3></legend>
            <ul class="form_lh">
            	<li>Họ và tên*</li>
            	<li><input type="text" name="name" class="col-md-12 col-sm-12 col-xs-12" style="width:100%"
                value="<?=$kq_show['name']?>" required ></li>
        	</ul>
            <ul class="form_lh">
            	<li>Địa chỉ email*</li>
                <li><input type="email" name="email" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" 
                value="<?=$kq_show['email']?>" required ></li>
            </ul>
            <ul class="form_lh">
            	<li>Số điện thoại</li>
                <li><input type="number" name="mobile" class="col-md-12 col-sm-12 col-xs-12" style="width:100%"
                value="<?=$kq_show['mobile']?>" ></li>	
            </ul>
            <ul class="form_lh">
            	<li>Địa chỉ*</li>
                <li><textarea type="text" name="address" style="width:100%; height:100px" required
                 class="col-md-12 col-sm-12 col-xs-12" ><?=$kq_show['address']?></textarea>
                </li>	
            </ul>
            <ul class="form_lh">
            	<li>Ghi chú*</li>
                <li><textarea type="text" name="remark" style="width:100%; height:100px" required
                 class="col-md-12 col-sm-12 col-xs-12" ></textarea>
                </li>	
            </ul>
            <ul class="form_lh">
            	<button type="submit" class="btn btn-danger" style="margin-top:10px">Gửi</button>
            </ul>	
        </fieldset>    
        </form>
    </div>
    </div>
    
    
</div>
</div>
<?php } ?>
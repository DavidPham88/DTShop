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
	
	$id=$_GET['id'];
?>


<div class="container">
	<h2 style="color:#C06">THÔNG TIN ĐÃ ĐẶT HÀNG</h2>
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
  	$sql="select b.`img_url`, b.`name`,b.`detail`,b.`desc`, a.`price`, a.`qty`
		  from `dt_order_detail` as a, `dt_product` as b
		  where a.`product_id`= b.`id` and `order_id`={$id}";
	$rs=mysqli_query($link,$sql);
	
	$i=0;
	$s=0;
	while($r=mysqli_fetch_assoc($rs)) {
		$s+= $r['price']*$r['qty'];		  
  ?>	
  <tr style="text-align:center; height:50px">
    <td><?=++$i?></td>
    <td><img src="img/sp/<?=$r['img_url']?>.jpg" alt="" height="45px" width="45px" /></td>
    <td><?=$r['name']?></td>
    <td><?=number_format($r['price'])?><u>đ</u></td>
    <td><input type="number" min="1" value="<?=$r['qty']?>" style="width:50%; text-align:center" disabled></td>
    <td><?=number_format($r['price']*$r['qty'])?><u>đ</u></td>
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
	$sql="select * from `dt_order` where `id`={$id}";
	$kq=mysqli_query($link,$sql);
	$kq_show=mysqli_fetch_assoc($kq);
?>
<div class="container" style="background:url(img/logo/bg.jpg); margin-top:30px;">
<div class="row">
	
    <div class="col-md-8 col-sm-8 col-xs-12">
    <div id="form_lienhe">
    	<form>
        <fieldset>
        	<legend><h3 style="text-align:center; font-weight:bold">Thông Tin Giao Hàng !</h3></legend>
            <ul class="form_lh">
            	<li>Họ và tên*</li>
            	<li><input type="text" name="name" class="col-md-12 col-sm-12 col-xs-12" style="width:100%"
                value="<?=$kq_show['name']?>" disabled ></li>
        	</ul>
            <ul class="form_lh">
            	<li>Địa chỉ email*</li>
                <li><input type="email" name="email" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" 
                value="<?=$kq_show['email']?>" disabled ></li>
            </ul>
            <ul class="form_lh">
            	<li>Số điện thoại</li>
                <li><input type="number" name="mobile" class="col-md-12 col-sm-12 col-xs-12" style="width:100%"
                value="<?=$kq_show['mobile']?>" disabled ></li>	
            </ul>
            <ul class="form_lh">
            	<li>Địa chỉ*</li>
                <li><textarea type="text" name="address" style="width:100%; height:100px" disabled
                 class="col-md-12 col-sm-12 col-xs-12" ><?=$kq_show['address']?></textarea>
                </li>	
            </ul>
            <ul class="form_lh">
            	<li>Ghi chú*</li>
                <li><textarea type="text" name="remark" style="width:100%; height:100px" disabled
                 class="col-md-12 col-sm-12 col-xs-12" ><?=$kq_show['remark']?></textarea>
                </li>	
            </ul>
            <ul class="form_lh">
            	<a href="?mod=account"><button type="button" class="btn btn-danger" style="margin-top:10px">Trở lại</button></a>
            </ul>	
        </fieldset>    
        </form>
    </div>
    </div>
    
    
</div>
</div>
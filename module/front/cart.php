<style>
	th{
		text-align:center;
	}
</style>

<div class="container">
	<h2 style="color:#C06">Giỏ hàng</h2>
<div class="row">


<form action="?mod=cart_process&act=2" method="post">
<table border="1" class="col-md-12 col-sm-12 col-xs-12" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <th width="42">Xóa</th>
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
	if(@count($cart)>0) foreach($cart as $k=>$v)
	{
		$sql="select `img_url`,`name`,`price` from `dt_product` where `id`={$k} ";
		$rs=mysqli_query($link,$sql);
		$r=mysqli_fetch_assoc($rs);
		$s+=$r['price']*$v;
  ?>
  
  <tr style="text-align:center; height:50px">
    <td><a href="?mod=cart_process&id=<?=$k?>&act=3" onclick="return confirm('Bạn muốn xóa khỏi giỏ hàng?')">X</a></td>
    <td>
      <a href="?mod=detail&id=<?=$k?>">
    	<img src="img/sp/<?=$r['img_url']?>.jpg" alt="" height="45px" width="45px" />
      </a>  
    </td>
    <td>
      <a href="?mod=detail&id=<?=$k?>" style="text-decoration:none;">
		<?=$r['name']?>
      </a>  
    </td>
    <td><?=number_format($r['price'])?><u>đ</u></td>
    <td><input type="number" min="1" name="<?=$k?>" value="<?=$v?>" style="width:50%; text-align:center"></td>
    <td><?=number_format($r['price']*$v)?><u>đ</u></td>
  </tr>

<?php } ?>
</table>

</div>

<div class="row" style="margin-top:30px">
    	<div class="col-md-2 col-sm-2 col-xs-12"><a href="?mod=home"><button type="button" class="btn btn-info">
        	Tiếp tục xem hàng</button></div></a>
            
    	<?php if(@count($cart)>0){ ?> 
        <div class="col-md-2 col-sm-2 col-xs-12"><button type="submit" class="btn btn-info">
        	Cập nhật giỏ hàng</button></div>       
        <?php } ?>
            
    	<div class="col-md-2 col-sm-2 col-xs-12"><a href="?mod=checkout"><button type="button" class="btn btn-info">
        	Kiểm tra giỏ hàng</button></div></a>
        <div class="col-md-2 col-sm-2 col-xs-12">&nbsp;</div>
        <div class="col-md-4 col-sm-4 col-xs-12"><span style="font-weight:bold; font-size:18px; text-decoration:underline">
        	Tổng thành tiền: <?=number_format($s)?>đ</span></div>                 	
</div>

</form>
	
	<div class="container" style="padding-top:50px">
    <div class="row">	
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="panel panel-danger" style="text-align:center">
      	  <div class="panel-heading"><span style="font-weight:bold; font-size:18px">--- Sản phẩm mua nhiều ---</span></div>      
    	</div>
        
              <?php			  
			  		$sql="select * from `dt_product` where `active`=1 order by `view` desc limit 0,9";
					$rs=mysqli_query($link,$sql);
					while($sp=mysqli_fetch_assoc($rs)) {
			  ?>
            	<div class="khung_sp col-md-4 col-sm-4 col-xs-12">
                    <img src="img/sp/<?=$sp['img_url']?>.jpg"/>
                    <div class="ten_sp"><?=strtoupper($sp['name'])?></div>
                    <div class="gia"><?=number_format($sp['price'])?><span style="color:#F00; text-decoration:underline">đ</span></div>
                    <a href="?mod=detail&id=<?=$sp['id']?>"><div class="xem_chitiet"><marquee>Xem chi tiết</marquee></div></a>  
                </div>
              
              <?php } ?>  
	  </div>
      
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="panel panel-info" style="text-align:center">
      	  <div class="panel-heading"><span style="font-weight:bold; font-size:18px">Video Clip</span></div>      
    	</div>
        
        <video width="100%" controls>
        	<source src="video/Richard Clayderman - Mariage D' Amour.mp4" type="video/mp4" />
            Trình duyệt của bạn không hỗ trợ video
        </video>
        <video width="100%" controls style="margin-top:20px;">
        	<source src="video/George Michael - Careless Whisper (New album release) (Alexandr Misko).mp4" type="video/mp4" />
            Trình duyệt của bạn không hỗ trợ video
        </video>
        <video width="100%" controls style="margin-top:20px;">
        	<source src="video/Paul Mauriat - Toccata (cover Evgeny Ritman).mp4" type="video/mp4" />
            Trình duyệt của bạn không hỗ trợ video
        </video>
      </div>  
      
    </div>
	</div>

</div>
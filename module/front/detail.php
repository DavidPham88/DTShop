<?php
if(isset($_GET['id']))
{
	$id=$_GET['id'];
}
	
	//Tăng số lượt view
	$sql_view="update `dt_product` set `view`=`view`+1 where `id`={$id}";
	mysqli_query($link,$sql_view);
	

	$sql="select * from `dt_product` where `id`={$id} and `active`=1";
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);

?>
<style>
	.cont{
		font-size:17px;
	}
	.drift-demo-trigger:hover{
		cursor:zoom-in;
	}
	.zoom:after {
			content:'';
			display:block; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			left:0;
			background:url(zoom/drift-master/icon.png);
		}
</style>

<div class="container">           
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>
        
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                <img src="img/logo/slid1.jpg" alt="Los Angeles" style="width:100%;">
                      <div class="carousel-caption">
                        <h4>Guitar Classic</h4>
                        <p>Công cụ vẽ nên âm nhạc!</p>
                      </div>   
              </div>
        
              <div class="item">
                <img src="img/logo/slid2.jpg" alt="Chicago" style="width:100%;">
                    <div class="carousel-caption">
                        <h4>Guitar Acoustic</h4>
                        <p>Công cụ vẽ nên âm nhạc!</p>
                    </div> 
              </div>
              
            </div>
        
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
</div>
        
<div class="container" style="margin-top:30px">
	<div class="row">
    
    	<div class="col-md-9 col-sm-9 col-xs-12">
        	<div class="row">
            	<div class="zoom col-md-4 col-sm-4 col-xs-12">
                    <img class="drift-demo-trigger"  data-zoom="img/sp/<?=$r['img_url']?>.jpg"
                     src="img/sp/<?=$r['img_url']?>.jpg" >	
                </div>                                
                
                <div class="col-md-8 col-sm-8 col-xs-12 gioithieu">
                	<h3 style="color:#900"><?=strtoupper($r['name'])?></h3>
                    <h4 style="color:#F00">Liên Hệ</h4>
                    <p style="font-weight:bold">
                    	<i class="fa fa-map-marker" aria-hidden="true"></i> 60/8 Lê Văn Thọ, P.11, Q.Gò Vấp, TP.HCM</p>
                    <p style="font-weight:bold"><i class="fa fa-phone-square" aria-hidden="true">
                    	</i> SĐT :  028.62577.475 - 0165.450.1223
                    </p>
                    <p style="color:#F00; font-size:18px"><strong><u>Giá tiền</u></strong>:<strong> <?=number_format($r['price'])?>đ</strong></p>
                    <p style="font-size:17px">Lượt xem: <?=$r['view']?></p>
                    <span style="font-size:17px;">Số lượng:</span>
                    <input type="number" id="qty" min="1" value="1" style="width:50px; text-align:center"/><br /><br />
                    <a href="javascript:window.location='?mod=cart_process&act=1&id=<?=$r['id']?>&qty='+document.getElementById('qty').value"><button type="button" class="btn btn-danger">Đặt Hàng</button></a>
                    
                    <br/>
                    <br/>
                    <br/><br/>
                </div>
                
                <!-- Zoom -->
                <script src="zoom/drift-master/dist/Drift.js"></script>
				<script>
                  new Drift(document.querySelector('.drift-demo-trigger'), {
                    paneContainer: document.querySelector('.gioithieu'),
                    inlinePane: 900,
                    inlineOffsetY: -85,
                    containInline: true,
                    hoverBoundingBox: true
                  });
                </script>
                
            </div>
                
            <div>
            	<p class="cont"><?=$r['desc']?></p>
                
                <hr>
                <p><strong>Liên hệ mua đàn guitar:</strong></p>
                <p>DT-Shop</p>
                <p>60/8 Lê Văn Thọ, P.11, Q.Gò Vấp, TP.HCM</p>
                <p></p>
                <p>SĐT :  028.62577.475 - 0165.450.1223</p>
            </div>
            
            <div class="panel panel-warning" style="margin-top:30px">
                <div class="panel-heading"><span style="font-size:18px; font-weight:bold">* Sản Phẩm Liên Quan *</span></div>
            </div>
            
            <div class="row">
              <?php			  
			  		$sql="select * from `dt_product` where `category_id`={$r['category_id']} and {$id} <> `id` order by rand() limit 0,6";
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
        </div>
        
        <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:10px; border-left:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC;">
        	<div class="panel panel-warning">
                <div class="panel-heading"><span style="font-size:17px; font-weight:bold">
                	<marquee direction="right">Sản Phẩm Xem Nhiều</marquee></span></div>
            </div>
              <?php
			  		$sql="SELECT * FROM `dt_product` ORDER BY `view` DESC limit 0,3";
					$rs=mysqli_query($link,$sql);
					while($xem_nhieu=mysqli_fetch_assoc($rs)) {
			  ?>
            
        		<div class="khung_sp col-md-12 col-sm-4 col-xs-12">
                    <img src="img/sp/<?=$xem_nhieu['img_url']?>.jpg"/>
                    <div class="ten_sp"><?=strtoupper($xem_nhieu['name'])?></div>
                    <div class="gia"><?=number_format($xem_nhieu['price'])?><span style="color:#F00; text-decoration:underline">đ</span></div>
                    <a href="?mod=detail&id=<?=$xem_nhieu['id']?>"><div class="xem_chitiet"><marquee>Xem chi tiết</marquee></div></a>  
                </div>                 
 			 
             <?php } ?>
             
        </div>
        
    </div>
</div>              
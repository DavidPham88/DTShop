
<div class="row">
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
        
    	<div id="left" class=" col-md-10 col-sm-10 col-xs-12 container">  
              
        <div class="row">	
         <?php
		 	$sql="select * from `dt_product` where `active`=1 
				and `id` between 1 and 50 order by rand() limit 0,16";
			$rs=mysqli_query($link,$sql);
			while($r=mysqli_fetch_assoc($rs)) {
		 ?>
            <div class="khung_sp col-md-2 col-sm-4 col-xs-12" style="text-align:center">
            	<img src="img/sp/<?=$r['img_url']?>.jpg"/>
                <div class="ten_sp"><?=strtoupper($r['name'])?></div>
                <div class="gia"><?=number_format($r['price'])?><span style="color:#F00; text-decoration:underline">đ</span></div>
                <a href="?mod=detail&id=<?=$r['id']?>"><div class="xem_chitiet"><marquee>Xem chi tiết</marquee></div></a>
                <a href="?mod=cart_process&act=1&id=<?=$r['id']?>"><input type="submit" class="btn btn-danger"
                value="Đặt Hàng Ngay"></a>
            </div>            	  
          
          <?php } ?>
                  
        </div>    
        </div>
        
    	<div id="right" class="col-md-2 col-sm-2 col-xs-12" style="margin-top:35px; position:sticky; top:60px; z-index:90;">        
			<script type="text/javascript">
            var myMenu;
            window.onload = function() {
                myMenu = new SDMenu("my_menu");
                myMenu.init();
            };             
            </script>
                <div id="my_menu" class="sdmenu">                 
                  <div>
                    <span style="background:#C36; font-size:13px; text-align:center; border-radius:8px">Sản Phẩm</span>
                    	<?php
						$sql="select * from `dt_department` where `active`=1 order by `order`";
						$rs=mysqli_query($link,$sql); 
						while($sp=mysqli_fetch_assoc($rs)) { 
						?>
		                    <a href="?mod=xemhang&id=<?=$sp['id']?>&chuyen=ok" style="text-align:center"><?=$sp['name']?></a>
                    	<?php } ?>

                  </div>
                  <div>
                    <div><a style="background:#C36;color:#FFF;font-weight:bold;font-size:13px;text-align:center;border-top:1px
                    solid #FFF" href="?mod=gioithieu">Giới Thiệu</a></div>                 
                  </div>
                  <div>
                    <div><a style="background:#C36; color:#FFF; font-weight:bold; font-size:13px; text-align:center"
                     href="#">Dịch Vụ</a></div>                 
                  </div>
                  <div>
                    <div><a style="background:#C36; color:#FFF; font-weight:bold; font-size:13px; text-align:center" href="#">
                    Tư Vấn</a>
                    </div>
                  </div>
                  <div>
                    <div><a style="background:#C36; color:#FFF; font-weight:bold; font-size:13px; text-align:center"
                     href="#">Giúp Đỡ</a></div>                 
                  </div>
                  <div>
                    <div><a style="background:#C36;color:#FFF;font-weight:bold;font-size:13px;text-align:center"
                     href="?mod=lienhe">Liên Hệ</a></div>
                  </div>
                </div>
        </div>
        
</div>


<!-- Phân Trang -->
    <!--<div class="container" style="margin-top:30px;">
    <div class="row trang">
    <div style="text-align:center">
    	<span style="color:#900;">Trang</span>
		<a href="#">&lt;&lt;</a>
        <a href="#">&lt;</a>
        
        <a class="current" href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        
        <a href="#">&gt;</a>
        <a href="#">&gt;&gt;</a>
        
        <select onChange="">

        	<option value="">Trang 1</option>

        </select>   
    </div>  
    </div>  
    </div>-->
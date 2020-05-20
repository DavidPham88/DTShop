<?php
	if(isset($_POST['search']))
	{
		$search=$_POST['searchtext'];
		$sql="select * from `dt_product` where `name` like '%$search%'";
		$rs=mysqli_query($link,$sql);
	}
?>	
	<div class="col-md-12 col-sm-12 col-xs-12 container">  
              
        <div class="row">	
         <?php
		 	if($count=mysqli_num_rows($rs)==0)
			{
		 ?>		
         		<div style='font-size:20px; color:red; font-weight:bold; text-align:center; margin-top:20px'>Không tìm thấy sản phẩm</div>
				<div style='margin-top:250px'></div>			           
         <?php
		 	}
		 	else
			{   
				while($r=mysqli_fetch_assoc($rs)) {
		 ?>
            <div class="khung_sp col-md-2 col-sm-4 col-xs-12" style="text-align:center">
            	<img src="img/sp/<?=$r['img_url']?>.jpg"/>
                <div class="ten_sp"><?=strtoupper($r['name'])?></div>
                <div class="gia"><?=number_format($r['price'])?><span style="color:#F00; text-decoration:underline">đ</span></div>
                <a href="?mod=detail&id=<?=$r['id']?>"><div class="xem_chitiet"><marquee>Xem chi tiết</marquee></div></a>
            </div>            	  
          
          <?php }
			}
		  ?>
                  
        </div>    
        </div>
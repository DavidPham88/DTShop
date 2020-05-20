<?php
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
	}
	else
	{
		$id=1;
	}			

//Lay cach sap xep
	if(isset($_GET['sort'])) $sort=$_GET['sort'];
	else $sort=1;
	
	if($sort==1)
		$order='`price` DESC';
	elseif($sort==2)
		$order='`price` ASC';

//Trang
if(isset($_GET['page']))
			{
				$page=$_GET['page'];
				if($page<1)
				{
					$page=1;
				}
			}
			else
			{
				$page=1;
			}
			
			/*
			*Tinh so trang = So san pham / so san pham 1 trang
			*/
			
			//Tinh so san pham
			$sql='select count(*) as `tong_sp` from `dt_product` where `category_id`='.$id.' and `active`=1';
			
			if(isset($_GET['chuyen']))
			{
				$sql="select count(*) as `tong_sp` from `dt_product` where `category_id` in (select `id` from `dt_category` where `department_id`={$id}) and `active`=1 ";
			}
			
			$rs_sp=mysqli_query($link,$sql);
			$r_sp=mysqli_fetch_assoc($rs_sp);
			
			$noi=$r_sp['tong_sp']; //number of item
			
			//Tinh so trang
			$nop= ceil($noi/12);//number of pages
			if($page>$nop)
			{
				$page=$nop;
			}	

?>
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
        
        <!--Sản phẩm hấp dẫn -->
        <div class="panel panel-danger" style="margin-top:20px">
                <div class="panel-heading"><span style="font-size:17px; font-weight:bold">
                	<marquee direction="right">--- Những Sản Phẩm Hấp Dẫn ---</marquee></span></div>
        </div>
        
        <!--Sort-->
        <div style="float:right">
        <a href="?mod=xemhang&id=<?=$id?>&page=1<?php if(isset($_GET['chuyen'])) echo'&chuyen=ok'?>&sort=<?=($sort==1)?2:1;?>"
        id="sort">
        	Sắp xếp <i class="fa fa-sort"></i> - 
				<?php if($sort==1) {echo'Giá đang <strong>giảm</strong> dần';}
					  else{echo'Giá đang <strong>tăng</strong> dần';}
				?>
        </a>
        </div>
        
        <!--Body-->
        <div class="container" style="margin-top:45px">      
        <div class="row">	        	
            
        	<?php
				$pos=($page -1 )*12;
				$i=1;
				
				$sql="select * from `dt_product` where `category_id`={$id} and `active`=1 order by {$order} limit {$pos} ,12";
				
				if(isset($_GET['chuyen']))
				{
					$sql="select * from `dt_product` where `category_id` in(select `id` from `dt_category` where `department_id`={$id} )  and `active`=1 order by {$order} limit {$pos},12";
				}
				
				$rs=mysqli_query($link,$sql);
				while($r=mysqli_fetch_assoc($rs)) {		
			?>
                <div class="khung_sp col-md-3 col-sm-3 col-xs-12" style="margin-left:40px">
                    <img src="img/sp/<?=$r['img_url']?>.jpg"/>
                    <div class="ten_sp"><?=strtoupper($r['name'])?></div>
                    <div class="gia"><?=number_format($r['price'])?><span style="color:#F00; text-decoration:underline">đ</span></div>
                    <a href="?mod=detail&id=<?=$r['id']?>"><div class="xem_chitiet"><marquee>Xem chi tiết</marquee></div></a>
                </div> 
            <?php } ?>             
        </div>              
        </div>
</div>

 <?php
			
	
?>


<!-- Phân Trang -->
    <div class="container" style="margin-top:30px;">
    <div class="row trang">
    <div style="text-align:center">
    	<span style="color:#900;">Trang</span>
    <?php
		if(isset($_GET['chuyen']))
		{
	?>
    		<a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=1&chuyen=ok">&lt;&lt;</a>
        	<a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=<?= $page-1 ?>&chuyen=ok">&lt;</a>
    <?php
		}
		else
		{
	?>    
        
            <a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=1">&lt;&lt;</a>
            <a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=<?= $page-1 ?>">&lt;</a>
    <?php } ?>
    
            
        
    <?php for($j=$page-2; $j<= $page +2; $j++) 
		if($j >=1 && $j <= $nop)	
		{
			if(isset($_GET['chuyen']))
			{
	?>
                
        	<a <?php if($j==$page) echo 'class="current"'?> href="?mod=xemhang&sort=<?=$sort?>&id=<?=$id?>&page=<?= $j ?>&chuyen=ok"><?= $j ?></a>
        
    <?php   }
			else
			{
	?>       
    		<a <?php if($j==$page) echo 'class="current"'?> href="?mod=xemhang&sort=<?=$sort?>&id=<?=$id?>&page=<?= $j ?>"><?= $j ?></a>
    <?php
			}
		}
	?>
    
    <?php
		if(isset($_GET['chuyen']))
		{	
	?>		
			<a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=<?= $page+1 ?>&chuyen=ok">&gt;</a>
        	<a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=<?= $nop ?>&chuyen=ok">&gt;&gt;</a>
    <?php
		}
		else
		{		
	?>          
            <a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=<?= $page+1 ?>">&gt;</a>
            <a href="?mod=xemhang&sort=<?=$sort?>&id=<?= $id ?>&page=<?= $nop ?>">&gt;&gt;</a>
    <?php
		}
	?>
    
        
        <select onChange="window.location='?mod=xemhang<?php if(isset($_GET['chuyen'])) echo'&chuyen=ok'?>&sort=<?=$sort?>&id=<?=$id?>&page='+this.value">
			<?php 
				for ($i = 1; $i <= $nop; $i++)
            	{
			?>
            
        	<option <?= ($i == $page)?'selected':''?> value="<?= $i ?>">Trang <?= $i ?></option>
			
             <?php } ?>
             
        </select>   
    </div>  
    </div>  
    </div>
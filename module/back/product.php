<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}
?>

<style>
 table.dataTable{
	 border-collapse:collapse;
 }
</style>
 
 <div class="row">
  <div class="col-md-5 col-sm-5 col-xs-12"></div>
  <div style="padding-bottom:25px" class="col-md-5 col-sm-5 col-xs-12">  
  <caption>
    <h2>Danh Sách Sản Phẩm</h2>
    <select id="category_id" onchange="window.location='?mod=product&cid='+this.value" style="margin-bottom:10px; width:200px;">
    	<?php
			$cid = @$_GET['cid'];
			if($cid == '') $cid = 1;
			
			
			$sql="select * from `dt_department` where `active`=1";
			$rs=mysqli_query($link,$sql);
			while($r=mysqli_fetch_assoc($rs)){
		?>
        
        <optgroup label="<?=$r['name']?>">
        
        	<?php
				$sql="select * from `dt_category` where `department_id`={$r['id']}";
				$kq=mysqli_query($link,$sql);
				while($show_kq=mysqli_fetch_assoc($kq)):
			?>
            
            <option <?php if($show_kq['id']==$cid) echo'selected'?>
            	value="<?=$show_kq['id']?>"><?=$show_kq['name']?>
            </option>
            
            <?php endwhile ?>
        
        </optgroup>
        
        <?php } ?>
    </select>
  </caption>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-12"></div>
 </div> 
  
  
<table class="col-md-12 col-sm-12 col-xs-12 table-bordered" id="datatable" style="text-align:center; margin-top:10px">
  <thead>
  <tr align="center" bgcolor="#FFFFCC">
    <td><h4><strong>STT</strong></h4></td>
    <td><h4><strong>Tên</strong></h4></td>
    <td><h4><strong>Giá</strong></h4></td>    
    <td><h4><strong>Số Lượng</strong></h4></td>
    <td><h4><strong>Ẩn | Hiện</strong></h4></td>
    <td bgcolor="#FFFF99"><h4><strong><a href="?mod=product_add">+Thêm</a></strong></h4></td>
  </tr>
  </thead>
  <?php   	
	$sql = "SELECT `id`,`name`,`qty`,`price`,`active` from `dt_product` where `category_id`={$cid}";
	$rel = mysqli_query($link,$sql);
	$i=1;
	while($re = mysqli_fetch_assoc($rel))
	{
  ?>
  <tr class="nen">
  	<td align="center"><h5>
      <?=$i++?>
    </h5></td>
    <td align="left"><h5>&nbsp;&nbsp;
      <?=$re['name']?>
    </h5></td>
     <td align="right"><h5>
      <?=number_format($re['price'])?>đ
    </h5></td>
    <td align="right"><h5>
      <?=$re['qty']?>
    </h5></td>
    <td align="center"><h5>
      <?php if($re['active']==0) {echo "<a href=\"?mod=product_hide&id={$re['id']}\">X</a>";}
			else
			{
				echo "<a href=\"?mod=product_show&id={$re['id']}\"><i class=\"fa fa-eye\"></i></a>";
			}
	?>
    </h5></td>
    <td align="center"><h5><a href="?mod=product_upd&id=<?=$re['id']?>">Sửa</a> | <a href="?mod=product_del&id=<?=$re['id']?>" onClick="return confirm('Chắc chắn xóa?')">Xóa</a> | <a href="index.php?mod=detail&id=<?=$re['id']?>" target="_blank">Chi tiết</a></h5></td>
  </tr>
  <?php } ?>
</table>

<script>
	$(document).ready(function(){    	
		$('#datatable').DataTable( {
   			 language: {
        		url: 'datatable/Vietnamese.json'
    		}
		});
    });
</script>

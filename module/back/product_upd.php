<?php
	if( ! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");
	}
	
	$id=$_GET['id'];
	
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$price=$_POST['price'];
		$qty=$_POST['qty'];
		$category_id=$_POST['category_id'];
		$desc=$_POST['desc'];
		$detail=$_POST['detail'];
		$note=$_POST['note'];
		$active=$_POST['active'];
		
		//Xử lý file
		$file = $_FILES['img_url'];
		
		if($file['name']!='')//Có submit file
		{
			//Lay ten file			
			$img_url = mt_rand().$file['name'];//mt_rand(): sinh so ngau nhien, xu ly trung ten file
			//Copy file toi thu muc chua anh
			copy($file['tmp_name'],"img/sp/{$img_url}.jpg");
		
		$sql = "update `dt_product` set `name`='{$name}',`price`={$price},`qty`={$qty},`category_id`={$category_id},`desc`='{$desc}',`detail`='{$detail}',`note`='{$note}',`active`={$active},`img_url`='{$img_url}' where `id`={$id}";
		mysqli_query($link, $sql);
		
		//Xóa hình cũ sau khi cập nhật hình mới
		$hinhcu="img/sp/{$r['img_url']}.jpg";
		unlink($hinhcu);
		
		}
		
		else
		{
			$sql = "update `dt_product` set `name`='{$name}',`price`={$price},`qty`={$qty},`category_id`={$category_id},`desc`='{$desc}',`detail`='{$detail}',`note`='{$note}',`active`={$active} where `id`={$id}";
		mysqli_query($link, $sql);
		}
		
		//Chuyen den trang view
		header('location:?mod=product&cid='.$category_id);
	}
?>

<div class="container">
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-12"></div> 

<?php
	$sql="select * from `dt_product` where `id`={$id}";
	$kq=mysqli_query($link,$sql);
	$s_kq=mysqli_fetch_assoc($kq);
?>

<script type="text/javascript" src="lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="lib/ckfinder/ckfinder.js"></script>
<form action="" method="post" enctype="multipart/form-data">
<table width="421" height="729" border="1"  class="col-md-6 col-sm-6 col-xs-12">
	<caption style="text-align:center">
    	<h2>Cập Nhật Sản Phẩm</h2>
  	</caption>
  
  <tr>
    <td width="108" height="36" align="center">Tên</td>
    <td width="297" align="left">&nbsp;
    	<input type="text" name="name" value="<?=$s_kq['name']?>" required>
    </td>
  </tr>
  <tr>
    <td height="36" align="center">Giá</td>
    <td align="left">&nbsp;
      <input type="text" name="price" value="<?=$s_kq['price']?>" required></td>
  </tr>
  <tr>
    <td height="36" align="center">Số lượng</td>
    <td align="left">&nbsp;
      <input type="number" name="qty" value="<?=$s_kq['qty']?>" required></td>
  </tr>
  <tr>
    <td height="157" align="center">Hình</td>
    <td align="left" style="line-height:10px">&nbsp;
      <img src="img/sp/<?=$s_kq['img_url']?>.jpg" alt="<?=$s_kq['name']?>" height="100px"><br><br>
      <input type="file" name="img_url" id="fileField"><br>
      <em> (Để trống nếu không muốn cập nhật hình) </em>
    </td>
  </tr>
  <tr>
    <td height="35" align="center">Ẩn / Hiện</td>
    <td align="left">&nbsp;
      <select name="active">
        <option value="1" <?php if($s_kq['active']==1) echo'selected';?>>Hiện</option>
        <option value="0" <?php if($s_kq['active']==0) echo'selected';?>>Ẩn</option>
      </select></td>
  </tr>
  <tr>
    <td width="108" height="36" align="center">Thuộc Loại</td>
    <td width="297" align="left">&nbsp;
      <select name="category_id">
      
       <?php
	  	//Lay tat ca chung loai
		$sql = 'select `id`,`name` from `dt_department`';
		$rs = mysqli_query($link,$sql);
		while($r=mysqli_fetch_assoc($rs)){
	  ?>
      	<optgroup label="<?=$r['name']?>">
      		
            <?php $sql="select * from `dt_category` where `department_id`={$r['id']}";
				  $k=mysqli_query($link,$sql);
				  while($sk=mysqli_fetch_assoc($k)):
			?>
        	<option value="<?=$sk['id']?>" <?php if($s_kq['category_id']==$sk['id']) echo'selected';?>><?=$sk['name']?></option>
           
            <?php endwhile ?>
            
        </optgroup>
            
      <?php } ?>  
        </select>
      </td>
  </tr>
  <tr>
    <td height="37" align="center">Mô tả</td>
    <td align="left">&nbsp;&nbsp;
      <label for="textarea"></label>
      <textarea class="ckeditor" name="desc" id="desc" cols="45" rows="5"><?=$s_kq['desc']?></textarea>
      <label for="textfield"></label></td>
  </tr>
  <tr>
    <td height="37" align="center">Chi tiết</td>
    <td align="left">&nbsp;&nbsp;
      <label for="textarea"></label>
      <textarea class="ckeditor" name="detail" id="detail" cols="45" rows="5"><?=$s_kq['detail']?></textarea>
      <label for="textfield"></label></td>
  </tr>
  <tr>
    <td height="37" align="center">Ghi chú</td>
    <td align="left">&nbsp;&nbsp;
      <label for="textarea"></label>
      <textarea name="note" id="textarea" cols="45" rows="5"><?=$s_kq['note']?></textarea>
      <label for="textfield"></label></td>
  </tr>
  <tr align="center">
    <td height="51" colspan="2">
      <input type="submit" value="Cập Nhật Sản Phẩm"  class="btn btn-danger">&nbsp;&nbsp;&nbsp;
      <input type="reset" value="Đặt Lại"  class="btn btn-danger">
      </td>
  </tr>
 
</table>
</form>

<div class="col-md-3 col-sm-3 col-xs-12"></div> 
</div>
</div>

<script>
	//Chi tiết
	var detail = CKEDITOR.replace( 'detail', {
		uiColor: '#ccffff',
		language:'vi',
	});
		
	CKFinder.setupCKEditor( detail, 'lib/ckfinder/' ) ;
	
	//Mô tả
	var desc = CKEDITOR.replace( 'desc', {
		uiColor: '#ffccff',
		language:'vi',
	});
		
	CKFinder.setupCKEditor( desc, 'lib/ckfinder/' ) ;
	
</script>
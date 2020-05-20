<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}

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
		}
		
		$sql = "insert into `dt_product` values (NULL,'$category_id','$name','$price','$desc','$detail','$img_url',now(),'$qty','$note','0','0','$active')";
		mysqli_query($link, $sql);
		
		//Chuyen den trang view
		header('location:?mod=product&cid='.$category_id);
	}
?>


<script type="text/javascript" src="lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="lib/ckfinder/ckfinder.js"></script>
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-12"></div> 

<form action="" method="post" enctype="multipart/form-data">
<table width="421" height="401" border="1"  class="col-md-6 col-sm-6 col-xs-12">
	<caption style="text-align:center">
    	<h2>Thêm Sản Phẩm</h2>
  	</caption>
  
  <tr>
    <td width="108" height="36" align="center">Tên</td>
    <td width="297" align="left">&nbsp;
    	<input type="text" name="name" required>
    </td>
  </tr>
  <tr>
    <td height="36" align="center">Giá</td>
    <td align="left">&nbsp;
      <input type="text" name="price" required></td>
  </tr>
  <tr>
    <td height="36" align="center">Số lượng</td>
    <td align="left">&nbsp;
      <input type="number" name="qty" required></td>
  </tr>
  <tr>
    <td height="36" align="center">Hình</td>
    <td align="left" style="line-height:10px">&nbsp;
      <label for="fileField"></label>
      <input type="file" name="img_url" id="fileField"></td>
  </tr>
  <tr>
    <td height="35" align="center">Ẩn / Hiện</td>
    <td align="left">&nbsp;
      <select name="active">
        <option value="1">Hiện</option>
        <option value="0">Ẩn</option>
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
				  $kq=mysqli_query($link,$sql);
				  while($s_kq=mysqli_fetch_assoc($kq)):
			?>
        	<option value="<?=$s_kq['id']?>"><?=$s_kq['name']?></option>
           
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
      <textarea  class="ckeditor" name="desc" id="desc" cols="45" rows="5"></textarea>
      <label for="textfield"></label></td>
  </tr>
  <tr>
    <td height="37" align="center">Chi tiết</td>
    <td align="left">&nbsp;&nbsp;
      <label for="textarea"></label>
      <textarea class="ckeditor" name="detail" id="detail" cols="45" rows="5"></textarea>
      <label for="textfield"></label></td>
  </tr>
  <tr>
    <td height="37" align="center">Ghi chú</td>
    <td align="left">&nbsp;&nbsp;
      <label for="textarea"></label>
      <textarea name="note" id="textarea" cols="45" rows="5"></textarea>
      <label for="textfield"></label></td>
  </tr>
  <tr align="center">
    <td height="51" colspan="2">
      <input type="submit" value="Thêm Sản Phẩm"  class="btn btn-danger">&nbsp;&nbsp;&nbsp;
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
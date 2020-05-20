<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}

	$id=$_GET['id'];
	
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=$_POST['active'];
		$department_id=$_POST['department_id'];
		
		$sql = "update `dt_category` set `name`='{$name}',`order`={$order},`active`={$active},`department_id`={$department_id} where `id`={$id}";
		mysqli_query($link, $sql);
		
		//Chuyen den trang view
		header('location:?mod=cate');
	}
?>

<?php
	$sql="select * from `dt_category` where `id`={$id}";
	$kq=mysqli_query($link,$sql);
	$show_kq=mysqli_fetch_assoc($kq);
?>
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-12"></div> 

<form action="" method="post">
<table width="421" height="171" border="1"  class="col-md-6 col-sm-6 col-xs-12">
	<caption style="text-align:center">
    	<h2>Cập Nhật Thể Loại</h2>
  	</caption>
  
  <tr>
    <td width="108" height="36" align="center">Tên</td>
    <td width="297" align="left">&nbsp;
    	<input type="text" name="name" value="<?=$show_kq['name']?>" required>
    </td>
  </tr>
  <tr>
    <td width="108" height="36" align="center">Thuộc Chủng Loại</td>
    <td width="297" align="left">&nbsp;
      <select name="department_id">
       <?php
	  	//Lay tat ca chung loai
		$sql = 'select `id`,`name` from `dt_department`';
		$rs = mysqli_query($link,$sql);
		while($r=mysqli_fetch_assoc($rs)){
	  ?>
		<option value="<?=$r['id']?>" <?php if($r['id']==$show_kq['department_id']) echo'selected';?>><?=$r['name']?></option>
      <?php } ?>  
      </select>
    </td>
  </tr>
  <tr>
    <td height="37" align="center">Thứ Tự</td>
    <td align="left">&nbsp;&nbsp;<input type="number" min="1" name="order" value="<?=$show_kq['order']?>" required></td>
  </tr>
  <tr>
    <td height="35" align="center">Ẩn / Hiện</td>
    <td align="left">&nbsp;
      <select name="active">
		<option value="1" <?php if($show_kq['active']==1) echo'selected'?>>Hiện</option>
        <option value="0" <?php if($show_kq['active']==0) echo'selected'?>>Ẩn</option>
      </select>
    </td>
  </tr>
  <tr align="center">
    <td height="51" colspan="2">
      <input type="submit" value="Cập Nhật Thể Loại"  class="btn btn-danger">&nbsp;&nbsp;&nbsp;
      <input type="reset" value="Đặt Lại"  class="btn btn-danger">
    </td>
  </tr>
 
</table>
</form>

<div class="col-md-3 col-sm-3 col-xs-12"></div> 
</div>
</div>
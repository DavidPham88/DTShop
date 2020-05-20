<?php
	if(! isset($_SESSION['admin_id']))
	{
		header("location:?mod=dangnhap");	
	}
?>

<div style="margin-top:20px; padding-bottom:400px">
<table width="506" border="1" style="text-align:center" class="col-md-12 col-sm-12 col-xs-12">
  <caption style="text-align:center">
    <h2>Danh Sách Thể Loại</h2>
  </caption>
  <tr>
    <td width="56" height="31" align="center" bgcolor="#FFFFCC"><h4><strong>STT</strong></h4></td>
    <td width="145" align="center" bgcolor="#FFFFCC"><h4><strong>Tên</strong></h4></td>
    <td width="145" align="center" bgcolor="#FFFFCC"><h4><strong>Thuộc Chủng Loại</strong></h4></td>    
    <td width="100" align="center" bgcolor="#FFFFCC"><h4><strong>Thứ Tự</strong></h4></td>
    <td width="73" align="center" bgcolor="#FFFFCC"><h4><strong>Ẩn | Hiện</strong></h4></td>
    <td width="98" align="center" bgcolor="#FFFF99"><h4><strong><a href="?mod=cate_add">+Thêm</a></strong></h4></td>
  </tr>
  <?php   	
	$sql="select a.*,b.`name` as `d_name` from `dt_category` as a left join `dt_department` as b
			 on a.`department_id`=b.`id` order by b.`id`";
	$rs=mysqli_query($link,$sql);  
	$i=1;
	while($r=mysqli_fetch_assoc($rs)) {
  ?>
  <tr class="nen">
    <td height="37" align="center"><h5>
      <?=$i++?>
    </h5></td>
    <td align="left"><h5>&nbsp;&nbsp;
      <?=$r['name']?>
    </h5></td>
     <td align="center"><h5>
      <?=$r['d_name']?>
    </h5></td>
    <td align="center"><h5>
      <?=$r['order']?>
    </h5></td>
    <td align="center"><h5>
      <?php if($r['active']==0) {echo "<a href=\"?mod=cate_hide&id={$r['id']}\">X</a>";}
			else
			{
				echo "<a href=\"?mod=cate_show&id={$r['id']}\"><i class=\"fa fa-eye\"></i></a>";
			}
	?>
    </h5></td>
    <td align="center"><h5><a href="?mod=cate_upd&id=<?=$r['id']?>">Sửa</a> | <a href="?mod=cate_del&id=<?=$r['id']?>" onClick="return confirm('Chắc chắn xóa?')">Xóa</a></h5></td>
  </tr>
  <?php } ?>
</table>
</div>
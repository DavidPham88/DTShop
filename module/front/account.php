<?php
	//Neu chua dang nhap thi chuyen den trang dang nhap
	if( ! isset($_SESSION['id']))
	{
		header('location:?mod=dangnhap');
	}
	
	//Lay thong tin nguoi dung
	$user_ID=$_SESSION['id'];
	
	$sql="select * from `dt_user` where `id`={$user_ID}";
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
?>

<div class="container">
<div class="row">
<div class="col-md-8 col-sm-8 col-xs-12">
	<form action="?mod=update_account" method="post">
        <h3>Hello, <?=$r['name'];?>! </h3><br />
        <h4>Với tài khoản của bạn, bạn có thể xem thêm được những sản phẩm trong giỏ hàng của bạn và sẽ được nhiều ưu đãi hấp dẫn hơn khi mua hàng.</h4> 
        <hr />
        <div style="font-size:20px; font-weight:bold; margin-top:30px; text-decoration:underline">Thông tin tài khoản</div><br />
        <p><strong>Họ tên</strong>: <?=$r['name'];?></p>
        <p><strong>Giới tính</strong>: <?php if($r['gender']==0) echo 'Nữ';  else{ echo 'Nam'; }?></p>
        <p><strong>Ngày sinh</strong>: <?=date('d/m/Y',strtotime($r['dob']));?></p>
        <p><strong>Email</strong>: <?=$r['email'];?></p>
        <p><strong>Số điện thoại</strong>: <?=$r['mobile'];?></p>
        <p><strong>Địa chỉ</strong>: <?=$r['address'];?></p><br/>
    
    	<button type="submit" class="btn btn-danger">Cập Nhật</button>
    </form>
    
    <div style="margin-top:30px">
    	<h3 style="color:#903">Những đơn hàng của bạn*</h3>  
    	<table width="839" border="1" class="col-md-12 col-sm-12 col-xs-12">
          <tr>
            <td width="112" align="center"><strong>Mã đơn hàng</strong></td>
            <td width="164" align="center"><strong>Ngày đặt</strong></td>
            <td width="177" align="center"><strong>Người nhận</strong></td>
            <td width="140" align="center"><strong>Tổng tiền</strong></td>
            <td width="212" align="center"><strong>Trạng thái</strong></td>
          </tr>
           <?php
				$sql="select `id`,`create_at`,`name`,sum(`price`*`qty`) as `total`,`status` 
					from `dt_order` as a, `dt_order_detail` as b
					where a.`id`=b.`order_id` and `user_id`={$user_ID}
					group by `id`
					order by `id` desc";
				$rs=mysqli_query($link,$sql);
				while($r=mysqli_fetch_assoc($rs)){		
	 		?>  
          <tr>
            <td align="center"><?=$r['id']?></td>
            <td align="center"><?=$r['create_at']?></td>
            <td align="center"><?=$r['name']?></td>
            <td align="center"><?=number_format($r['total'])?>đ</td>
            <td align="center" colspan="2"><?php $trangthai = array(0 => 'Mới Đặt', 1 => 'Đã xác nhận', 2 => 'Đang giao'
					, 3=> 'Đã giao', 4 =>'Hoàn tất', -1=>'Hủy');
									echo $trangthai[$r['status']];
			                   ?>                    
            <div></div><a href="?mod=view_order&id=<?=$r['id']?>" style="text-decoration:none">Xem</a> 
            		<?php if($r['status']==0) { ?>
					<a href="?mod=view_cancel&id=<?=$r['id']?>" style="text-decoration:none" 
                    onclick="return confirm('Bạn chắc chắn muốn hủy ?')"> | Hủy</a><?php } ?></td>
          </tr>
          
          <?php } ?>
          
		</table>
    </div>

</div>
	
    
    <!-- Đánh giá -->
     <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top:60px">
                <form action="?mod=danhgia" method="post" id="danh_gia">

                <!--Tieu đề câu hỏi -->
                <?php
					$sql="select `id`,`content` from `dt_question` where `active`=1";
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_assoc($rs);
				?>
                
                <p style="text-align:center; font-weight:bold; font-size:18px; text-decoration:underline">
                	<?=$r['content'];?>
                </p>
                
                <ul class="form_lh" style="margin-top:20px">
                <!--Những đáp án trả lời -->        
                <?php
					$sql="select `id`,`content` from `dt_answer` where `question_id`=1";
					$rs=mysqli_query($link,$sql);
					
					while($r=mysqli_fetch_assoc($rs)) {
				?>        
                	<li><label><input name="answer" type="radio" value="<?=$r['id'] ?>" > <?=$r['content']; ?></li></label> 
                <?php } ?>
                                                  
                </ul>
                <button type="submit" class="btn btn-default" style="margin-top:10px; margin-left:40px">Bình chọn</button>   
                </form> 
        
    </div>
  
</div>  
</div>
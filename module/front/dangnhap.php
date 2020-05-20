

<div class="col-md-8 col-sm-8 col-xs-12" style="background:url(img/gioithieu/classic-1846719_960_720.jpg); border-radius:5px">
	<div class="container">
    <div class="row">
        <div id="dang_nhap" class="col-md-6 col-sm-6 col-xs-12">
        <form action="?mod=xulydangnhap" method="post">
        <fieldset>
            <legend><h2>Đăng Nhập</h2></legend>
            <ul class="form_dn">
                <li>Email*</li>
                <li><input type="text" name="user" required 
                value="<?php
							if(isset($_SESSION['email']))
							{
								echo $_SESSION['email'];
								unset($_SESSION['email']);
							}
                	   ?>" 
                /></li>
            </ul>
            
            <ul class="form_dn">
                <li>Mật khẩu*</li>
                <li><input type="password" name="pass" value="" required /></li>
            </ul> 
            
            <ul class="form_dn">
                <li><a href="?mod=password_forget"><em>Bạn quên mật khẩu?</em></a></li>               
            </ul>         
            
            <ul>
            	<button class="btn btn-danger" style="margin-top:15px" type="submit">Đăng Nhập</button>
            </ul>
        
        </fieldset>    
        </form>
        </div>
    
    </div>
    </div>
    
    <div class="container">
    <div class="row">
    
        <div id="dang_ky" class="col-md-6 col-sm-6 col-xs-12">

            <legend><h3>Tạo tài khoản</h3></legend>      
            <p>Nếu chưa có tài khoản, hãy tạo nhanh và ngay để có nhiều ưu đãi hấp dẫn. Bạn có thể được miễn phí giao hàng
            , hay có thể được kiểm tra đơn hàng nhanh hơn, được quyền sử dụng các chức năng khác của trang web.
            Còn chần chờ gì nữa ? Hãy tạo cho mình một tài khoản nào !</p>      
            <ul>
            	<a href="?mod=dangky" class="btn btn-danger" style="margin-top:15px">Đăng Ký</a>
            </ul>          

        </div>
    
    </div>
    </div>
</div>    


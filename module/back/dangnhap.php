<?php
	if(isset($_SESSION['admin_id']))
	{
		header("location:?mod=home");
	}
?>
<div class="col-md-2 col-sm-2 col-xs-2"></div>

<div style="background:url(img/gioithieu/classic-1846719_960_720.jpg);" id="bor">
	<div class="container" id="khung_dangnhap">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12"></div>
        <div id="dang_nhap" class="col-md-6 col-sm-6 col-xs-12">

            <form action="?mod=xulydangnhap" method="post">
            <fieldset>
                <legend><h2 style="text-align:center; background-color:#FCF; padding:8px 0 8px 0">
                	<strong>Xin Chào Admin!</strong></h2>
                </legend>
                <h3>Đăng Nhập</h3><br />
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
                
                <ul>
                    <button class="btn btn-danger" style="margin-top:15px" type="submit">Đăng Nhập</button>
                </ul>
            
            </fieldset>    
            </form>
          </div>
         
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
        
    </div>
    </div>
    
</div>    
</div>

<div class="col-md-2 col-sm-2 col-xs-2"></div>
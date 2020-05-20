<?php
	session_start();
	ob_start(); //cached output cho browser, de su dung ham header
	require_once("lib/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>DTshop</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="sdmenu/sdmenu.css" />
<script type="text/javascript" src="sdmenu/sdmenu.js"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

	<div style="border:1px solid #CCC; height:auto;">
        <div id="top" class="container">
            <nav class="row" style="background-color:#FFF; min-height:28px;border:none;">
                             
                <ul class="log col-md-8 col-sm-8 col-xs-12">
                  <li>
                  	<?php
						if(isset($_SESSION['name']))
						{
							echo 'Xin Chào '.$_SESSION['name'];
						}
						else
						{
							echo "Xin chào";
						}
					?>
                  </li>
                  <li>
					<?php
						if(isset($_SESSION['id']))
						{
							echo '<a href="?mod=account">Tài khoản của tôi</a>';
						}
						else
						{
							echo '<a href="?mod=dangnhap">Tài khoản của tôi</a>';
						}
					?>
                  </li>
                  <li><a href="?mod=cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  	[<?php echo @count($_SESSION['cart'])?>] Giỏ hàng</a>
                  </li>
                  <li><a href="?mod=checkout">Kiểm tra giỏ hàng</a></li>
                  <li style="border-right:none;">
                  	<?php
						if(isset($_SESSION['id']))
						{
							echo "<a href='?mod=dangxuat'>Đăng Xuất</a>";
						}
						else
						{
							echo "<a href='?mod=dangnhap'>Đăng Nhập</a>";
						}
					?>
                  </li>
                </ul>
                <ul class="log2 col-md-4 col-sm-4 col-xs-12">                    	                       
                    <li><a href="#" style="color:#F6F"><i class="fa fa-instagram share" aria-hidden="true"></i></a></li>
                    <li><a href="#" style="color:#F00"><i class="fa fa-youtube-play share" aria-hidden="true"></i></a></li>                    <li><a href="#" style="color:#30C"><i class="fa fa-facebook-official share" aria-hidden="true"></i></a></li>
                    <li id="disappear">Chia sẻ:</li> 
                </ul>
              
            </nav>
        </div>
    </div>
    
    <div style="clear:both"></div>
    
    <div class="container">
    	<div class="row" style="margin-top:20px;">
        
    		<div class="col-md-8 col-sm-12 col-xs-12">
            	<a href="?mod=home"><img src="img/logo/1.PNG" alt="" style="float:left"/></a>
                <div id="slogan">Sự lựa chọn hoàn hảo!</div>
            </div>

            <div id="search" class="col-md-4 col-sm-12 col-xs-12" style="text-align:center">
            	<form action="?mod=search" method="post" enctype="multipart/form-data">
                    <input type="text" name="searchtext" placeholder="Tìm kiếm..." style="width:220px;" />
                    <button type="submit" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>            
            
        </div>
    </div>
    
    <div style="clear:both"></div>
    
   <nav class="navbar navbar-default" style="margin-top:20px; background-color:#C36; position:sticky; top:0; z-index:99">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand trangchu" href="?mod=home">Trang Chủ</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">                               
                <li style="border-left:1px dotted #FFF;"><a href="?mod=gioithieu">Giới Thiệu</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản Phẩm<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  	<?php																									
						$sql="select * from `dt_department` where `active`=1 order by `order`";
						$rs=mysqli_query($link,$sql); 		
						while($r=mysqli_fetch_assoc($rs)) { 
						
						$sql_sub="select * from `dt_category` where `active`=1
								and `department_id`={$r['id']} order by `order`"; 
						$rs_sub=mysqli_query($link,$sql_sub);
					?>
                    <li style="border-right:none;"><a href="?mod=xemhang&id=<?=$r['id']?>&chuyen=ok"><?=$r['name'];?></a>
                            
                    	<ul class="menu_dacap">
                        	<?php
								while($kq=mysqli_fetch_assoc($rs_sub)) {
							?>
                        	<li class="menu_dacap_con" style="border-right:none"><a href="?mod=xemhang&id=<?=$kq['id']?>">
								<?=$kq['name']?></a></li>
  							<?php } ?>
                        </ul>
                    </li>   
                    <?php } ?>                
                  </ul>
                </li>
                
                <li><a href="#">Dịch Vụ</a></li>
                <li><a href="#">Tư Vấn</a></li>
                <li><a href="#">Giúp Đỡ</a></li>
                <li style="border-right:none;"><a href="?mod=lienhe">Liên Hệ</a></li>                
              </ul>          
            </div>
          </div>
	</nav>        
    
    <!--Body-->
    <div class="container">
    	<?php $mod=@$_GET['mod'];
			  if($mod=='') $mod='home';
			  include("module/front/{$mod}.php");
		?>
    </div>        	
    
    
    <!-- Footer -->
    <div id="footer" class="container-fluid">
    <div class="row">
    	 <div class="col-md-4 col-sm-4 col-xs-12">
         	<a href="?mod=home"><img src="img/logo/1.PNG" alt="" style="margin-top:18px;" /></a>
         </div>   
         
         <div class="foo col-md-3 col-sm-3 col-xs-12">
         	<ul style="list-style:none">
            	<li><a href="?mod=home">Trang Chủ</a></li>
                <li><a href="?mod=gioithieu">Giới Thiệu</a></li>
                <li><a href="#">Tư Vấn</a></li>
                <li><a href="#">Giúp Đỡ</a></li>
            </ul>
         </div>
         
         <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:15px; color:#FFF;">
                    <p><u>Địa chỉ:</u></p>
                    <p>60/8 Lê Văn Thọ, Phường 11, Q.Gò Vấp, TP.HCM</p>
                    <p>SĐT: 028.62577.475 hoặc 0165.450.1223</p>
         </div>
         
         <div id="map" class="col-md-2 col-sm-2 col-xs-12" style="height:125px;"></div>
			<script>
            function myMap() {
              var mapCanvas = document.getElementById("map");
              var myCenter = new google.maps.LatLng(10.83333,106.63278); 
              var mapOptions = {center: myCenter, zoom: 13};
              var map = new google.maps.Map(mapCanvas,mapOptions);
              var marker = new google.maps.Marker({
                position: myCenter,
                animation: google.maps.Animation.BOUNCE
              });
              marker.setMap(map);
            }
            </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHXf-8bmIXaKqxEzh0tHi6NXN6ihyYcsA&callback=myMap"></script>
                    
    </div>
	</div>

</body>
</html>

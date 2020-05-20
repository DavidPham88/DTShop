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
<link rel="stylesheet" type="text/css" href="css/adminstyle.css" />
<link rel="stylesheet" type="text/css" href="sdmenu/sdmenu.css" />
<script type="text/javascript" src="sdmenu/sdmenu.js"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Library For DATATABLE PLUGGIN -->
<script src="datatable/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css" />

</head>

<body>

	<div style="border:1px solid #CCC; height:auto;">
        <div id="top" class="container">
            <nav class="row" style="background-color:#FFF; min-height:28px;border:none;">
                             
                <ul class="log col-md-12 col-sm-12 col-xs-12">
                  <li>
                  	<?php
						if(isset($_SESSION['admin_name']))
						{
							echo 'Xin Chào '.$_SESSION['admin_name'];
						}
						else
						{
							echo "Xin chào";
						}
					?>
                  </li>                 
                  <li style="border-right:none;">
                  	<?php
						if(isset($_SESSION['admin_id']))
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
            </nav>
        </div>
    </div>
       
    <div class="container">
    	<div class="row" style="margin-top:20px;">
        
    		<div class="col-md-12 col-sm-12 col-xs-12">
            	<a href=""><img src="img/logo/1.PNG" alt="" style="float:left"/></a>
                <div id="slogan">Sự lựa chọn hoàn hảo!</div>
            </div>                  
            
        </div>
    </div>
    
    <div style="clear:both"></div>
   
   <?php $mes = "Xin vui lòng đăng nhập"; ?> 
   <nav class="navbar navbar-default" style="margin-top:20px; background-color:#C36; position:sticky; top:0; z-index:99">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand trangchu" href="<?php if(isset($_SESSION['admin_id'])) echo'?mod=home';
			   else echo"?mod=thongbao_dangnhap"; ?>">Trang Chủ</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">                               
                <li style="border-left:1px dotted #FFF;">
                	<a href="<?php if(isset($_SESSION['admin_id'])) echo'?mod=dept';
			   else echo"?mod=thongbao_dangnhap"; ?>">Chủng Loại</a>
                </li>                                
                <li><a href="<?php if(isset($_SESSION['admin_id'])) echo'?mod=cate';
			   			else echo"?mod=thongbao_dangnhap"; ?>">Thể Loại</a>
                </li>
                <li><a href="<?php if(isset($_SESSION['admin_id'])) echo'?mod=product';
			  		 else echo"?mod=thongbao_dangnhap"; ?>">Sản Phẩm</a>
                </li>
              </ul>          
            </div>
          </div>
	</nav>        
    
    <!--Body-->
    <div class="container">
    	<?php $mod=@$_GET['mod'];
			  if($mod=='') $mod='dangnhap';
			  include("module/back/{$mod}.php");
		?>
    </div>        	
    
    
    <!-- Footer -->
    <div id="footer" class="container-fluid">
    <div class="row">
    	 <div class="col-md-4 col-sm-4 col-xs-12">
         	<a href=""><img src="img/logo/1.PNG" alt="" style="margin-top:18px;" /></a>
         </div>   
         
         <div class="foo col-md-3 col-sm-3 col-xs-12">
         	<ul style="list-style:none">
            	<li><a href="">Trang Chủ</a></li>
                <li><a href="">Giới Thiệu</a></li>
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

<div style="margin:140px 0 140px 0; text-align:center; color:#F00;">
<h2>Xin vui lòng đăng nhập để có thể sử dụng các quyền của Admin !</h2><br>
<h3 style="color:#000"><u>Hệ thống sẽ chuyển về trang đăng nhập sau</u> <input type="text" style="width:15px; border:none; text-align:center; color:#900" id="txtboxcd" /> <u>giây nữa!</u></h3>
</div>

 <script language="javascript">
		var number=6;
		function DemNguoc()
		{	
			number-=1;
			if(number!=0)
			{
				document.getElementById("txtboxcd").value=number;
				setTimeout("DemNguoc()",1200);
			}
			else
			{
				window.location.href="?mod=dangnhap";
			}
		}
			DemNguoc();		
 </script>
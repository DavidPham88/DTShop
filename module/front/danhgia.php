<?php
	if(isset($_POST['answer']))
	{
		$id=$_POST['answer'];
		
		//Tang so luot vote cho cau tra loi co id la $id
		$sql="update `dt_answer` set `vote`=`vote`+1 where `id`={$id}";
		mysqli_query($link,$sql);
		
		header("location:?mod=danhgia");
	}
	
	//Lấy câu hỏi đang active
	$sql="select `id`,`content` from `dt_question` where `active`=1";
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
		
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
		
		<?php  
		 //Lấy câu trả lời cho câu hỏi
		$sql="select `id`,`content`,`vote` from `dt_answer` where `question_id`={$r['id']} order by `order` ASC";
		$rs_a=mysqli_query($link,$sql);
		while($r_a=mysqli_fetch_assoc($rs_a)){
		?>

          ['<?=$r_a['content'];?>',     <?=$r_a['vote'];?>],
		  
		<?php } ?>  
		  
        ]);

        var options = {
          title: "Cảm ơn bạn đã bình chọn cho câu hỏi: ' <?=$r['content'];?> '",
		  titleTextStyle:{fontSize:22},
          is3D: true,
		  legend:{position:'bottom',textStyle:{fontSize:18}},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>


    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>

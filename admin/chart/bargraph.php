<?php 
include_once "../db.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>bargraph</title>
	<style type="text/css">
		#chart-container {
			width: 640px;
			height: auto;
		}
	</style>
</head>
<body>
<div id="chart-container">
	<div>
		<canvas id="mycanvas"></canvas>
	</div>
	
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
  <script src="Chart.js"></script>
  <script type="text/javascript">
  

$("document").ready(function(){
$("#monthpic").datepicker({

dateFormat:"yy-mm-dd",
maxDate:0,
changeYear:true,
changeMonth:true,

onClose:function(sdt){
$("#monthpic1").datepicker({
dateFormat:"yy-mm-dd",
maxDate:0,
changeYear:true,
changeMonth:true,
})
$("#monthpic1").datepicker("option","minDate",sdt)
}
})
});

$(document).ready(function(){
$("#btn").click(function() {
var ename=document.getElementById('ename').value;
//alert(ename);
var calander=document.getElementById('monthpic').value;
var calander1=document.getElementById('monthpic1').value;


	$.ajax({

			url:"data.php?ename="+ename+"&date="+calander+"&date1="+calander1,

			method:"GET",

			success:function(data) {
				//alert(data);
				console.log(data);
				//alert(data.dt);
				//alert(data.ho);
				var player=[];
				var score=[];
				for(var i in data){
					player.push("player" + data[i].dt);
					score.push(data[i].ho);

				}

				var ctx = document.getElementById("mycanvas").getContext('2d');
var myChart = new Chart(ctx, {
    type:  'bar',
    data: {
        labels: player,
        datasets: [{
            label: 'tanmay of Votes',
            data:score,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});





			},
			error: function(data) {

				console.log(data);
			}

	});
   });
});

  	
  </script>
  <form class="form-inline" class="class">



<div class="form-group">
          <label class="control-label">Emp Name:</label>
              <?php 
                  $sql = "SELECT name from employee";
                  $result = mysql_query($sql);
                  ?><select class='form-control' id='ename'>
                  <option>Select name</option>
                  <?php while ($row = mysql_fetch_array($result)) {
                  echo "<option   value='" . $row['name'] ."'>" . $row['name'] ."</option>";
                  }
                  ?></select> 
             
             </div>
             
             <div class="form-group">        
             <label class="control-label" for="month">From Date: </label>
                 <input type="text" id="monthpic" name="month"  class="monthPicker form-control" placeholder="From Date"/>
             </div>
      
      
             <div class="form-group">        
             <label class="control-label" for="month">To Date: </label>
                 <input type="text" name="month" id="monthpic1" class="monthPicker1 form-control" placeholder="To Date"/>
             </div>

             <div class="form-group">
                <input type="button" value="Submit" id="btn" class="btn btn-primary"">
             </div>

  </form>
</body>
</html>
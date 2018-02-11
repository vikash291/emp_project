


$(document).ready(function(){
	$.ajax({
		url: "http://crazybooks4u.com/nalax_projects/employee/checkTaskGraphAction.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var date = [];
			var time = [];

			for(var i in data) {
			//alert(data);
				date.push("date " + data[i].id);
				time.push(data[i].time);
			}

			var chartdata = {
				labels: date,
				datasets : [
					     {
						label: 'Employee time',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: time
					     }
				          ]
			               };

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				                        type: 'bar',
				                        data: chartdata
			                              });
		},
		error: function(data) 
		{
			console.log(data);
		}
	});
});
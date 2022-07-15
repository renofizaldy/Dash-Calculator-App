<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Simple Calc App - User Time Spent</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="panel panel-default">
					<div class="panel-heading" style="text-align:center">
						Waktu yang dihabiskan user:<br>
						<strong>Total Waktu (Waktu Login - Waktu Logout)</strong>
					</div>
					<div class="panel-body">
						<canvas id="canvas" height="280" width="600"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script>
		window.onload = function() {
			var ctx = document.getElementById("canvas").getContext("2d");
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: <?php echo $data; ?>,
					datasets: [
						{
							label: "Lama waktu login hingga logout",
							backgroundColor: "#3e95cd",
							data: <?php echo $numb; ?>
						}
					]
				},
				options: {
					responsive: true,
					hover: {
						mode: 'label',
					},
					tooltips: {
						enabled: true,
						callbacks: {
							label: function(tooltipItem, data) {
								var label = <?php echo $time; ?>[tooltipItem.index];
								var a = <?php echo $login; ?>[tooltipItem.index];
								var b = <?php echo $logout; ?>[tooltipItem.index];
								return label+'(Login '+a+' - '+b+')';
							}
						}
					}
				}
			});
		};
	</script>
</body>
</html>
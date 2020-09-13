<!doctype html>
<html>
<head>
	<title>Line Chart</title>
	<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
	<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body>

<div style="width:75%;">
			<canvas id="canvas"></canvas>
		</div>
		<br>
		<br>	
		<button id="iniciarMonitoramento">Iniciar Monitoramento</button>
		<button id="pararMonitoramento">Parar Monitoramento</button>

		<script>

			var dataInY = [];
			var dataInX = [];
			var dataOutY = [];

			var config = {
				type: 'line',
				data: {
					labels: dataInX,
					datasets: [{
						label: 'Qtde de Bytes recebidos',
						backgroundColor: window.chartColors.red,
						borderColor: window.chartColors.red,
						data: dataInY,
						fill: false,
					}, {
						label: 'Qtde de Bytes Enviados',
						fill: false,
						backgroundColor: window.chartColors.blue,
						borderColor: window.chartColors.blue,
						data: dataOutY,
					}]
				},
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Quantidade de bytes transmitidos/recebidos na placa de rede Wi-Fi'
					},
					tooltips: {
						mode: 'index',
						intersect: false,
					},
					hover: {
						mode: 'nearest',
						intersect: true
					},
					scales: {
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Data/Hora'
							}
						}],
						yAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Qtde de bytes'
							}
						}]
					}
				}
			};

			window.onload = function() {
				var ctx = document.getElementById('canvas').getContext('2d');
				window.myLine = new Chart(ctx, config);
			};

			var timer;
			document.getElementById('iniciarMonitoramento').addEventListener('click', function() {
				timer = setInterval(ajaxCall,2000);
			});

			
			document.getElementById('pararMonitoramento').addEventListener('click', function() {
				clearInterval(timer);

			});

			var colorNames = Object.keys(window.chartColors);
			var norma = 0 ;
			var normaOut = 0;
			function ajaxCall(){
				$.ajax({
					url:"snmpGet.php",
					type: "POST",
					data: "",
					datatype: "html"
				}).done(function(resposta){
					if(norma == 0){
						dataInY.push(norma);
					}else{
						dataInY.push(resposta-norma);
					}
					norma = resposta;
					var d = new Date();
					dataInX.push(d.toLocaleTimeString());
					window.myLine.update();
				});

				$.ajax({
					url:"snmpGetOut.php",
					type: "POST",
					data: "",
					datatype: "html"
				}).done(function(respostaOut){
					if(normaOut == 0){
						dataOutY.push(normaOut);
					}else{
						dataOutY.push(respostaOut-normaOut);
					}
					normaOut = respostaOut;
					window.myLine.update();
				});
			}



		</script>

	

		<a href="udpGerenciamento.php"><button >UDP</button></a >

</body>

</html>

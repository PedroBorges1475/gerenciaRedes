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
	<div id="canvas-holder" style="width:40%">
		<canvas id="chart-area"></canvas>
	</div>
	<button id="atualizarDados">Atualizar</button>
	<script>

        var dataIn = 1;
		var	dataNo = 1;
		var dataErro = 1;

		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};

		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						dataIn,
						dataNo,
						dataErro,
					],
					backgroundColor: [
						window.chartColors.red,
						window.chartColors.yellow,
						window.chartColors.green,
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Erro',
					'Sem Porta Disponivel',
					'Recebidos'
				]
			},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

        var novaData= [];

        function ajaxCall(){    
            $.ajax({
                url:"snmpGetUdpIn.php",
                type: "POST",
                data: "",
                datatype: "html"
            }).done(function(respostaIn){
				novaData[2] = respostaIn;
                window.myDoughnut.update();
            });

            $.ajax({
                url:"snmpGetUdpNoPort.php",
                type: "POST",
                data: "",
                datatype: "html"
            }).done(function(respostaNo){
				novaData[1] = respostaNo;
				window.myDoughnut.update();
            });

			$.ajax({
                url:"snmpGetUdpInErros.php",
                type: "POST",
                data: "",
                datatype: "html"
            }).done(function(respostaError){
				novaData[0] = respostaError;
				window.myDoughnut.update();
            });

            config.data.dataset.data = novaData;

        }

        document.getElementById('atualizarDados').addEventListener('click', function() {
				 ajaxCall();
                 window.myPie.update();
			});




		var colorNames = Object.keys(window.chartColors);


	</script>
    <a href="index.php"><button >Voltar</button></a >
</body>

</html>



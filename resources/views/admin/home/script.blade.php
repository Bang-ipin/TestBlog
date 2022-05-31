		@php
			use App\Libraries\Applib;
			$tahun = date('Y');
			for($bln=1; $bln <=12; $bln++){
				$total = Applib::statistika($bln,$tahun);
				$data[$bln] = $total;
			}

			$visit = '';
			for ($bulan=1; $bulan <=12; $bulan++) {
				$visit .= $data[$bulan];
				if($bulan < 12) $visit .= ',';
			}
			
		@endphp
		
		<script>
			
			var MONTHS = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
			var color = Chart.helpers.color;
			var barChartData = {
				labels: MONTHS,
				datasets: [{
					label: 'Kunjungan',
					backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
					borderColor: window.chartColors.blue,
					borderWidth: 1,
					data: [<?php if(isset($visit)){echo $visit;}?>]  
				}]
			};

			window.onload = function() {
				var ctx = document.getElementById("site_statistics_bulanan").getContext("2d");
				window.myBar = new Chart(ctx, {
					type: 'line',
					data: barChartData,
					options: {
						responsive: true,
						width:300,
						height:300,
						legend: {
							position: 'top',
						},
						title: {
							display: true,
							text: 'GRAFIK VISITOR',
							fontSize:'12',
							fontColor:'blue',
							fontfamily:'sans-serif'
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
									fontColor:'black',
									fontSize:'12',
									fontFamily:'Times-new-roman',
									labelString: 'Tahun {{ $tahun }}',
								}
							}],
							yAxes: [{
								display: true,
								scaleLabel: {
									display: true,
									fontColor:'black',
									fontSize:'16',
									fontFamily:'Times-new-roman',
									labelString: 'Jumlah Visitor',
								}
							}]
						}
					}
				});

			};
		</script>
		<script type="text/javascript">
			$(function () {
				var chart;
				$(document).ready(function () {
					Highcharts.setOptions({
						colors: ['rgb(128, 133, 233)']
					});
					chart = new Highcharts.Chart({
						chart: {
							renderTo: 'container',
							type: 'column',
							margin: [50, 30, 80, 60]
						},
						title: {
							text: "Visits Today: {{ date('d-m-Y') }}"
						},
						xAxis: {
							categories: [
							<?php
							$i = 1;
							$count = count($chart_data_today);
							foreach ($chart_data_today as $data) {
								if ($i == $count) {
									echo "'" . $data->hour . "'";
								} else {
									echo "'" . $data->hour . "',";
								}
								$i++;
							}
							?>
							],
							labels: {
								rotation: -45,
								align: 'right',
								style: {
									fontSize: '9px',
									fontFamily: 'Tahoma, Verdana, sans-serif'
								}
							}
						},
						yAxis: {
							min: 0,
							title: {
								text: 'Visits'
							}
						},
						legend: {
							enabled: false
						},
						tooltip: {
							formatter: function () {
								return '<b>' + this.x + '</b><br/>' +
										'Visits: ' + Highcharts.numberFormat(this.y, 0);
							}
						},
						series: [{
								name: 'Visits',
								data: [
								<?php
								$i = 1;
								$count = count($chart_data_today);
								foreach ($chart_data_today as $data) {
									if ($i == $count) {
										echo $data->visits;
									} else {
										echo $data->visits . ",";
									}
									$i++;
								}
								?>
								],
								dataLabels: {
									enabled: false,
									rotation: 0,
									color: '#F07E01',
									align: 'right',
									x: -3,
									y: 20,
									formatter: function () {
										return this.y;
									},
									style: {
										fontSize: '11px',
										fontFamily: 'Verdana, sans-serif'
									}
								},
								pointWidth: 20
							}]
					});
				});
			});
		</script>
		<script type="text/javascript">
			$("#chart_submit_btn").click(function (e) {
				$('#month_year_container').html('');
				var formdata = $('#select_month_year').serialize();
				$.ajax({
					url: "{{ url('haloadmin/home/getchart') }}", 
					type: "POST", 
					data: { 
						'data': formdata, 
						'_token': '{{ csrf_token() }}' 
					},
					dataType: "html", 
					success: function (response) {
						if (response.toLowerCase().indexOf("no data found") >= 0) {
							$('#month_year_container').html(response);
						} else {
							var tsv = response.split(/n/g);
							var count = tsv.length - 1;
							var cats_val = new Array();
							var visits_val = new Array();
							for (i = 0; i < count; i++) {
								var line = tsv[i].split(/t/);
								var line_data = line.toString().split(",");
								var date = line_data[0];
								var visits = line_data[1];
								cats_val[i] = date;
								visits_val[i] = parseInt(visits);
							}
							var _categories = cats_val;
							var _data = visits_val;
							var chart;
							$(document).ready(function () {
								Highcharts.setOptions({
									colors: ['rgb(128, 133, 233)']
								});
								chart = new Highcharts.Chart({
									chart: {
										renderTo: 'month_year_container',
										type: 'column',
										margin: [50, 30, 80, 60]
									},
									title: {
										text: 'Visits'
									},
									xAxis: {
										categories: _categories,
										labels: {
											rotation: -45,
											align: 'right',
											style: {
												fontSize: '9px',
												fontFamily: 'Tahoma, Verdana, sans-serif'
											}
										}
									},
									yAxis: {
										min: 0,
										title: {
											text: 'Visits'
										}
									},
									legend: {
										enabled: false
									},
									tooltip: {
										formatter: function () {
											return '<b>' + this.x + '</b><br/>' +
													'Visits: ' + Highcharts.numberFormat(this.y, 0);
										}
									},
									series: [{
											name: 'Visits',
											data: _data,
											dataLabels: {
												enabled: false,
												rotation: 0,
												color: '#F07E01',
												align: 'right',
												x: -3,
												y: 20,
												formatter: function () {
													return this.y;
												},
												style: {
													fontSize: '11px',
													fontFamily: 'Verdana, sans-serif'
												}
											},
											pointWidth: 20
										}]
								});
							});
						}
					}
				});
			});
		</script>
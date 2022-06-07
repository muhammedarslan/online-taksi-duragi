$(document).ready(function() 
{	

	if ( $('#page_id').val() == 'home' || $('#page_id').val() == 'profile'  ) {

		setTimeout(function(){

			$('#chart_l_text').text('Grafikler işleniyor...');

			setTimeout(function(){

				$.post('/AjaxCall/LoadHomeChart',{'data':'data'},function(data){

					const json = JSON.parse(data);
					let types = 'line';

			if ( $('#page_id').val() == 'home' ) {
				types = 'line';
			} else {
				types = 'bar';
			}

					$('#home_cart').html('<canvas id="bar-chart"></canvas>');

					new Chart(document.getElementById("bar-chart"), {
						type: types,
						data: {
							labels: json.labels,
							datasets: json.datasets
						},
						options: {
							responsive: true,
							title: {
								display: true,
								text: json.ChartTitle
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
										display: false
									}
								}],
								yAxes: [{
									display: true,
									scaleLabel: {
										display: false
									}
								}]
							}
						}
					});

				});


			},500);


		},500);
	}

});
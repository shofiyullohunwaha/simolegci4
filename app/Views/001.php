<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Beranda</h2>
				<h5 class="text-white op-7 mb-2">Dashboard Informasi</h5>
			</div>
		</div>
	</div>
</div>
<div class="page-inner mt--5">
	<div class="row mt--2">
		<?php
			$terjemahlatar = ["skew-shadow","bubble-shadow","curves-shadow"];
			if(is_array($datax)){
				if(count($datax)>0){
					foreach($datax as $x){
						$jmlsistem = number_format($x->sistem, "0", ",", ".");
						$jmllevel = number_format($x->level, "0", ",", ".");
						$jmlform = number_format($x->form, "0", ",", ".");
						$jmlakun = number_format($x->akun, "0", ",", ".");
						$jmlhak = number_format($x->hakakses, "0", ",", ".");
						$jmllog = number_format($x->log, "0", ",", ".");
						echo '
						<div class="col-md-2" style="cursor: pointer;">
							<div class="card card-dark bg-secondary-gradient">
								<div class="card-body '.$terjemahlatar[rand(0,2)].'">
									<h1>'.$jmlsistem.'</h1>
									<h5 class="op-8">Sistem</h5>
								</div>
							</div>
						</div>
						<div class="col-md-2" style="cursor: pointer;">
							<div class="card card-dark bg-secondary-gradient">
								<div class="card-body '.$terjemahlatar[rand(0,2)].'">
									<h1>'.$jmllevel.'</h1>
									<h5 class="op-8">Level</h5>
								</div>
							</div>
						</div>
						<div class="col-md-2" style="cursor: pointer;">
							<div class="card card-dark bg-secondary-gradient">
								<div class="card-body '.$terjemahlatar[rand(0,2)].'">
									<h1>'.$jmlform.'</h1>
									<h5 class="op-8">Form</h5>
								</div>
							</div>
						</div>
						<div class="col-md-2" style="cursor: pointer;">
							<div class="card card-dark bg-secondary-gradient">
								<div class="card-body '.$terjemahlatar[rand(0,2)].'">
									<h1>'.$jmlakun.'</h1>
									<h5 class="op-8">Akun</h5>
								</div>
							</div>
						</div>
						<div class="col-md-2" style="cursor: pointer;">
							<div class="card card-dark bg-secondary-gradient">
								<div class="card-body '.$terjemahlatar[rand(0,2)].'">
									<h1>'.$jmlhak.'</h1>
									<h5 class="op-8">Hak Akses</h5>
								</div>
							</div>
						</div>
						<div class="col-md-2" style="cursor: pointer;">
							<div class="card card-dark bg-secondary-gradient">
								<div class="card-body '.$terjemahlatar[rand(0,2)].'">
									<h1>'.$jmllog.'</h1>
									<h5 class="op-8">Log</h5>
								</div>
							</div>
						</div>';
					}
				}
			}
		?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body" id="blokgrafik"></div>
			</div>
		</div>
	</div>
</div>
<script>
	$("#liberanda").addClass("active");
	grafik();
	function grafik(){
		Highcharts.chart('blokgrafik', {
			chart: {type: 'areaspline'},
			title: {text: 'Aktifitas Log Bulanan'},
			xAxis: {
				categories: [
					<?php
						if(is_array($grafikx)){
							if(count($grafikx)>0){
								foreach($grafikx as $j){
									echo "'".$j->tgl."',";
								}
							}
						}
					?>
				]
			},
			yAxis: {
				title: {
					text: 'Jumlah Aktifitas'
				}
			},
			tooltip: {
				shared: true,
				valueSuffix: ' Aktifitas'
			},
			credits: {
				enabled: false
			},
			plotOptions: {
				areaspline: {
					fillOpacity: 0.5
				}
			},
			series: [{
				name: 'Aktifitas Log',
				data: [
					<?php
						if(is_array($grafikx)){
							if(count($grafikx)>0){
								foreach($grafikx as $j){
									echo $j->jumlah.",";
								}
							}
						}
					?>
				]
			}]
		});
	}
</script>

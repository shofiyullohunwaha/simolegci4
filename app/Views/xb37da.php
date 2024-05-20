<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Beranda</h2>
				<h5 class="text-white op-7 mb-2">Halaman Dashboard Sistem</h5>
			</div>
		</div>
	</div>
</div>
<div class="page-inner mt--5">
	<div class="row mt--2">
	<?php
		$terjemahlatar = ["skew-shadow","bubble-shadow","curves-shadow"];
		if(is_array($dtlogin)){
			if(count($dtlogin)>0){
				foreach($dtlogin as $x){
					$idsistem = $x->id_sistem;
					$latar = $terjemahlatar[rand(0,2)];
					$sistem = $x->sistem;
					$desk = $x->deskripsi;
					$icon = $x->icon;
					echo '
					<div class="col-md-4" style="cursor: pointer;" data-link="'.BASEURLKU.$idsistem.'" onclick="ke(this)">
						<div class="card card-dark bg-secondary-gradient">
							<div class="card-body '.$latar.'">
								<h1><i class="'.$icon.'"></i>&nbsp&nbsp'.$sistem.'</h1>
								<h5 class="op-8">'.$desk.'</h5>
							</div>
						</div>
					</div>';
				}
			}
		}
	?>
	</div>
</div>
<script>
	function ke(el){
		let link = $(el).data("link");
		window.location = link;
	}
</script>
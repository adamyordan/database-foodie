<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">
			<div class="well">

			<!-- REGION FOR CHEF  -->
			<?php if ($data['user']->job == "Chef" || $data['user']->job == "Manager"): ?>

				<div class="row">
					<div class="col-xs-10">
						<h5>Menu</h5>				
					</div>
					<div class="col-xs-2">
						<button class="btn btn-sm btn-primary" id="btn-refresh" 
							onclick='refresh("menu")'> refresh	</button>
					</div>
				</div>
				<table class="table table-mini">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Deskripsi</th>
							<th>Harga</th>
							<th>Jumlah tersedia</th>
							<th>Kategori</th>
						</tr>
					</thead>
					<tbody id="data_row_container"></tbody> 
				</table>
			<!-- ENDREGION  -->

			<!-- REGION FOR KASIR  -->
			<?php elseif ($data['user']->job == "Kasir"): ?>

				<div class="row">
					<div class="col-xs-10">
						<h5>Pemesanan</h5>				
					</div>
					<div class="col-xs-2">
						<button class="btn btn-sm btn-primary" id="btn-refresh" 
							onclick='refresh("order")'> refresh	</button>
					</div>
				</div>
				<table class="table table-mini">
					<thead>
						<tr>
							<th>#</th>
							<th>Nomor Nota</th>
							<th>Waktu Bayar</th>
							<th>Total</th>
							<th>Kasir</th>
							<th>Mode Bayar</th>
						</tr>
					</thead>
					<tbody id="data_row_container"></tbody> 
				</table>
			<!-- ENDREGION  -->

			<!-- REGION FOR STAF  -->
			<?php elseif ($data['user']->job == "Staf"): ?>

				<div class="row">
					<div class="col-xs-10">
						<h5>Pembelian</h5>				
					</div>
					<div class="col-xs-2">
						<button class="btn btn-sm btn-primary" id="btn-refresh" 
							onclick='refresh("purchase")'> refresh	</button>
					</div>
				</div>
				<table class="table table-mini">
					<thead>
						<tr>
							<th>#</th>
							<th>Nomor</th>
							<th>Waktu</th>
							<th>Supplier</th>
							<th>Staf</th>
						</tr>
					</thead>
					<tbody id="data_row_container"></tbody> 
				</table>

			<?php endif; ?>
			<!-- ENDREGION  -->

			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="resources/js/dashboard-home.js"></script>
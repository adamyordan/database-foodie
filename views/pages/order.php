<script type="text/javascript" src="resources/js/order.js"></script>
<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<h5>List Pemesanan</h5>
				<div>
					<div class="col-md-1 fui-calendar datepickerimage calendar-off">
					</div>

					<div class="col-md-3">
						<span class="dateValue datepickerimage calendar-off"><?php echo date('d/m/Y'); ?></span>
					</div>

					<div class="col-md-2 fui-list-numbered">
						<span>Sort By</span>
					</div>
						
					<select class="group selection col-md-3">
					  	<option value="nomornota">Nomor Nota</option>
					  	<option value="waktupesan">Waktu Pesan</option>
					  	<option value="emailkasir">Kasir</option>
					</select>

					<select class="sort selection col-md-2">
						<option value="desc">Descending</option>
					  	<option value="asc">Ascending</option>
					</select>
				</div>	

				<div class ="datepicker"></div>

				<div class = 'table-div' >
					<?php $count = 1; $page = 1;?>
					<?php if (sizeof ($data['orders']) > 0) : ?>	
					<?php foreach ($data['orders'] as $order ) : ?>
					<?php if ($count == 1 || $count % 15 == 1) : ?>	
					<table class="table table-mini page <?php echo $count == 1 ? "page-active" : "" ?> page<?php echo $page++;?>">
						<thead>
							<tr>
								<th>#</th>
								<th>Nomor Nota</th>
								<th>Waktu Pesan</th>
								<th>Waktu Bayar</th>
								<th>Total</th>
								<th>Kasir</th>
								<th>Mode Bayar</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
					<?php endif; ?>
							<tr>
								<td><?php echo $count; ?></td> 
								<td><?php echo $order->nomornota; ?></td>
								<td><?php echo $order->waktupesan; ?></td>
								<td><?php echo $order->waktubayar; ?></td>
								<td><?php echo $order->total; ?></td>
								<td><?php echo $order->emailkasir; ?></td>
								<td><?php echo $order->mode; ?></td>
								<td><a data-toggle="modal" data-target="#myModal" class="detail" onclick="showDetail()">Lihat</a></td>
							</tr>
					<?php if ($count++ % 15 == 0 || $count > sizeof($data['orders']) ) : ?>
						</tbody>
					</table>
					<?php endif; ?>
					<?php endforeach; ?>
				<?php $count = 1; $page = 1;?>
				<?php foreach ($data['orders'] as $order ) : ?>
				<?php if ($count == 1 || $count % 15 == 1) : ?>	
				<table class="table table-mini page <?php echo $count == 1 ? "page-active" : "" ?> page<?php echo $page++;?>">
					<thead>
						<tr>
							<th>#</th>
							<th>Nomor Nota</th>
							<th>Waktu Pesan</th>
							<th>Waktu Bayar</th>
							<th>Total</th>
							<th>Kasir</th>
							<th>Mode Bayar</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
				<?php endif; ?>
						<tr>
							<td><?php echo $count; ?></td> 
							<td><?php echo $order->nomornota; ?></td>
							<td><?php echo $order->waktupesan; ?></td>
							<td><?php echo $order->waktubayar; ?></td>
							<td><?php echo $order->total; ?></td>
							<td><?php echo $order->emailkasir; ?></td>
							<td><?php echo $order->mode; ?></td>
							<td><a data-toggle="modal" data-target="#myModal" class="detail">Lihat</a></td>
						</tr>
				<?php if ($count++ % 15 == 0 || $count > sizeof($data['orders']) ) : ?>
					</tbody>
				</table>
				<?php endif; ?>
			<?php endforeach; ?>
			<div class="pagination">
				<?php for ($a = 1; $a < sizeof($data['orders']) ; $a += 15) : ?>
				<li <?php echo $a == 1 ? 'class="active"':''; ?>><a class="pageNum"><?php echo floor (($a/15) + 1); ?></a></li>
    			<?php endfor; ?>
			</div>
			</div>
		</div>

			<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-lg">

			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">&times;</span>
			        </button>
			        <h4 class="modal-title" id="myModalLabel">Detail Pemesanan</h4>
			      </div>

			      <div class="modal-body">
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
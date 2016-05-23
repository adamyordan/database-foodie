<script type="text/javascript" src="resources/js/purchase.js"></script>
<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<h5>List Pembelian Bahan</h5>
				<div>
					<div class="col-md-3">
						<div class="col-md-1 fui-calendar datepickerimage calendar-off">
						</div>
						
						<div class="col-md-2">
							<span class="dateValue"><?php echo date('m/d/Y'); ?></span>
						</div>
					</div>
					
					<select class="group selection col-md-3">
					  	<option value="nomornota">Nomor Nota</option>
					  	<option value="waktu">Waktu</option>
					  	<option value="namasupplier">Supplier</option>
					  	<option value="emailstaf">Staf</option>
					</select>

					<select class="sort selection col-md-2">
						<option value="desc">Descending</option>
					  	<option value="asc">Ascending</option>
					</select>
				</div>	
				
				<div class ="datepicker"></div>
				
				<div class="table-div">
					
					<?php $count = 1; $page = 1; ?>
					<?php foreach ($data['purchases'] as $purchase) : ?>
					<?php if ($count % 15 == 1) : ?>
					
					<table class="table table-mini page<?php if ($count == 1) echo " page-active";?> page<?php echo $page++; ?>">
						<thead>
							<tr>
								<th>#</th>
								<th>Nomor Nota</th>
								<th>Waktu</th>
								<th>Supplier</th>
								<th>Staf</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
					<?php endif; ?>
							<tr>
								<td><?=$count?></td>
								<td><?=$purchase->no?></td>
								<td><?=$purchase->time?></td>
								<td><?=$purchase->supplier?></td>
								<td><?=$purchase->staff?></td>
								<td><a data-toggle="modal" data-target="#myModal" class="detail">Lihat</a></td>
							</tr>
					<?php if ($count++ % 15 == 0 || $count > sizeof($data['purchases'])) : ?>
						</tbody>
					</table>
					<?php endif; ?>
					<?php endforeach; ?>
					<div class="pagination">
						<?php for ($i = 1; $i < $page; $i++) : ?>
							<li <?php if ($i == 1) echo 'class="active"'?>><a class="pageNum"><?=$i?></a></li>
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
			        <h4 class="modal-title" id="myModalLabel">Detail Pembelian</h4>
			      </div>

			      <div class="modal-body">
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
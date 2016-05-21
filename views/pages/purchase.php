<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">
				<h5>Pembelian Baru</h5>
				<div class="form-horizontal">
					<div class="form-group" id="formgroup-no_nota">
						<label for="no_nota" class="col-sm-2 control-label">Nomor Nota</label>
						<div class="col-xs-12 col-md-4">
							<input type="text" class="form-control" name="no_nota" placeholder="Nomor Nota" maxlength="6">
						</div>
					</div>
					<div class="form-group">
						<label for="supplier" class="col-sm-2 control-label">Supplier</label>
						<div class="col-sm-10 col-md-4">
							<select class="selected-2 form-control mini" name="supplier">
								<?php foreach($data['suppliers'] as $supplier):
									echo "<option value='$supplier->name'> $supplier->name </option>"; 
									endforeach;
								?>
							</select>
						</div>
					</div>
					
					<table class="table table-mini">
						<thead>
							<tr>
								<td>Nama Bahan</td>
								<td>Harga Satuan</td>
								<td>Satuan</td>
								<td>Jumlah</td>
								<td>Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody id="purchase_row_container"></tbody>
					</table>
					<button id="btn_more" class="btn btn-info btn-sm">Add More</button>

					<div class="form-group">
						<div class="col-sm-offset-10">
							<button class="btn btn-primary" id="btn_purchase2">Purchase</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>



<script type="text/javascript">
	var num_rows = 0; 
	for (var i = 0; i < 1; i++) {
		insert_row(num_rows);
		num_rows += 1;		
	}

	function insert_row(i) {		
		$(`

			<tr id="row_bahan_` + i + `">
				<td>
					<select class="selected-2 form-control mini" name="mname[]">
						<?php foreach($data['materials'] as $material): 
							echo "<option value='$material->name'> $material->name </option>";
						endforeach; ?>
					</select>
				</td>
				<td><input id="row_hargasatuan_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mprice[]"></td>
				<td>
					<select class="selected-2 form-control mini" name="munit[]">
						<?php foreach($data['units'] as $unit): 
							echo "<option value='$unit'> $unit </option>";
						endforeach; ?>
					</select>
				</td>
				<td><input id="row_jumlah_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mqty[]"></td>
				<td><input id="row_total_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini nodisable" disabled name="mtotal[]"></td>
				<td>
					<button onclick="delete_row(` + i + `)"
					 type="button" class="btn btn-danger btn-xs">Delete</button>
				</td>
			</tr>
	
			`).hide().appendTo("#purchase_row_container").fadeIn();

		$(".selected-2").select2();		
	}


	$('#btn_purchase').click(function() {
        $.post(
            "?p=api_purchase",
            {
            	"no_nota" : $("[name='no_nota']").val(),
            	"supplier" : $("[name='supplier']").val(),
            	"staf" : "adam",
            	"mname" : $("[name='mname[]']").map(function() {return $(this).val();}).get(),
            	"mprice" : $("[name='mprice[]']").map(function() {return $(this).val();}).get(),
            	"munit" : $("[name='munit[]']").map(function() {return $(this).val();}).get(),
            	"mqty" : $("[name='mqty[]']").map(function() {return $(this).val();}).get(),
            	"mtotal" : $("[name='mtotal[]']").map(function() {return $(this).val();}).get(),
            },
            function(data) {
                alert(data.status);
            },
            "json"
        );
	})

	$("#btn_more").click(function() {
		insert_row(num_rows);
		num_rows += 1;
		$("[name='mname[]']").change(function() {updateDangerRow();})
		updateDangerRow();
	});

	$("[name=no_nota]").change(function() {
		checkNoAvailability();
	})

	$("#btn_purchase2").click(function() {
		if (!$("#formgroup-no_nota").hasClass("has-success")) {
			swal('Error', 'Please input unique note number', 'error');
		} else if (getDuplicate().length != 0) {
			swal('Error', 'Please delete duplicate item name', 'error');
		} else {
			swal({
				title: 'Confirm Purchase',
				text: 'Confirm this purchase',
				type: 'question',
				showCancelButton: true,
			}).then(function(isConfirm) {
				if (isConfirm) {
					doPurchase();
				}
			});
		}
	});

	function delete_row(i) {
		$('#row_bahan_' + i).fadeOut(300, function() { $(this).remove(); });
		updateDangerRow();
	}

	function calculate_total(i) {
		$('#row_total_' + i).val($('#row_hargasatuan_' + i).val() * $('#row_jumlah_' + i).val());
	}

	function getDuplicate() {
		var arr = [];
		var mnames = $("[name='mname[]']").map(function() {return $(this).val();}).get()
		for(var i = 0; i < mnames.length; i++) {
			if (arr.contains(i)) continue;
			for(var j = i+1; j < mnames.length; j++) {
				if (arr.contains(j)) continue;
				if (mnames[i] == mnames[j]) {
					if (!arr.contains(i)) arr.push(i);
					arr.push(j);
				} 
			}
		}
		return arr;
	}

	function updateDangerRow(){
		var dupes = getDuplicate();
		var $rows = $("tr[id^=row_bahan_]");
		for(var i = 0; i < num_rows; i++) {
			if (dupes.contains(i)) {
				$rows.eq(i).addClass('has-error').addClass('danger');
			} else {
				$rows.eq(i).removeClass('has-error').removeClass('danger');
			}
		}
	}

	function checkNoAvailability() {
        $.post(
            "?p=api_purchase_checkno",
            {
            	"no" : $("[name=no_nota]").val(),
            },
            function(data) {
            	if(data.status == "ok") {
            		$("#formgroup-no_nota").removeClass("has-error");
            		$("#formgroup-no_nota").addClass("has-success");
            	} else {
            		$("#formgroup-no_nota").removeClass("has-success");
            		$("#formgroup-no_nota").addClass("has-error");
            	}
            },
            "json"
        );
	}

	function doPurchase() {
        $.post(
            "?p=api_purchase",
            {
            	"no_nota"  : $("[name='no_nota']").val(),
            	"supplier" : $("[name='supplier']").val(),
            	"staf"     : "adam",
            	"mname"    : $("[name='mname[]']").map(function() {return $(this).val();}).get(),
            	"mprice"   : $("[name='mprice[]']").map(function() {return $(this).val();}).get(),
            	"munit"    : $("[name='munit[]']").map(function() {return $(this).val();}).get(),
            	"mqty"     : $("[name='mqty[]']").map(function() {return $(this).val();}).get(),
            	"mtotal"   : $("[name='mtotal[]']").map(function() {return $(this).val();}).get(),
            },
            function(data) {
            	if(data.status == "ok") {
					swal({
						title: 'Success',
						text : 'this purchase has been saved',
						type : 'success',					
					});
            	} else {
					swal({
						title: 'Error',
						text : 'something wrong: ' + data.status,
						type : 'error',					
					});
            	}
            },
            "json"
        );

	}

</script>

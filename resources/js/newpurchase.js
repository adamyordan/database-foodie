var num_rows = 0; 
for (var i = 0; i < 1; i++) {
	insert_row(num_rows);
	num_rows += 1;		
}

function insert_row(i) {
	$(getRowTemplate(i)).hide().appendTo("#purchase_row_container").fadeIn();
	$(".selected-2").select2();		
}

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
	$('#row_bahan_' + i).fadeOut(300, function() { 
		$(this).remove(); 
		updateDangerRow();
	});
}

function calculate_total(i) {
	$('#row_total_' + i).val($('#row_hargasatuan_' + i).val() * $('#row_jumlah_' + i).val());

	var grandtotal = 0;
	var subtotals = $("[name='mtotal[]']").map(function() {return $(this).val();}).get()
	subtotals.forEach(function (st) {grandtotal += parseInt(st);});
	$('#grandtotal').text(grandtotal);
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
				}).then(function(isConfirm) {
					window.location.href = "?p=purchase";
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
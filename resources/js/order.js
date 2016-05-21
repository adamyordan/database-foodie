$(document).ready (function () {
	$('.pageNum').click(function (){
		$num = $(this).html();
		$('.page-active').removeClass('page-active');
		$('.active').removeClass('active');
		$('.page'+$num).addClass('page-active');
		$(this).parent().addClass('active');
	});

	$(".detail").click(function(){
		$nomornota = $(this).parent().parent().children().eq(1).html();
        $waktupesan = $(this).parent().parent().children().eq(2).html();
        $waktubayar = $(this).parent().parent().children().eq(3).html();
        $total = $(this).parent().parent().children().eq(4).html();
        $kasir = $(this).parent().parent().children().eq(5).html();
        $mode = $(this).parent().parent().children().eq(6).html();

		alert ($nomornota);
		 $.post(
            "?p=detail",
            {"nomornota" : $nomornota},
            function(data) {
                if (data.status == "ok") {
                   // alert(data.detail[0].namamenu)
                	getDetail($nomornota,$waktupesan,$waktubayar,$kasir,$total,$mode,data);
                } else {
                   alert('gagal');
                }
            },
            "json"
        );
    });

	$(".datepicker").datepicker({

		onSelect: function(dateText, inst) {
      			$(".dateValue").html(dateText);
      			$(".datepicker").hide();
    	}
	}).hide().css("position","absolute");

    $(".datepickerimage").click(function() {
    	if ($(this).hasClass("calendar-off")) {
    		$(".calendar-off").addClass('calendar-on');
    		$(".calendar-on").removeClass('calendar-off');
    		$(".datepicker").show();
    	} else {
    		$(".calendar-on").addClass('calendar-off');
    		$(".calendar-off").removeClass('calendar-on');
    		$(".datepicker").hide();
    	}
       

    });

	$('.sort').select2({
		placeholder: "Sort By",
  		allowClear: true
	});

	$('.group').select2({
		placeholder: "Group By",
		allowClear: true
	});

});

function getDetail ($nomornota,$waktupesan,$waktubayar,$kasir,$total,$mode,$data) {
    $tbody = generateTable($data);
    $('.modal-body').html (
        '<div class="row">' +
            '<div class="col-md-6">' +
                '<p>Nomor Nota : '+$nomornota+'</p>' +
                '<p>Waktu Pesan :'+$waktupesan+' </p>' +
                '<p>Waktu Bayar : '+$waktubayar+'</p>' +
            '</div>' +
            '<div class="col-md-6">' +
                '<p>Kasir :'+$kasir+' </p>' +
                '<p>Mode Pemabayaran : '+$mode+'</p>' +
                '<p>Total : '+$total+'</p>' +
                '</div>' +
            '</div>'+
        '<div>' +

        '<div class="row">'+
            '<div class="col-md-12">' +
                '<table class="table table-bordered table-striped table-mini">'+
                     '<thead>'+
                        '<tr>'+
                            '<td>#</td>'+
                            '<td>Nama Menu</td>'+
                            '<td>Harga</td>'+
                            '<td>Jumlah</td>'+
                            '<td>Total</td>'+
                         '</tr>'+
                    '</thead>' +
                    '<tbody>' +  
                        $tbody + 
                    '</tbody>' +
               '</table>'+
            '</div>' +
        '</div>' 
    );
}

function generateTable ($data){
    $temp = '';

    alert($data.detail[0].namamenu);
    for ($a =0; $a < $data.detail.length; $a++ ) {
        $temp += '<tr> <td>'+ ($a+1) +'</td> <td>'+$data.detail[$a].namamenu+'</td> <td>'+$data.detail[$a].harga+'</td> <td>'+$data.detail[$a].jumlah+'</td> <td>'+($data.detail[$a].harga*$data.detail[$a].jumlah)+'</td> </tr>';
    }

    return $temp;
}

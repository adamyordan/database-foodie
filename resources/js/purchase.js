$(document).ready (function () {
	
	$('body').on('click','.pageNum',function(){
        $num = $(this).html();
        $('.page-active').removeClass('page-active');
        $('.active').removeClass('active');
        $('.page'+$num).addClass('page-active');
        $(this).parent().addClass('active');
    });

    $('body').on('click','.detail',function(){
        $no = $(this).parent().parent().children().eq(1).html();
        $time = $(this).parent().parent().children().eq(2).html();
        $supplier = $(this).parent().parent().children().eq(3).html();
        $staff = $(this).parent().parent().children().eq(4).html();
		
        $.post(
            "?p=purchaseDetails",
            {"notapembelian" : $no},
            function(data) {
                if (data.status == "ok") {
                    getDetail($no,$time,$supplier,$staff,data);
                } else {
                   $('.modal-body').html('');
                }
            },
			"json"
        );
    });
	
	 $(".selection").change(sortData);
	
	$(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
		onSelect: function(dateText, inst) {
      			$(".dateValue").html(dateText);
      			$(".datepicker").hide();
				
				sortData();
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

function sortData()
{
	$sort1 = $('.group').val();
	$sort2 = $('.sort').val();
	$dateVal = $('.dateValue').html().split("/");
	$.post(
		"?p=purchaseSort",
		{"sort1" : $sort1,"sort2" : $sort2, "date" : $dateVal},
		function(data) {
			if (data.status == "ok") {
				sortResult(data);
			} else {
				$('.table-div').html('<h4>Hari Ini Tidak Ada Pembelian :(</h4>');
			}
		},
		"json"
	);
}

function getDetail ($no,$time,$supplier,$staff,$data) {
    $tbody = generateTable($data.detail.ingredientpurchases);
	$total = $data.detail.total;
    $('.modal-body').html (
        '<div class="row">' +
            '<div class="col-md-6">' +
                '<p>Nomor Nota : '+$no+'</p>' +
                '<p>Waktu      : '+$time+' </p>' +
                '<p>Supplier   : '+$supplier+'</p>' +
            '</div>' +
            '<div class="col-md-6">' +
                '<p>Staf  : '+$staff+' </p>' +
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
                            '<td>Nama Bahan Baku</td>'+
                            '<td>Jumlah</td>'+
                            '<td>Satuan</td>'+
                            '<td>Harga Satuan</td>'+
                            '<td>Sub-Total</td>'+
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

function sortResult($data) {
    $('.table-div').html('');
    $temp = '';
    $count = 1; $page = 1;
    for ($a = 0; $a < $data.detail.length ; $a++) {
        if ($count == 1 || $count % 15 == 1 ){
            if ($count == 1 ){
                $temp += '<table class="table table-mini page page-active page'+($page++)+'">';
            } else if ($count % 15 == 1 ) {
                $temp += '<table class="table table-mini page page'+($page++)+'">';
            }
            $temp +=
                '<thead>'+
                        '<tr>' +
                            '<th>#</th>'+
                            '<th>Nomor Nota</th>'+
                            '<th>Waktu</th>'+
                            '<th>Supplier</th>'+
                            '<th>Staf</th>'+
                            '<th></th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody>';
        }

        $temp += 
            '<tr>'+
                '<td>'+$count+'</td>'+ 
                '<td>'+$data.detail[$a].no+'</td>'+
                '<td>'+$data.detail[$a].time+'</td>'+
                '<td>'+$data.detail[$a].supplier+'</td>'+
                '<td>'+$data.detail[$a].staff+'</td>'+
                '<td><a data-toggle="modal" data-target="#myModal" class="detail">Lihat</a></td>'+
            '</tr>';

        if (($count++) % 15 == 0 ){
            $temp += 
                '</tbody>'+
                '</table>';
        }
    }

    $temp += '<div class="pagination">';

   for ($a = 1; $a < $data.detail.length ; $a+=15) {
        if ($a == 1) {
            $temp += '<li class="active"><a class="pageNum">'+Math.floor(($a/15)+1)+'</a></li>';
        }
         else {
            $temp += '<li><a class="pageNum">'+Math.floor(($a/15)+1)+'</a></li>';
         }
   } 

   $temp += '</div>';

   $('.table-div').html($temp);

}

function generateTable ($tabledata){
    $temp = '';
    for ($a =0; $a < $tabledata.length; $a++ ) {
        $temp += '<tr> <td>'+ ($a+1) +'</td> <td>'+$tabledata[$a].namabahanbaku+'</td> <td>'+$tabledata[$a].jumlahpembelian+'</td> <td>'+$tabledata[$a].satuanpembelian+'</td> <td>'+$tabledata[$a].hargasatuan+'</td> <td>'+$tabledata[$a].total+'</td> </tr>';
    }

    return $temp;
}

$(document).ready (function () {
	
    $('body').on('click','.pageNum',function(){
        $num = $(this).html();
        $('.page-active').removeClass('page-active');
        $('.active').removeClass('active');
        $('.page'+$num).addClass('page-active');
        $(this).parent().addClass('active');
    });

    $('body').on('click','.detail',function(){
       $nomornota = $(this).parent().parent().children().eq(1).html();
        $waktupesan = $(this).parent().parent().children().eq(2).html();
        $waktubayar = $(this).parent().parent().children().eq(3).html();
        $total = $(this).parent().parent().children().eq(4).html();
        $kasir = $(this).parent().parent().children().eq(5).html();
        $mode = $(this).parent().parent().children().eq(6).html();

         $.post(
            "?p=detail",
            {"nomornota" : $nomornota},
            function(data) {
                if (data.status == "ok") {
                    getDetail($nomornota,$waktupesan,$waktubayar,$kasir,$total,$mode,data);
                } else {
                   $('.modal-body').html('');
                }
            },
            "json"
        );
    });

    $(".selection").change(function(){
        $sort1 = $('.group').val();
        $sort2 = $('.sort').val();
        $date = $('.dateValue').html();
        $sort3 = $date.split('/');
         $.post(
            "?p=sort",
            {"sort1" : $sort1,"sort2" : $sort2,"sort3": $sort3},
            function(data) {
                if (data.status == "ok") {
                    sortResult(data);
                } else {
                   alert('gagal');
                }
            },
            "json"
        );
    });


	$(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
		onSelect: function(dateText, inst) {
      			$(".dateValue").html(dateText);
      			$(".datepicker").hide();

               $sort1 = $('.group').val();
                $sort2 = $('.sort').val();
                $date = $('.dateValue').html();
                $sort3 = $date.split('/');
                 $.post(
                    "?p=sort",
                    {"sort1" : $sort1,"sort2" : $sort2,"sort3": $sort3},
                    function(data) {
                        if (data.status == "ok") {
                            sortResult(data);
                        } else {
                           $('.table-div').html('<h4>Hari Ini Tidak Ada Pemesanan :(</h4>');
                        }
                    },
                    "json"
                );
    	}
	}).hide().css("position","absolute").val();

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
                            '<th>Waktu Pesan</th>'+
                            '<th>Waktu Bayar</th>'+
                            '<th>Total</th>'+
                            '<th>Kasir</th>'+
                            '<th>Mode Bayar</th>'+
                            '<th></th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody>';
        }

        $temp += 
            '<tr>'+
                '<td>'+$count+'</td>'+ 
                '<td>'+$data.detail[$a].nomornota+'</td>'+
                '<td>'+$data.detail[$a].waktupesan+'</td>'+
                '<td>'+$data.detail[$a].waktubayar+'</td>'+
                '<td>'+$data.detail[$a].total+'</td>'+
                '<td>'+$data.detail[$a].emailkasir+'</td>'+
                '<td>'+$data.detail[$a].mode+'</td>'+
                '<td><a data-toggle="modal" data-target="#myModal" class="detail">Lihat</a></td>'+
            '</tr>';

        if ($count >= $data.detail.length || ($count++) % 15 == 0){
            $temp += 
                '</tbody>'+
                '</table>';
        }
    }

    $temp += '<div class="pagination">';

   for ($a = 1; $a <= $data.detail.length ; $a+=15) {
        if ($a == 1) {
            $temp += '<li class="active"><a class="pageNum">'+ 1 +'</a></li>';
        }
         else {
            $temp += '<li><a class="pageNum">'+Math.floor(($a/15)+1)+'</a></li>';
         }
   } 

   $temp += '</div>';

    $('.table-div').html($temp);

}

function generateTable ($data){
    $temp = '';
    for ($a =0; $a < $data.detail.length; $a++ ) {
        $temp += '<tr> <td>'+ ($a+1) +'</td> <td>'+$data.detail[$a].namamenu+'</td> <td>'+$data.detail[$a].harga+'</td> <td>'+$data.detail[$a].jumlah+'</td> <td>'+($data.detail[$a].harga*$data.detail[$a].jumlah)+'</td> </tr>';
    }

    return $temp;
}

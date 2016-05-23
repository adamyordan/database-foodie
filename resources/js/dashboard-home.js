$("#btn-refresh").click();

function addRow(contents) {
	var tr = $("<tr></tr>");
	for (var i = 0; i < contents.length; i++) {
		tr.append("<td>" + contents[i] + "</td>");
	}
	tr.hide().appendTo("#data_row_container").fadeIn();
}

function clearRows() {
	$("#data_row_container").empty();
}

function refresh(type){
	if      (type == "purchase") var api_link = "?p=api_purchase_get";
	else if (type == "order")    var api_link = "?p=api_order_get";
	else if (type == "menu")     var api_link = "?p=api_menu_get";		

    $.post(
        api_link,
        {"limit" : 10, "offset" : 0},
        function(data) {
        	if(data.status == "ok") {
        		clearRows();
				if      (type == "purchase") fillPurchases(data.purchases);
				else if (type == "order")    fillOrders(data.orders);
				else if (type == "menu")     fillMenus(data.menus);
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

function fillMenus(menus) {
	var i = 1;
	menus.forEach(function(m) {
		addRow([i++, m.name, m.description, m.price, m.amount, m.category]);
	});
}

function fillOrders(orders) {
	var i = 1;
	orders.forEach(function(o) {
		addRow([i++, o.nomornota, o.waktubayar, o.total, o.emailkasir, o.mode]);
	});
}

function fillPurchases(purchases) {
	var i = 1;
	purchases.forEach(function(p) {
		addRow([i++, p.no, p.time, p.supplier, p.staff]);
	});
}
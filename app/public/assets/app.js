$(document).ready(function() {
	loadCountries();
	loadCustomers();
});

function loadCountries() {
	$.getJSON('countries', function(countries){
		var html = "<option>Select country</option>";
		for (x in countries) {
			html += "<option id='" + countries[x].code + "'>" + countries[x].name + "</option>";
		}

		$('#country').html(html);
	});
}

function loadCustomers() {
	$('#customer_table').DataTable({
        processing: true,
        serverSide: true,
        ordering  : false,
        dom: 'Brtip',
        ajax: "customers"
    });
}
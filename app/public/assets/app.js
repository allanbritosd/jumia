$(document).ready(function() {
	loadCountries();
	loadCustomers();

	$(document).on('change', '#country,#valid_numbers', function() {
		table.draw();
	});
});

function loadCountries() {
	$.getJSON('countries', function(countries){
		var html = "<option>Select country</option>";
		for (x in countries) {
			html += "<option value='" + countries[x].code + "'>" + countries[x].name + "</option>";
		}

		$('#country').html(html);
	});
}

function loadCustomers() {
	table = $('#customer_table').DataTable({
        processing: true,
        serverSide: true,
        ordering  : false,
        dom: 'Brtip',
        ajax: {
        	url: 'customers',
        	data: {
        		filters: {
	                country: function() {
	                	return $('#country').val()
	                },
	                valid_numbers: function() {
	                	return $('#valid_numbers').val()
	                }
        		}
        	}
        }
    });
}
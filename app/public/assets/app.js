$(document).ready(function() {

	loadCountries();
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
function search()
{
	let phrase = $('#phrase').val();
	$.ajax({
		url: 'search.php',
		type: 'get',
		data: {
			phrase: phrase,
		},
		success: function(results){
			$('#search_results').html(results);
		},
		error: function(xhr){
			$('#search_results').html(xhr);
		},
	});
}

$(document).ready(function(){
	search();
});
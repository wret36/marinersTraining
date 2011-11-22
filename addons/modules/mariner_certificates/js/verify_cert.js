$(document).ready(function() {
	$('#certificate-verification').submit(function() {
		verifyCertificate();
		return false;
	});
});

function verifyCertificate()
{
	var searchKey = $('input[name=search_key]').val();
	var postData = {'verify' : 'Verify', 'search_key' : searchKey };
	
	$.ajax({
		  type: 'POST',
		  url: '/mariner_certificates/verify/1',
		  data: postData,
		  success: function(data) {
			  $('#optional_verify_container').html('');
			  $('#optional_verify_container').html(data);
		  },
		  dataType: 'html'
		});
}
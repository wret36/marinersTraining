$(document).ready(function() {
	$('#certificate-verification').submit(function() {
		verifyCertificate();
		return false;
	});
});

function verifyCertificate()
{
	var certID = $('input[name=certificate_id]').val();
	var postData = {'verify' : 'Verify', 'certificate_id' : certID };
	
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
function addButton() {
//	location.url('admin/mariner_certificates/add');
	window.location.replace("admin/mariner_certificates/add");

}

$(document).ready(function() {

	$("#mariner_records").flexigrid({
		url: '/admin/mariner_certificates/data',
		dataType: 'json',
		colModel : [
			{display: 'Certificate ID', name : 'certificate_id', width : 120, sortable : true, align: 'center'},
			{display: 'First Name', name : 'first_name', width : 120, sortable : true, align: 'left'},
			{display: 'Middle Name', name : 'middle_name', width : 120, sortable : true, align: 'left'},
			{display: 'Last Name', name : 'last_name', width : 120, sortable : true, align: 'left'},
			{display: 'Suffix', name : 'suffix', width : 40, sortable : true, align: 'left'},
			{display: 'Date Certified', name : 'date_certified', width : 120, sortable : true, align: 'center'},
			{display: 'Last Updated', name : 'updated_at', width : 120, sortable : true, align: 'center'},
			{display: 'Actions', name : 'action', width : 120, sortable : true, align: 'center'}
			],
		buttons : [
			{name: 'Add', bclass: 'add', onpress : addButton},
			{separator: true}
			],
		searchitems : [
			{display: 'Certificate ID', name : 'certificate_id'}
			],
		sortname: "date_certified",
		sortorder: "asc",
		usepager: true,
		title: 'Certification Records',
		useRp: true,
		rp: 10,
		showTableToggleBtn: false,
		width: 900,
		height: 450
	});
	
});
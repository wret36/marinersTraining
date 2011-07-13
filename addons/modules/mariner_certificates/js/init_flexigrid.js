function addButton() {
//	location.url('admin/mariner_certificates/add');
	window.location.replace("admin/mariner_certificates/add");

}

$(document).ready(function() {

//	$("#mariner_records").flexigrid({
//		url: 'post2.php',
//		dataType: 'json',
//		colModel : [
//			{display: 'ISO', name : 'iso', width : 40, sortable : true, align: 'center'},
//			{display: 'Name', name : 'name', width : 180, sortable : true, align: 'left'},
//			{display: 'Printable Name', name : 'printable_name', width : 120, sortable : true, align: 'left'},
//			{display: 'ISO3', name : 'iso3', width : 130, sortable : true, align: 'left', hide: true},
//			{display: 'Number Code', name : 'numcode', width : 80, sortable : true, align: 'right'}
//			],
//		buttons : [
//			{name: 'Add', bclass: 'add', onpress : test},
//			{name: 'Delete', bclass: 'delete', onpress : test},
//			{separator: true}
//			],
//		searchitems : [
//			{display: 'ISO', name : 'iso'},
//			{display: 'Name', name : 'name', isdefault: true}
//			],
//		sortname: "iso",
//		sortorder: "asc",
//		usepager: true,
//		title: 'Countries',
//		useRp: true,
//		rp: 15,
//		showTableToggleBtn: true,
//		width: 700,
//		height: 200
//	});
	
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
<html>
<head>
<title>Upload Form</title>
</head>
<body>


<h1>Upload Mariners Data</h1>
<?php if(isset($hasErrors)) {
    print $errorMessages;
}?>
<?php echo form_open_multipart('admin/mariner_certificates/upload');?>

<input type="file" name="userfile" size="2000" />

<br /><br />

<input type="submit" name="upload" value="upload" />

<h4>File format</h4>
<ul>
<li>.csv (Comma Separated Values)</li>
<li>.xls Excel Files</li>
<li>.ods (OpenOffice.org and StarOffice)</li>
</ul>
<h4>Sample Convention</h4>

<div id="sample-data"></div>
<h4>File Size</h4>
<ul>
<li>Maximum of 4 Megabytes</li>
</ul>
</body>
</html>

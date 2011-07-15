<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php if(isset($hasErrors)) {
    print $errorMessages;
}?>
<?php echo form_open_multipart('admin/mariner_certificates/upload');?>

<input type="file" name="userfile" size="2000" />

<br /><br />

<input type="submit" name="upload" value="upload" />

</form>

</body>
</html>
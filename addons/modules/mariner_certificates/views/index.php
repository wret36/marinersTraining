<!DOCTYPE html>
<html>
<head>
    <title>{pyro:template:title}</title>
</head>
<body>
    <h1>{pyro:template:title}</h1>
    <? echo form_open('mariner_certificates/verify'); ?>
    <? echo form_input("certificate_id"); ?></br>
    <? echo form_submit('mysubmit','Submit!');  ?>
    <? echo form_close(); ?>
</body>

</html>
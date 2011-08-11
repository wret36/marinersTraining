

<div id="verify_form_container" style="float: left; padding-bottom: 40px;">
<?php
$attributes = array('id' => 'certificate-verification');
echo form_open('/mariner_certificates/verify', $attributes);?>
<div>
	<?php echo form_label('Enter Certificate Number'); ?>
	<?php 
		$data = array(
              'name'        => 'certificate_id',
              'id'          => 'certificate_id',
//              'value'       =>  get_propery_from_object($certRecord, 'certificate_id'),
              'class'  		=> 'textfield'
            );
	?>
	<div><?php echo form_input($data);?></div>
</div>
<div>
	<?php 
		$data = array(
              'name'        => 'verify',
              'id'          => 'verify-button',
              'value'       => '',
              'class'  		=> 'form-button required'
            );
		?>
		
<div><?php echo form_submit($data); ?></div>
</div>
<?php echo form_close(); ?>
</div>
<div id="optional_verify_container" style="float: left;">

</div>
<div id="add_edit_user">

<?php $hidden = array('id' => ((isset($certRecord) == true ? get_propery_from_object($certRecord, 'id') : '')));?>

<?php echo form_open('admin/mariner_certificates/'.$operation, null, $hidden);?>
<div>
	<?php echo form_label('Certificate No.'); ?>:
	<?php 
		$data = array(
              'name'        => 'certificate_id',
              'id'          => 'certificate_id',
              'value'       =>  (isset($certRecord) == true ? get_propery_from_object($certRecord, 'certificate_id') : '') ,
              'class'  		=> 'textfield',
            );
	?>
	<div><?php echo form_input($data);?></div>
</div>
<div>
	<?php echo form_label('First Name'); ?>:
	<?php 
		$data = array(
              'name'        => 'first_name',
              'id'          => 'first_name',
              'value'       => (isset($certRecord) == true ? get_propery_from_object($certRecord, 'first_name') : ''),
              'class'  		=> 'textfield',
            );
		?>
	<div><?php echo form_input($data);?></div>
</div>
<div>
	<?php echo form_label('Middle Name'); ?>:
	<?php 
		$data = array(
              'name'        => 'middle_name',
              'id'          => 'middle_name',
              'value'       => (isset($certRecord) == true ? get_propery_from_object($certRecord, 'middle_name') : ''),
              'class'  		=> 'textfield',
            );
		?>
	<div><?php echo form_input($data);?></div>
</div>
<div>
	<?php echo form_label('Last Name'); ?>:
	<?php 
		$data = array(
              'name'        => 'last_name',
              'id'          => 'last_name',
              'value'       => (isset($certRecord) == true ? get_propery_from_object($certRecord, 'last_name') : ''),
              'class'  		=> 'textfield',
            );
		?>
	<div><?php echo form_input($data);?></div>
</div>
<div>
	<?php echo form_label('Suffix'); ?>:
	<?php 
		$data = array(
              'name'        => 'suffix',
              'id'          => 'suffix',
              'value'       => (isset($certRecord) == true ? get_propery_from_object($certRecord, 'suffix') : ''),
              'class'  		=> 'textfield',
            );
		?>
	<div><?php echo form_input($data);?></div>
</div>
<div>
	<?php echo form_label('Date Certified'); ?>:
	<?php 
		$data = array(
              'name'        => 'date_certified',
              'id'          => 'date_certified',
              'value'       => (isset($certRecord) == true ? get_propery_from_object($certRecord, 'date_certified') : ''),
              'class'  		=> 'textfield',
            );
		?>
	<div><?php echo form_input($data);?></div>
</div>

<div>
	<?php 
		$data = array(
              'name'        => 'cancel',
              'id'          => 'cancel',
              'value'       => 'Cancel',
              'class'  		=> 'form-button',
            );
		?>
<div><?php echo form_submit($data); ?></div>
	<?php 
		$data = array(
              'name'        => 'save',
              'id'          => 'save',
              'value'       => 'Save',
              'class'  		=> 'form-button',
            );
		?>
<div><?php echo form_submit($data); ?></div>
</div>
<?php echo form_close(); ?>

</div>

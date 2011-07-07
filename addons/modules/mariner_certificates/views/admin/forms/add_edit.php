<div id="add_edit_user">

<?php echo form_open('admin/mariner_certificates/add');?>
<div>
	<?php echo form_label('Certificate No.'); ?>:
	<?php 
		$data = array(
              'name'        => 'certificate_id',
              'id'          => 'certificate_id',
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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
              'value'       => '',
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

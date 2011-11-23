
<?php if (!isset($certificates) || count($certificates) == 0) :?>
<h3 id="not-certified">No Results Found</h3>

<?php else: ?>
<h3 id="certified">Certified Mariners Search Result</h3>
<table id="certificates" class="styled-table">
	<thead>
		<tr>
			<th class="left">Lastname</th>
			<th>Firstname</th>
			<th>Middlename</th>
			<th class="right">Date Certified</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($certificates as $certificate): ?>
		<tr align="center">
			<td><?= $certificate->last_name ?>
			</td>
			<td><?= $certificate->first_name ?>
			</td>
			<td><?= $certificate->middle_name ?>
			</td>
			<td><?= $certificate->date_certified ?>
			</td>
		</tr>
		
    <?php endforeach; ?>
    </tbody>
	<tfoot>
		<tr>
			<td class="left"></td>
			<td></td>
			<td class="right"></td>
		</tr>
	</tfoot>
</table>
<div align="center"
	id="pageNavPosition"></div>
</div>
<script type="text/javascript">
    var pager;
    
    jQuery(document).ready(function() {
        pager = new Pager('certificates', 10); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
    });
</script>

<?php endif;?>

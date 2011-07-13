<?php if (!$certificate || count($certificate) == 0) :?>
    <h4>Not results found.</h4>
<?php else: ?>
    <h4>Certified</h4>
    <div>Firstname : <?= ($certificate->first_name ? $certificate->first_name : 'N/A') ?></div>
    <div>Lastname : <?= ($certificate->last_name ? $certificate->last_name : 'N/A')  ?></div>
    <div>Middlename : <?= ($certificate->middle_name ? $certificate->middle_name : 'N/A') ?></div>
    <div>Suffix : <?= ($certificate->suffix ? $certificate->suffix : 'N/A') ?></div>
    <div>Date Certified : <?= ($certificate->date_certified ? $certificate->date_certified : 'N/A') ?></div>
<?php endif;?>

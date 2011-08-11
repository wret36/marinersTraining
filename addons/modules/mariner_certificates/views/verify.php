<?php if (!isset($certificate) || count($certificate) == 0) :?>
    <h4>No results found.</h4>
<?php else: ?>
    <h4>This person is certified!</h4>
    <div>Firstname : <?= ($certificate->first_name ? $certificate->first_name : 'N/A') ?></div>
    <div>Lastname : <?= ($certificate->last_name ? $certificate->last_name : 'N/A')  ?></div>
    <div>Middlename : <?= ($certificate->middle_name ? $certificate->middle_name : 'N/A') ?></div>
    <?= ($certificate->suffix ? '<div>Suffix : '. $certificate->suffix .'</div>': '') ?>
    <div>Date Certified : <?= ($certificate->date_certified ? $certificate->date_certified : 'N/A') ?></div>
<?php endif;?>

 
<?php if (!isset($certificate) || count($certificate) == 0) :?>
    <h3 id="not-certified" >Certificate Number, Not Found.Please try again</h3>
<?php else: ?>
    <h3 id="certified">Certificate Number is certified!</h3>
    <div id="certified-info-container">
        <div class="certified-info">Firstname : <?= ($certificate->first_name ? $certificate->first_name : 'N/A') ?></div>
        <div class="certified-info">Lastname : <?= ($certificate->last_name ? $certificate->last_name : 'N/A')  ?></div>
        <div class="certified-info">Middlename : <?= ($certificate->middle_name ? $certificate->middle_name : 'N/A') ?></div>
        <?= ($certificate->suffix ? '<div class="certified-info">Suffix : '. $certificate->suffix .'</div>': '') ?>
        <div class="certified-info">Date Certified : <?= ($certificate->date_certified ? $certificate->date_certified : 'N/A') ?></div>
    </div>
<?php endif;?>

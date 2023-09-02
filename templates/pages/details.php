<h2 class="is-size-2"><?= get_setting('greeting') ?></h2>
<br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<?= get_setting('details_paragraph_1') ?></p>
<br>
<?php 
    $image_name = get_setting('featured_img');
    if ($image_name){
        ?>
        <img src="/uploads/images/<?=$image_name?>" alt="Featured wedding image." style="width: 100%; height: auto;">
        <?php
    }
?>
<br>
<br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<?= get_setting('details_paragraph_2') ?></p>
<br>
<div class="is-flex is-align-items-center is-justify-content-center">
    <h5 class="is-size-5">We hope to see you at the wedding!</h5>
</div>
<br>
<br>
<h3 class="is-size-3">Sincerely,</h3>
<div class="is-flex is-align-items-center is-justify-content-center">
    <h1 class="is-size-1 script"> <?= get_setting('bride_fname'); ?> and <?= get_setting('groom_fname'); ?></h1>
</div>



<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->fbf_name();
    $class = $fld->fbf_class()->isEmpty() ? false : $fld->fbf_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->fbf_number_label()->isEmpty() ? false : $fld->fbf_number_label()->html();
    $placeholder = $fld->fbf_number_placeholder()->isEmpty() ? false : $fld->fbf_number_placeholder()->html();
    $min = $fld->fbf_number_min()->isEmpty() ? false : $fld->fbf_number_min();
    $max = $fld->fbf_number_max()->isEmpty() ? false : $fld->fbf_number_max();
    $step = $fld->fbf_number_step()->isEmpty() ? false : $fld->fbf_number_step();
    $req = $fld->fbf_number_req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($label):?><label for="<?= $name ?>"><?= $label ?></label><?php endif; ?>

    <input type="number" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($placeholder): ?> placeholder="<?= $placeholder ?>"<?php endif; ?><?php if($min):?> min="<?= $min ?>"<?php endif; ?><?php if($max):?> max="<?= $max ?>"<?php endif; ?><?php if($step):?> step="<?= $step ?>"<?php endif; ?><?php if($req):?> required<?php endif; ?>>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

<?php

    // // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->fbf_name();
    $class = $fld->fbf_class()->isEmpty() ? false : $fld->fbf_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->fbf_check_label()->isEmpty() ? false : $fld->fbf_check_label()->html();
    $value = $fld->fbf_check_value()->isEmpty() ? false : $fld->fbf_check_value()->html();
    $checked = $fld->fbf_check_checked()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <input type="checkbox" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($value):?> value="<?= $value ?>"<?php endif; ?><?php if($checked):?> checked<?php endif; ?>>
    <?php if($label):?><label for="<?= $name ?>"><?= $label ?></label><?php endif; ?>

<?php if($useDiv): ?>
</div>
<?php endif; ?>

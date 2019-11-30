<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $class = $fld->field_class()->isEmpty() ? false : $fld->field_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->field_label()->isEmpty() ? false : $fld->field_label()->html();
    $placeholder = $fld->placeholder()->isEmpty() ? false : $fld->placeholder()->html();
    $value = $fld->default()->isEmpty() ? '' : $fld->default()->html();
    $min = $fld->min()->isEmpty() ? false : $fld->min()->toInt();
    $max = $fld->max()->isEmpty() ? false : $fld->max()->toInt();
    $step = $fld->step()->isEmpty() ? false : $fld->step()->value();
    $req = $fld->req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($label):?><label for="<?= $name ?>"><?= $label ?></label><?php endif; ?>

    <input type="number" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?> value="<?= $value ?>"<?php if($placeholder): ?> placeholder="<?= $placeholder ?>"<?php endif; ?><?php if($min):?> min="<?= $min ?>"<?php endif; ?><?php if($max):?> max="<?= $max ?>"<?php endif; ?><?php if($step):?> step="<?= $step ?>"<?php endif; ?><?php if($req):?> required<?php endif; ?>>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

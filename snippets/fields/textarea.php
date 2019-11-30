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
    $rows = $fld->rows()->isEmpty() ? false : $fld->rows()->toInt();
    $req = $fld->req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
<?php if($label):?>
    <label for="<?= $name ?>"><?= $label ?></label>
<?php endif; ?>
    <textarea name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($placeholder): ?> placeholder="<?= $placeholder ?>"<?php endif; ?><?php if($min):?> minlength="<?= $min ?>"<?php endif; ?><?php if($max):?> maxlength="<?= $max ?>"<?php endif; ?><?php if($rows):?> rows="<?= $rows ?>"<?php endif; ?><?php if($req):?> required<?php endif; ?>><?= $value ?></textarea>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

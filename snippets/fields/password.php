<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $class = $fld->field_class()->isEmpty() ? false : $fld->field_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->field_label()->isEmpty() ? false : $fld->field_label()->html();
    $min = $fld->min()->isEmpty() ? false : $fld->min()->toInt();
    $max = $fld->max()->isEmpty() ? false : $fld->max()->toInt();
    $pattern = $fld->pattern()->isEmpty() ? false : $fld->pattern();
    $req = $fld->req()->toBool();

    if($data != false and isset($data[$name->value()])) {
        // this is a return to a previously entered form -
        // we need to populate the field with the previously entered value:
        $value = $data[$name->value()];
    } else {
        // this is a brand new form - enter the default value from the panel:
        $value = '';
    }

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
<?php if($label):?>
    <label for="<?= $name ?>"><?= $label ?></label>
<?php endif; ?>
    <input type="password" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($min):?> minlength="<?= $min ?>"<?php endif; ?><?php if($max):?> maxlength="<?= $max ?>"<?php endif; ?><?php if($pattern):?> pattern="<?= $pattern ?>"<?php endif; ?><?php if($req):?> required<?php endif; ?> value="<?= $value ?>">
<?php if($useDiv): ?>
</div>
<?php endif; ?>

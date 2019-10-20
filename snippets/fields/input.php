<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->fbf_name();
    $class = $fld->fbf_class()->isEmpty() ? false : $fld->fbf_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = 'fbf_' . $fld->fbf_type() . '_label';
    $label = $fld->$label()->isEmpty() ? false : $fld->$label()->html();
    $placeholder = 'fbf_' . $fld->fbf_type() . '_placeholder';
    $placeholder = $fld->$placeholder()->isEmpty() ? false : $fld->$placeholder()->html();
    $value = 'fbf_' . $fld->fbf_type() . '_value';
    $value = $fld->$value()->isEmpty() ? '' : $fld->$value()->html();
    $min = 'fbf_' . $fld->fbf_type() . '_min';
    $min = $fld->$min()->isEmpty() ? false : $fld->$min();
    $max = 'fbf_' . $fld->fbf_type() . '_max';
    $max = $fld->$max()->isEmpty() ? false : $fld->$max();
    $pattern = 'fbf_' . $fld->fbf_type() . '_pattern';
    $pattern = $fld->$pattern()->isEmpty() ? false : $fld->$pattern();
    $req = 'fbf_' . $fld->fbf_type() . '_req';
    $req = $fld->$req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
<?php if($label):?>
    <label for="<?= $name ?>"><?= $label ?></label>
<?php endif; ?>
    <input type="<?= $fld->fbf_type() ?>" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?> value="<?= $value ?>"<?php if($placeholder): ?> placeholder="<?= $placeholder ?>"<?php endif; ?><?php if($min):?> minlength="<?= $min ?>"<?php endif; ?><?php if($max):?> maxlength="<?= $max ?>"<?php endif; ?><?php if($pattern):?> pattern="<?= $pattern ?>"<?php endif; ?><?php if($req):?> required<?php endif; ?>>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

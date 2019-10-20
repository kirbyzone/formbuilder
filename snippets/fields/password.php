<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->fbf_name();
    $class = $fld->fbf_class()->isEmpty() ? false : $fld->fbf_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->fbf_password_label()->isEmpty() ? false : $fld->fbf_password_label()->html();
    $min = $fld->fbf_password_min()->isEmpty() ? false : $fld->fbf_password_min();
    $max = $fld->fbf_password_max()->isEmpty() ? false : $fld->fbf_password_max();
    $pattern = $fld->fbf_password_pattern()->isEmpty() ? false : $fld->fbf_password_pattern();
    $req = $fld->fbf_password_req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
<?php if($label):?>
    <label for="<?= $name ?>"><?= $label ?></label>
<?php endif; ?>
    <input type="password" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($min):?> minlength="<?= $min ?>"<?php endif; ?><?php if($max):?> maxlength="<?= $max ?>"<?php endif; ?><?php if($pattern):?> pattern="<?= $pattern ?>"<?php endif; ?><?php if($req):?> required<?php endif; ?>>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

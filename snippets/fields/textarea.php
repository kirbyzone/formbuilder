<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->fbf_name();
    $class = $fld->fbf_class()->isEmpty() ? false : $fld->fbf_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->fbf_textarea_label()->isEmpty() ? false : $fld->fbf_textarea_label()->html();
    $placeholder = $fld->fbf_textarea_placeholder()->isEmpty() ? false : $fld->fbf_textarea_placeholder()->html();
    $min = $fld->fbf_textarea_min()->isEmpty() ? false : $fld->fbf_textarea_min();
    $max = $fld->fbf_textarea_max()->isEmpty() ? false : $fld->fbf_textarea_max();
    $rows = $fld->fbf_textarea_rows()->isEmpty() ? false : $fld->fbf_textarea_rows();
    $req = $fld->fbf_textarea_req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
<?php if($label):?>
    <label for="<?= $name ?>"><?= $label ?></label>
<?php endif; ?>
    <textarea name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($placeholder): ?> placeholder="<?= $placeholder ?>"<?php endif; ?><?php if($min):?> minlength="<?= $min ?>"<?php endif; ?><?php if($max):?> maxlength="<?= $max ?>"<?php endif; ?><?php if($rows):?> rows="<?= $rows ?>"<?php endif; ?><?php if($req):?> required<?php endif; ?>></textarea>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

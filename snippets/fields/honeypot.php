<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $useDiv = $pg->fb_usediv()->toBool();

    if($pg->fb_usediv()->toBool()):
?>
<div style="display: none;" aria-hidden="true">
<?php endif; ?>
    <label for="<?= $name ?>"<?php if(!$useDiv):?> style="display: none;" aria-hidden="true"<?php endif; ?>><?= $name ?></label>
    <input type="text" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv):?> style="display: none;" aria-hidden="true"<?php endif; ?> autocomplete="off" value="">
<?php if($useDiv): ?>
</div>
<?php endif; ?>

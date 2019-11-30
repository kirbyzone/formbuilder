<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $class = $fld->field_class()->isEmpty() ? false : $fld->field_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();

    if($pg->fb_usediv()->toBool()):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?> style="display: none;" aria-hidden="true">
<?php endif; ?>
    <label for="<?= $name ?>"<?php if(!$useDiv):?> style="display: none;" aria-hidden="true"<?php endif; ?>><?= $name ?></label>
    <input type="text" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if(!$useDiv):?> style="display: none;" aria-hidden="true"<?php endif; ?> autocomplete="off" value="">
<?php if($useDiv): ?>
</div>
<?php endif; ?>

<?php

    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $useDiv = $pg->fb_usediv()->toBool();

    if($data != false and isset($data[$name->value()])) {
        // this is a return to a previously entered form -
        // we need to populate the field with the previously entered value:
        $value = $data[$name->value()];
    } else {
        // this is a brand new form - enter the default value from the panel:
        $value = '';
    }

    if($pg->fb_usediv()->toBool()):
?>
<div style="display: none;" aria-hidden="true">
<?php endif; ?>
    <label for="<?= $name ?>"<?php if(!$useDiv):?> style="display: none;" aria-hidden="true"<?php endif; ?>><?= $name ?></label>
    <input type="text" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv):?> style="display: none;" aria-hidden="true"<?php endif; ?> autocomplete="off" value="<?= $value ?>">
<?php if($useDiv): ?>
</div>
<?php endif; ?>

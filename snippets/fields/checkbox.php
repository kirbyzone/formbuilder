<?php

    // // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $class = $fld->field_class()->isEmpty() ? false : $fld->field_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->field_label()->isEmpty() ? false : $fld->field_label()->html();
    $value = $fld->default()->isNotEmpty() ? $fld->default()->html() : false;

    if($data != false){
        // this is a return to a previously entered form -
        // we need to set the checkbox to its previous checked state:
        if(isset($data[$name->value()])) {
            $checked = true;
        } else {
            $checked = false;
        }
    } else {
        // this is a brand new form - enter the default checked state from the panel:
        $checked = $fld->checked()->toBool();
    }

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <input type="checkbox" name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($value):?> value="<?= $value ?>"<?php endif; ?><?php if($checked):?> checked<?php endif; ?>>
    <?php if($label):?><label for="<?= $name ?>"><?= $label ?></label><?php endif; ?>

<?php if($useDiv): ?>
</div>
<?php endif; ?>

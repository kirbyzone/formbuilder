<?php
    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $class = $fld->field_class()->isEmpty() ? false : $fld->field_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->field_label()->isEmpty() ? false : $fld->field_label()->html();
    $multiple = $fld->multiple()->toBool();
    $req = $fld->req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($label):?><label for="<?= $name ?>"><?= $label ?></label><?php endif; ?>

    <select name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($multiple):?> multiple<?php endif; ?><?php if($req): ?> required<?php endif; ?>>
<?php
        $canSelect = true;
        foreach($fld->menuitems()->toStructure() as $option):
            $selected = false;
            $value = $option->item_value()->html();
            $optlabel = $option->item_label()->or($option->item_value())->html();
            if($data != false and isset($data[$name->value()])) {
                // this is a return to a previously entered form -
                // we need to populate the field with the previously selected value:
                if($value == $data[$name->value()]) {
                    $selected = true;
                    $canSelect = false;
                }
            } else {
                // this is a brand new form - enter the default selection from the panel:
                if(($multiple or $canSelect) and $option->item_state()->toBool()) {
                    $selected = true;
                    $canSelect = false;
                }
            }
?>
        <option value="<?= $value ?>"<?php if($selected):?> selected<?php $selected = false; endif; ?>><?= $optlabel ?></option>
<?php   endforeach; ?>
    </select>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

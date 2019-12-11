<?php
    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->field_name();
    $class = $fld->field_class()->isEmpty() ? false : $fld->field_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->field_label()->isEmpty() ? false : $fld->field_label()->html();
    $req = $fld->req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($label):?><p class="radiogroup-label"><?= $label ?></p><?php endif; ?>

<?php
        $canSelect = true;
        foreach($fld->btns()->toStructure() as $option):
            $id = 'rb-'. uniqid();
            $selected = false;
            $value = $option->radio_btn_value()->html();
            $label = $option->radio_btn_label()->or($option->radio_btn_value())->html();
            if($data != false and isset($data[$name->value()])) {
                // this is a return to a previously entered form -
                // we need to populate the field with the previously selected value:
                if($value == $data[$name->value()]) {
                    $selected = true;
                    $canSelect = false;
                }
            } else {
                // this is a brand new form - enter the default selection from the panel:
                if($canSelect and $option->radio_btn_state()->toBool()) {
                    $selected = true;
                    $canSelect = false;
                }
            }
?>  <label <?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?>>
        <input type="radio" name="<?= $name ?>" value="<?= $value ?>"<?php if($req): ?> required<?php endif; ?><?php if($selected): ?> checked<?php $selected = false; endif; ?>>
    <?= $label ?>
    </label>
<?php   endforeach; ?>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

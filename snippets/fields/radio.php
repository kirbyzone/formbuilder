<?php
    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->fbf_name();
    $class = $fld->fbf_class()->isEmpty() ? false : $fld->fbf_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->fbf_radio_label()->isEmpty() ? false : $fld->fbf_radio_label()->html();
    $req = $fld->fbf_radio_req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($label):?><p class="radiogroup-label"><?= $label ?></p><?php endif; ?>

<?php
        $canSelect = true;
        $selected = false;
        foreach($fld->fbf_radio()->toStructure() as $option):
            $id = 'rb-'. uniqid();
            $value = $option->radio_btn_value()->html();
            $label = $option->radio_btn_label()->or($option->radio_btn_value())->html();
            if($canSelect and $option->radio_btn_state()->toBool()) {
                $selected = true;
                $canSelect = false;
            }
?>
    <input type="radio" name="<?= $name ?>" id="<?= $id ?>" value="<?= $value ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($req): ?> required<?php endif; ?><?php if($selected): ?> checked<?php $selected = false; endif; ?>>
    <label for="<?= $id ?>"><?= $label ?></label>
<?php   endforeach; ?>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

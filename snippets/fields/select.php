<?php
    // FLAGS and VARIABLES that make our code easier to read:
    $name = $fld->fbf_name();
    $class = $fld->fbf_class()->isEmpty() ? false : $fld->fbf_class()->html();
    $useDiv = $pg->fb_usediv()->toBool();
    $label = $fld->fbf_select_label()->isEmpty() ? false : $fld->fbf_select_label()->html();
    $multiple = $fld->fbf_select_multiple()->toBool();
    $req = $fld->fbf_select_req()->toBool();

    if($useDiv):
?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($label):?><label for="<?= $name ?>"><?= $label ?></label><?php endif; ?>

    <select name="<?= $name ?>" id="<?= $name ?>"<?php if(!$useDiv and $class): ?> class="<?= $class ?>"<?php endif; ?><?php if($multiple):?> multiple<?php endif; ?><?php if($req): ?> required<?php endif; ?>>
<?php
        foreach($fld->fbf_select()->toStructure() as $option):
            $value = $option->select_item_value()->html();
            $optlabel = $option->select_item_label()->or($option->select_item_value())->html();
?>
        <option value="<?= $value ?>"><?= $optlabel ?></option>
<?php   endforeach; ?>
    </select>
<?php if($useDiv): ?>
</div>
<?php endif; ?>

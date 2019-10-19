<?php if($pg->form_field_structure()->toBool()): ?>
<div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($fld->form_field_select_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_select_label()->html() ?></label><?php endif; ?>

    <select name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if(!$pg->form_field_structure()->toBool() and $fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if($fld->form_field_select_multiple()->toBool()):?> multiple<?php if($fld->form_field_select_size()->isNotEmpty()):?> size="<?= $fld->form_field_select_size() ?>"<?php endif; ?><?php endif; ?>>
<?php foreach($fld->form_field_select()->toStructure() as $option): ?>
        <option value="<?= $option->select_item_value()->html() ?>"><?= $option->select_item_label()->or($option->select_item_value())->html() ?></option>
<?php endforeach; ?>
    </select>
<?php if($pg->form_field_structure()->toBool()): ?>
</div>
<?php endif; ?>

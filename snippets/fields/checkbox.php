<?php if($pg->form_field_structure()->toBool()): ?>
<div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?>>
<?php endif; ?>
    <input type="checkbox" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if(!$pg->form_field_structure()->toBool() and $fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if($fld->form_field_check_value()->isNotEmpty()):?> value="<?= $fld->form_field_check_value()->html() ?>"<?php endif; ?><?php if($fld->form_field_check_checked()->toBool()):?> checked<?php endif; ?>>
    <?php if($fld->form_field_check_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_check_label()->html() ?></label><?php endif; ?>

<?php if($pg->form_field_structure()->toBool()): ?>
</div>
<?php endif; ?>

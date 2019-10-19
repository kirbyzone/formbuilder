<?php if($pg->form_field_structure()->toBool()): ?>
<div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($fld->form_field_number_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_number_label()->html() ?></label><?php endif; ?>

    <input type="number" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if(!$pg->form_field_structure()->toBool() and $fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if($fld->form_field_number_placeholder()->isNotEmpty()): ?> placeholder="<?= $fld->form_field_number_placeholder()->html() ?>"<?php endif; ?><?php if($fld->form_field_number_min()->isNotEmpty()):?> min="<?= $fld->form_field_number_min() ?>"<?php endif; ?><?php if($fld->form_field_number_max()->isNotEmpty()):?> max="<?= $fld->form_field_number_max() ?>"<?php endif; ?><?php if($fld->form_field_number_step()->isNotEmpty()):?> step="<?= $fld->form_field_number_step()->html() ?>"<?php endif; ?><?php if($fld->form_field_number_req()->toBool()):?> required<?php endif; ?>>
<?php if($pg->form_field_structure()->toBool()): ?>
</div>
<?php endif; ?>

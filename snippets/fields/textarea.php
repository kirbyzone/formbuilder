<?php if($pg->form_field_structure()->toBool()): ?>
<div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($fld->form_field_textarea_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_textarea_label()->html() ?></label><?php endif; ?>

    <textarea name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if(!$pg->form_field_structure()->toBool() and $fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if($fld->form_field_textarea_placeholder()->isNotEmpty()): ?> placeholder="<?= $fld->form_field_textarea_placeholder()->html() ?>"<?php endif; ?><?php if($fld->form_field_textarea_min()->isNotEmpty()):?> minlength="<?= $fld->form_field_textarea_min() ?>"<?php endif; ?><?php if($fld->form_field_textarea_max()->isNotEmpty()):?> maxlength="<?= $fld->form_field_textarea_max() ?>"<?php endif; ?><?php if($fld->form_field_textarea_rows()->isNotEmpty()):?> rows="<?= $fld->form_field_textarea_rows() ?>"<?php endif; ?><?php if($fld->form_field_textarea_req()->toBool()):?> required<?php endif; ?>></textarea>
<?php if($pg->form_field_structure()->toBool()): ?>
</div>
<?php endif; ?>

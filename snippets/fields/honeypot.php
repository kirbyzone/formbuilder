<?php if($pg->form_field_structure()->toBool()): ?>
<div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?> style="display: none;" aria-hidden="true">
<?php endif; ?>
    <label for="<?= $fld->form_field_name() ?>"<?php if(!$pg->form_field_structure()->toBool()):?> style="display: none;" aria-hidden="true"<?php endif; ?>><?= $fld->form_field_name()->html() ?></label>
    <input type="text" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if(!$pg->form_field_structure()->toBool() and $fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if(!$pg->form_field_structure()->toBool()):?> style="display: none;" aria-hidden="true"<?php endif; ?> autocomplete="off" value="">
<?php if($pg->form_field_structure()->toBool()): ?>
</div>
<?php endif; ?>

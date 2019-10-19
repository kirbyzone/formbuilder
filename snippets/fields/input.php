<?php
    $label = 'form_field_' . $fld->form_field_type() . '_label';
    $placeholder = 'form_field_' . $fld->form_field_type() . '_placeholder';
    $min = 'form_field_' . $fld->form_field_type() . '_min';
    $max = 'form_field_' . $fld->form_field_type() . '_max';
    $pattern = 'form_field_' . $fld->form_field_type() . '_pattern';
    $req = 'form_field_' . $fld->form_field_type() . '_req';

    if($pg->form_field_structure()->toBool()): ?>
<div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?>>
<?php endif; ?>
    <?php if($fld->$label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->$label()->html() ?></label><?php endif; ?>

    <input type="<?= $fld->form_field_type() ?>" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if(!$pg->form_field_structure()->toBool() and $fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if($fld->$placeholder()->isNotEmpty()): ?> placeholder="<?= $fld->$placeholder()->html() ?>"<?php endif; ?><?php if($fld->$min()->isNotEmpty()):?> minlength="<?= $fld->$min() ?>"<?php endif; ?><?php if($fld->$max()->isNotEmpty()):?> maxlength="<?= $fld->$max() ?>"<?php endif; ?><?php if($fld->$pattern()->isNotEmpty()):?> pattern="<?= $fld->$pattern() ?>"<?php endif; ?><?php if($fld->$req()->toBool()):?> required<?php endif; ?>>
<?php if($pg->form_field_structure()->toBool()): ?>
</div>
<?php endif; ?>

<?php if($fld->form_field_structure()->toBool()): ?>
    <div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?>>
        <?php if($fld->form_field_text_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_text_label()->html() ?></label><?php endif; ?>

        <input type="text" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if($fld->form_field_text_placeholder()->isNotEmpty()): ?> placeholder="<?= $fld->form_field_text_placeholder()->escape('attr') ?>"<?php endif; ?><?php if($fld->form_field_text_min()->isNotEmpty()):?> minlength="<?= $fld->form_field_text_min() ?>"<?php endif; ?><?php if($fld->form_field_text_max()->isNotEmpty()):?> maxlength="<?= $fld->form_field_text_max() ?>"<?php endif; ?><?php if($fld->form_field_text_pattern()->isNotEmpty()):?> pattern="<?= $fld->form_field_text_pattern() ?>"<?php endif; ?><?php if($fld->form_field_text_req()->toBool()):?> required<?php endif; ?>>
    </div>
<?php else: ?>
    <?php if($fld->form_field_text_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_text_label()->html() ?></label><?php endif; ?>

    <input type="text" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if($fld->form_field_text_placeholder()->isNotEmpty()): ?> placeholder="<?= $fld->form_field_text_placeholder()->escape('attr') ?>"<?php endif; ?><?php if($fld->form_field_text_min()->isNotEmpty()):?> minlength="<?= $fld->form_field_text_min() ?>"<?php endif; ?><?php if($fld->form_field_text_max()->isNotEmpty()):?> maxlength="<?= $fld->form_field_text_max() ?>"<?php endif; ?><?php if($fld->form_field_text_pattern()->isNotEmpty()):?> pattern="<?= $fld->form_field_text_pattern() ?>"<?php endif; ?><?php if($fld->form_field_text_req()->toBool()):?> required<?php endif; ?>>
<?php endif; ?>
